<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class DocumentTypeController extends Controller
{
    public function index(Request $request)
    {
        $document_types = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "document-types";
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
            return view("groups.list", ["errors" => $errors]);
        }
        return view("document-types.list", ["document_types" => $document_types]);
    }

    public function add(Request $request)
    {
        $this->validate($request, ['title' => 'required|string|max:255']);
        $errors = new MessageBag();
        try
        {

           // echo "<pre>";;print_r($this->getBuildBody($request));die;
            $url = env('API_URL') . "document-type";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            if ($response->success)
            {
                session()->flash("success", "Document Type Added");
                return redirect("/document-types");
            }
            else
            {
                foreach ( $response->errors as $key => $messages )
                {
                    if (is_array($messages))
                    {
                        foreach ( $messages as $index => $message )
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

    public function update(Request $request)
    {
        $documenttype_id = $request->documenttype_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "update-document-type/$documenttype_id";
            $response = Helper::PostApi($url, $this->getBuildBody($request));
            if (!$response->success) {
                foreach ( $response->errors as $key => $message ) {
                    $errors->add($key, $message);
                }
                return redirect()->back()->withInput($request->input())->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput($request->input())->withErrors($errors);
        }
        session()->flash("success", "Document Type updated");
        return redirect()->back();

    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-document-type/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/document-types");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/document-types");

        }
    }


    public function changeDocumentTypeStatus($documenttype_id = "",  $status = "")
    {
        $body = array('documenttype_id' => $documenttype_id,'status' => $status);
        $url = env('API_URL') . 'change-document-type-status';
        $response = Helper::PostApi($url, $body);
        //echo "<pre>";print_r($body);die;
        if ($response->success)
        {
            session()->flash("success", $response->message);
            echo json_encode(array('status' => "true", 'message' =>  $response->message));
        }
        else
        {
            session()->flash("message", $response->message);
            echo json_encode(array('status' => "false", 'message' =>  $response->message));
        }
    }

    private function getBuildBody(Request $request)
    {
        $arrValues = explode(',', $request->get("select_choices"));

        $body = ["title" => trim(ucwords($request->get("title"))), "values" => json_encode($arrValues)];
        return $body;
    }
}


