<?php

namespace App\Http\Controllers;

use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use File;
class DocumentController extends Controller
{

    public function list(Request $request)
    {

        $document_types = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "document-types";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $document_types = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }
        $document_type = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "documents";
        try
        {
            $response = Helper::GetApi($url, [], true);
           if ($response["success"]) {
                $document_type = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("documents.list")->withErrors($errors);
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("documents.document-list-all", ["errors" => $errors]);
        }


         return view("documents.document-list-all")->with(['document_type'=> $document_type, 'document_types' => $document_types]);
    }


    public function index(Request $request)
    {

        $document_types = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "document-types";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $document_types = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }
        $lead_id = last(request()->segments());
        if ($request->isMethod('post'))
        {

             for($i=0;$i<count($request->document_type);$i++)
                {
                    if(!empty($request->type_value[$i]))
                    {
                        $type_value = $request->type_value[$i];
                        $document_type[] = $request->document_type[$i].'-'.$type_value;
                    }
                    else
                    {
                        $document_type[] = $request->document_type[$i];
                    }

                    $document_name[] = $request->document_name[$i];
                }

              
             $this->validate($request,
                    [
                        'file_name' => 'required',
                        'file_name.*' => 'mimes:gif,jpeg,png,txt,doc,docx,xlsx,xls,pdf,wav,mp3'
                    ]);

            if($request->hasfile('file_name'))
            {
                foreach($request->file('file_name') as $key => $file)
                {
                    $size = $file->getSize();
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $size > 0 ? floor(log($size, 1024)) : 0;
                    $file_size =  number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                    $rand =rand(1111,9999);
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename =  $rand. time() . '.' . $extension;
                    $rootPath = env("LIST_FILE_UPLOAD_PATH");
                    $file->move($rootPath, $filename);
                    $request['file_name'] = $filename;
                    $request['lead_id'] = $lead_id;
                    $request['file_size'] = $file_size;
                    $request['document_name'] = $document_name[$key];
                    $request['document_type'] = $document_type[$key];
                    //echo "<pre>";print_r($request);die;
                    $this->add($request);
                }
            }
        }

        $document_type = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "documents/$lead_id";
            $response = Helper::GetApi($url, [], true);
          // echo "<pre>";print_r($response);die;

            if ($response["success"]) {
                $document_type = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("documents.list")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("documents.lead-wise-documents")->withErrors($errors);
        }

       

         return view("documents.lead-wise-documents")->with(['document_type'=> $document_type,'document_types' => $document_types]);

    }

    public function add(Request $request)
    {

        //dd($request);
        $this->validate($request, ['document_name' => 'required|string|max:255', 'document_type' => 'required|string', 'lead_id' => 'required|int']);
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "document";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            

          if ($response->success) {
                session()->flash("success", "Document Added");
                return redirect("/document/1");
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return redirect()->back()->withInput()->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function update(Request $request)
    {
        $document_id = $request->document_id;

        $document_type = null;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "document/$document_id";
            $response = Helper::GetApi($url, [], true);
        //echo "<pre>";print_r($response['data']);die;

            if ($response["success"])
            {
                $document_type = $response["data"];
        //echo "<pre>";print_r($document_type['id']);die;

                $lead_id = $document_type['lead_id'];
   $this->validate($request, [
                'file_name' => 'required',
                'file_name' => 'mimes:gif,jpeg,png,txt,doc,docx,xlsx,xls,pdf,wav,mp3'
            ]);

            if($request->hasfile('file_name'))
            {
               /* foreach($request->file('file_name') as $key => $file)
                {*/
                     $file = $request->file('file_name') ;
                    $size = $file->getSize();
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $size > 0 ? floor(log($size, 1024)) : 0;
                    $file_size =  number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename = Session::get('id') . time() . '.' . $extension;
                    $rootPath = env("LIST_FILE_UPLOAD_PATH");
                    $file->move($rootPath, $filename);

                    $request['file_name'] = $filename;
                    $request['lead_id'] = $lead_id;
                    $request['file_size'] = $file_size;
                    $request['document_name'] = $request->document_name;
                    $request['document_type'] = $request->document_type;
               // }
                $file_name = $document_type['file_name'];
                if(\File::exists(public_path('uploads/'.$file_name)))
                {
                    \File::delete(public_path('uploads/'.$file_name));
                }
            }
            else
            {
                $request['document_name'] = $request->document_name;
                $request['document_type'] = $request->document_type;
            }
            }
            else
            {
                foreach ($response->errors as $key => $messages)
                {
                    if (is_array($messages))
                    {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    }
                    else
                    {
                        $errors->add($key, $messages);
                    }
                }

                //return view("documents.list")->withErrors($errors);
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("documents.lead-wise-documents")->withErrors($errors);
        }



        $errors = new MessageBag();
        try {

            $url = env('API_URL') . "update-document/$document_id";
            $response = Helper::PostApi($url, $this->getBuildBody($request));
            if (!$response->success) {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
                return redirect()->back()->withInput($request->input())->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput($request->input())->withErrors($errors);
        }
        session()->flash("success", "Document updated");
        return redirect()->back();

    }

    public function delete(Request $request, $id)
    {
        $document_type = null;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "document/$id";
            $response = Helper::GetApi($url, [], true);
            if ($response["success"])
            {
                $document_type = $response["data"];
                $file_name = $document_type['file_name'];
                if(\File::exists(public_path('uploads/'.$file_name)))
                {
                    \File::delete(public_path('uploads/'.$file_name));
                }
            }
            else
            {
                foreach ($response->errors as $key => $messages)
                {
                    if (is_array($messages))
                    {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    }
                    else
                    {
                        $errors->add($key, $messages);
                    }
                }

                return view("documents.list")->withErrors($errors);
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("documents.lead-wise-documents")->withErrors($errors);
        }
        
        $url = env('API_URL') . "delete-document/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success) {
            session()->flash("success", $response->message);
            return redirect()->back();
        } else {
            session()->flash("message", $response->message);
            return redirect()->back();

        }
    }


    public function changeLabelStatus($label_id = "", $status = "")
    {
        $body = array('label_id' => $label_id, 'status' => $status);
        $url = env('API_URL') . 'change-label-status';
        $response = Helper::PostApi($url, $body);
        //echo "<pre>";print_r($body);die;
        if ($response->success) {
            session()->flash("success", $response->message);
            echo json_encode(array('status' => "true", 'message' => $response->message));
        } else {
            session()->flash("message", $response->message);
            echo json_encode(array('status' => "false", 'message' => $response->message));
        }
    }

    private function getBuildBody(Request $request)
    {
        $body = ["document_name" => trim(ucwords($request->get("document_name"))),
            "document_type" => $request->get("document_type"),
            "file_name" => $request->get("file_name"),
            "lead_id" => $request->get("lead_id"),
            "file_size" => $request->get("file_size")

            ];
        return $body;
    }

    public function store(Request $request)
    {
        $type = $request->type;
        $url = env('API_URL') . "document-value/$type";
        $response = Helper::GetApi($url, [], true);
        $values =  json_decode($response['data'][0]['values']);
        return response()->json(['success'=>'Data is successfully added','values'=>$values]);
    }
}


