<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\User;




class PdfTemplateController extends Controller
{
    public function index(Request $request)
    {
        $pdf_templates = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "pdf-templates";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $pdf_templates = $response->data;
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
            return view("pdf-templates.list", ["errors"=> $errors]);
        }

        //echo "<pre>";print_r($pdf_templates);die;
        return view("pdf-templates.list", ["pdf_templates"=> $pdf_templates]);
    }

    public function showNew(Request $request)
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

        $label_list = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $label_list = $response->data;
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
            return view("pdf-templates.list", ["errors" => $errors]);
        }

        $users = new User();
        $user_column = $users->getTableColumns();

        return view("pdf-templates.add")->with(['template_types' => $template_types, 'document_types' => $document_types,'label_list' => $label_list,'user_column' => $user_column]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'template_name' => 'required|string|max:255',
            'template_html' => 'required|string',
            'document_type' => 'required|string'
        ]);

        //echo "<pre>";print_r($this->getBuildBody($request));die;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "add-pdf-template";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
        //echo "<pre>";print_r($response);die;

            if ($response->success)
            {
                session()->flash("success", "Pdf Template Added");
                return redirect("/pdf-templates");
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


    public function show(Request $request, int $id)
    {
        $pdf_template = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "pdf-template/$id";
            $response = Helper::GetApi($url, [], true);

        // echo "<pre>";print_r($response);die;

            if ($response["success"]) {
                $pdf_template = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("pdf-templates.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("pdf-templates.edit")->withErrors($errors);
        }

        $label_list = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $label_list = $response->data;
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
            return view("pdf-templates.edit", ["errors" => $errors]);
        }

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
            return view("pdf-templates.edit", ["errors" => $errors]);
        }

        $users = new User();
        $user_column = $users->getTableColumns();

        return view("pdf-templates.edit")->with(['template_types'=> $template_types, 'pdf_template'=>$pdf_template,'document_types' => $document_types,'label_list' => $label_list,'user_column' => $user_column]);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'template_name' => 'required|string|max:255',
            'template_html' => 'required|string',
            'document_type' => 'required|string'
        ]);

        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "pdf-template/$id";
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
        session()->flash("success", "Pdf Template Updated");
        return redirect("/pdf-templates");
    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-pdf-template/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/pdf-templates");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/pdf-templates");

        }
    }


    public function changePdfTemplateStatus($pdf_template_id = "",  $status = "")
    {
        $body = array('pdf_template_id' => $pdf_template_id,'status' => $status);
        $url = env('API_URL') . 'change-pdf-template-status';
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
        $body =[
            "template_name" => trim(($request->get("template_name"))),
            "template_html" => trim(($request->get("template_html"))),
            "document_type" => ($request->get("document_type")),
            "send_bcc" => ($request->get("send_bcc"))

        ];
        return $body;
    }

    public function checkSMTPSetting(Request $request)
    {
        try
        {
            //var_dump($request->all());die;
            $config = array
            (
                'driver'     =>     $request->mail_driver,
                'host'       =>     $request->mail_host,
                'port'       =>     $request->mail_port,
                'username'   =>     $request->mail_username,
                'password'   =>     $request->mail_password,
                'encryption' =>     $request->mail_encryption,
            );

            $toEmail = session()->get('emailId');
            Config::set('mail', $config);

            $address = $request->from_email ?? "test@cafmotel.com";
            $name = $request->from_name ?? "Email Test";

            \Mail::to($toEmail)->send(new TestMail(['address' => $address,'name' => $name], 'Email Setting Test Mail'));
            Log::info("successcheckSMTPSetting", ["success"=>true,"message" => $config]);
            return response()->json(["success" => true, "message" => $config]);
        }

        catch (\Throwable $throwable)
        {
            Log::error("errorcheckSMTPSetting", ["message" => $throwable->getMessage(),"file" => $throwable->getFile(),"line" => $throwable->getLine()]);
            return response()->json(["success" => false, "message" => $throwable->getMessage()]);
        }
    }
}


