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



class SmtpsController extends Controller
{
    public function index(Request $request)
    {
        $smtp_setting = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "smtps";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $smtp_setting = $response->data;
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
            return view("smtps.list", ["errors"=> $errors]);
        }

        //echo "<pre>";print_r($smtp_setting);die;
        return view("smtps.list", ["smtp_setting"=> $smtp_setting]);
    }

    public function showNew(Request $request)
    {
        $group = null;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "group";
            $response = Helper::GetApi($url, [], true);
            if ($response["success"])
            {
                $group = $response["data"];
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
                return view("users.edit")->withErrors($errors);
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }
        return view("smtps.add")->with(['group' => $group]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'from_email' => 'required|string|max:255',
            'from_name' => 'required|string|max:255',
            'group_id' => 'required|array'
        ]);

           // echo "<pre>";print_r($this->getBuildBody($request));die;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "add-smtp";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            if ($response->success)
            {
                session()->flash("success", "SMTP Added");
                return redirect("/smtps");
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
        $smtp_setting = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "smtp/$id";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $smtp_setting = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("smtps.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("smtps.edit")->withErrors($errors);
        }

        //echo "<pre>";print_r($smtp_setting);die;

        $group = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "group";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $group = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("smtps.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("smtps.edit")->withErrors($errors);
        }

        return view("smtps.edit")->with(["smtp_setting" => $smtp_setting,'group' => $group]);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'mail_driver' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|string|max:255',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'from_email' => 'required|string|max:255',
            'from_name' => 'required|string|max:255',
            'group_id' => 'required|array'
        ]);

        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "smtp/$id";
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
        session()->flash("success", "Smtp Updated");
        return redirect("/smtps");
    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-smtp/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/smtps");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/smtps");

        }
    }


    public function changeSmtpStatus($smtp_id = "",  $status = "")
    {
        $body = array('smtp_id' => $smtp_id,'status' => $status);
        $url = env('API_URL') . 'change-smtp-status';
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
            "mail_driver" => trim(($request->get("mail_driver"))),
            "mail_host" => trim(($request->get("mail_host"))),
            "mail_port" => trim(($request->get("mail_port"))),
            "mail_username" => trim(($request->get("mail_username"))),
            "mail_password" => trim(($request->get("mail_password"))),
            "mail_encryption" => trim(($request->get("mail_encryption"))),
            "from_email" => trim(($request->get("from_email"))),
            "from_name" => trim(($request->get("from_name"))),
            "group_id" => (($request->get('group_id')))
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


