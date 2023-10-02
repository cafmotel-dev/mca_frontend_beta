<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class TemplateTypeController extends Controller
{
    public function index(Request $request)
    {
        $template_types = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "template-types";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $template_types = $response->data;
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
            return view("template-types.list", ["errors" => $errors]);
        }
        return view("template-types.list", ["template_types" => $template_types]);
    }

    public function add(Request $request)
    {
        $this->validate($request, ['title' => 'required|string|max:255']);
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "add-template-types";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            if ($response->success)
            {
                session()->flash("success", "Template Type Added");
                return redirect("/template-types");
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

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-template-types/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/template-types");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/template-types");

        }
    }

    public function update(Request $request)
    {
        $template_type_id = $request->template_type_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "update-template-types/$template_type_id";
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
        session()->flash("success", "Template type updated");
        return redirect()->back();

    }

    public function changeTemplateTypeStatus($template_type_id = "",  $status = "")
    {
        $body = array('template_type_id' => $template_type_id,'status' => $status);
        $url = env('API_URL') . 'change-template-types';
        $response = Helper::PostApi($url, $body);
        //echo "<pre>";print_r($response);die;
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
        $body = ["title" => trim(ucwords($request->get("title")))];
        return $body;
    }
}


