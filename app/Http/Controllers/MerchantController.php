<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Classes\ApiClass;
use File;
use Redirect;

class MerchantController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        
        $this->clientId = request()->segment(5);
        $this->leadId = request()->segment(6);
        $this->token = request()->segment(7);

    }
    
    public function index(Request $request)
    {
        $active_status = '';
        $unique_token = $this->token;
        $intClientId = $this->clientId;

        $lead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-details-by-token/" . $unique_token."/".$intClientId;
        try {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success) {
                $lead = $response->data;
                $unique_token = $lead->unique_token;
                $intLeadId = $lead->id;
                if($unique_token != $this->token)
                {
            return view("errorpage.401", ["errors" => $errors]);

                }
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("merchant.index", ["errors" => $errors]);
        }

        //Lead
        
        $lead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-details/" . $intLeadId."/".$intClientId;
        try {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success) {
                $lead = $response->data;
                $unique_token = $lead->unique_token;

                $merchant_name = $lead->first_name.' '.$lead->last_name;

                if($lead->mail_send == 0)
                {
                //send mail

                    $body =
                    [
                        "toEmailId" => env('SYSTEM_ADMIN_EMAIL'),
                        "subject" => 'Application has been accessed',
                        "editor1" => $merchant_name. ' has opened the application link successfully',
                        'clientId' => $intClientId
                    ];

                    $url = env('API_URL') . "send-email/generic-merchant";
                    $response = Helper::PostApi($url, $body);

                    $notifications = array('lead_id'=> $intLeadId,'message'=>$merchant_name. ' has opened the application link successfully');
                    //echo "<pre>";print_r($notifications);die;
                    $errors = new MessageBag();
                    try
                    {
                        $url = env('API_URL') . "add-notification/add/$intLeadId/$intClientId";
                        $response = Helper::RequestApi($url, "PUT", $notifications, "json");
                        //echo "<pre>";print_r($response);die;
                        if ($response->success)
                        {
                            //session()->flash("success", "Information has been updated");
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
                            return redirect()->back()->withInput()->withErrors($errors);
                        }
                    }
                    catch (RequestException $ex)
                    {
                        $errors->add("error", $ex->getMessage());
                        return redirect()->back()->withInput()->withErrors($errors);
                    }


                    //echo "<pre>";print_r($response);die;
                }

                if($unique_token != $this->token)
                {
                    return view("errorpage.401", ["errors" => $errors]);
                }
            }
            else
            {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("merchant.index", ["errors" => $errors]);
        }



        

        if ($request->isMethod('post'))
        {
            $errors = new MessageBag();

            if($request->submit =='personal_information')
            {
                $active_status = 'personal_information';
                try
            {

                $url = env('API_URL') . "/edit-lead/$intLeadId/$intClientId/edit";
                $response = Helper::PostApi($url, array_filter($this->getBuildBodyLead($request, $intClientId)));

                if($request->signed)
                {

                 $file_name = $request->old_signature;
                if(\File::exists(public_path('uploads/signature/'.$file_name)))
                {
                    \File::delete(public_path('uploads/signature/'.$file_name));
                }
                }


                if (!$response->success)
                {
                    foreach ($response->errors as $key => $message)
                    {
                        if (is_array($message))
                        {
                            foreach ( $message as $index => $strInsideMessage )
                                $errors->add($index, $strInsideMessage);
                        }
                        else
                        {
                            $errors->add($key, $message);
                        }
                    }
                    return redirect()->back()->withInput($request->input())->withErrors($errors);
                }

                else
                {

                    //send mail

                    $body =
                    [
                        "toEmailId" => env('SYSTEM_ADMIN_EMAIL'),
                        "subject" => 'Application filling ',
                        "editor1" => $merchant_name. ' has filled the application.',
                        'clientId' => $intClientId
                    ];

                    $url = env('API_URL') . "send-email/generic-merchant";
                    $response = Helper::PostApi($url, $body);

                
                    $notifications = array('lead_id'=> $intLeadId,'message'=>$merchant_name. ' has filled the application.');
                    $errors = new MessageBag();
                    try
                    {
                        $url = env('API_URL') . "add-notification/add/$intLeadId/$intClientId";
                        $response = Helper::RequestApi($url, "PUT", $notifications, "json");
                        //echo "<pre>";print_r($response);die;
                        if ($response->success)
                        {

                            
                            session()->flash("success", "Information has been updated");


                            return Redirect::back()->with("success", "Information has been updated");
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
                            return redirect()->back()->withInput()->withErrors($errors);
                        }
                    }
                    catch (RequestException $ex)
                    {
                        $errors->add("error", $ex->getMessage());
                        return redirect()->back()->withInput()->withErrors($errors);
                    }
                    //$result = (new NotificationController)->add($notifications);
                }
            }

            catch (RequestException $ex)
            {
                $errors->add("error", $ex->getMessage());
                return redirect()->back()->withInput($request->input())->withErrors($errors);
            }

            }
            

            if($request->hasfile('file_name'))
            {
                 $active_status = 'document_lists';
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
                    $request['lead_id'] = $intLeadId;
                    $request['file_size'] = $file_size;
                    $request['document_name'] = $document_name[$key];
                    $request['document_type'] = $document_type[$key];

                    //echo "<pre>";print_r($request);die;
                    $this->add($request,$intClientId);

                    $notifications = array('lead_id'=> $intLeadId,'message'=>'Uploaded <b> '.str_replace('_',' ',ucwords($document_type[$key])).' </b>Document information.');
                    $errors = new MessageBag();
                    try
                    {
                        $url = env('API_URL') . "add-notification/add/$request->lead_id/$intClientId";
                        $response = Helper::RequestApi($url, "PUT", $notifications, "json");
                        //echo "<pre>";print_r($response);die;
                        if ($response->success)
                        {
                            //session()->flash("success", "Updated Personal Information");
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
                            return redirect()->back()->withInput()->withErrors($errors);
                        }
                    }
                    catch (RequestException $ex)
                    {
                        $errors->add("error", $ex->getMessage());
                        return redirect()->back()->withInput()->withErrors($errors);
                    }

                }
            }
        }

        
        //label
        $labels = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "label-list/".$intClientId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $labels = $response->data;
            }
            else
            {
                foreach ($response->errors as $key => $message)
                {
                    $errors->add($key, $message);
                }
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("merchant.index", ["errors" => $errors]);
        }

        


        //documents
        $document_types = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "document-types-list/".$intClientId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $document_types = $response->data;
            }
            else
            {
                foreach ( $response->errors as $key => $message )
                {
                    $errors->add($key, $message);
                }
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("merchant.index", ["errors" => $errors]);
        }


        $document_list = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "document-list/$intLeadId/$intClientId";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;

            if ($response["success"]) {
                $document_list = $response["data"];
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
            return view("merchant.index")->withErrors($errors);
        }




        return view("merchant.index")->with(["labels" => $labels, 'lead' => (array) $lead, 'document_types'=>$document_types, 'document_list' => $document_list, 'clientId' => $intClientId,'active_status' => $active_status]);

    }


    public function store(Request $request)
    {
        $intClientId = $request->clientId;
        $type = $request->type;
        $url = env('API_URL') . "type-value/$type/$intClientId";
        $response = Helper::GetApi($url, [], true);
        $values =  json_decode($response['data'][0]['values']);
        return response()->json(['success'=>'Data is successfully added','values'=>$values]);
    }


    public function add(Request $request,$intClientId)
    {
        $this->validate($request, ['document_name' => 'required|string|max:255', 'document_type' => 'required|string', 'lead_id' => 'required|int']);
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "save-document/$intClientId";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
           // echo "<pre>";print_r($response);die;

            

          if ($response->success) {
                session()->flash("success", "Document has been updated");

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


    private function getBuildBodyLead(Request $request, $intClientId)
    {

        
        //get labels
        $labels = $body = [];
        $url = env('API_URL') . "label-list/$intClientId";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $labels = $response->data;
            }
            else
            {
                foreach ( $response->errors as $key => $message )
                {
                    $errors->add($key, $message);
                }
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("labels.list", ["errors" => $errors]);
        }

        foreach($labels as $key => $label){
            $body[$label->column_name] = $request->get($label->column_name);
        }


        if(!empty($request->signed))
        {

        $folderPath = env("SIGNATURE_FILE_UPLOAD_PATH");

        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);

        $file_name = uniqid() . '.'.$image_type;
           
        $file = $folderPath . $file_name;
        file_put_contents($file, $image_base64);
            
        $body['signature_image'] = $file_name;
        }


        $body['lead_status'] = $request->get('lead_status');
        $body['assigned_to'] = $request->get('assigned_to');
        $body['lead_type'] = $request->get('lead_type');
        $body['lead_source_id'] = $request->get('lead_source_id');
        $body['lead_unique_url'] = $request->get('lead_unique_url');




        return $body;
    }
    
}


