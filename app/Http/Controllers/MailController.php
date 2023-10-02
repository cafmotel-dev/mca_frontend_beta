<?php
namespace App\Http\Controllers;
use App\Helper\Helper;
use App\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Session;


class MailController extends Controller
{
    public static $smtpTypes = [
        0 => "none",
        1 => "user",
        2 => "campaign",
        3 => "system"
    ];

    function sendtestEmail(Request $request)
    {
        try
        {
            $url = env('API_URL') . "send-email/test";
            $response = Helper::PostApi($url, $this->getBuildBody($request));
            return response()->json($response);
        }
        catch (\Throwable $exception)
        {
            return 
            [
                'success' => false,
                'message' => "Failed to send the email",
            ];
        }
    }

    function sendEmailGeneric(Request $request)
    {


        try
        {
            $url = env('API_URL') . "send-email/generic";
            $response = Helper::PostApi($url, $this->getBuildBodyGeneric($request));

            if ($response->success)
            {

            $notifications = array('lead_id'=> $request->lead_id,'message'=>'<b>'.$request->subject.'</b> email sent to <b>'.$request->toEmailId.'</b>');
                $result = (new NotificationController)->add($notifications);
            }
            else
            {
                $notifications = array('lead_id'=> $request->lead_id,'message'=>'<b>'.$request->subject.'</b> email not sent to <b>'.$request->toEmailId.'</b>');
                $result = (new NotificationController)->add($notifications);
            }

            return response()->json($response);
        }
        catch (\Throwable $exception)
        {
            
            return 
            [
                'success' => false,
                'message' => "Failed to send the email",
            ];
        }
    }


    private function getBuildBodyGeneric(Request $request)
    {
        $body =
        [
            "toEmailId" => trim(($request->get("toEmailId"))),
            "subject" => trim(($request->get("subject"))),
            "editor1" => trim(($request->get("editor1")))
        ];
        return $body;
    }

    private function getBuildBody(Request $request)
    {
        $body =
        [
            "mail_driver" => trim(($request->get("mail_driver"))),
            "mail_host" => trim(($request->get("mail_host"))),
            "mail_port" => trim(($request->get("mail_port"))),
            "mail_username" => trim(($request->get("mail_username"))),
            "mail_password" => trim(($request->get("mail_password"))),
            "mail_encryption" => trim(($request->get("mail_encryption"))),
            "from_email" => trim(($request->get("from_email"))),
            "from_name" => trim(($request->get("from_name"))),
            "group_id" => (($request->get('group_id'))),
            "to" =>  session()->get('emailId')
        ];
        return $body;
    }

    function openMailModal(Request $request)
    {
        $errors = new MessageBag();
        $templates = [];
        try
        {
            $url = env('API_URL') . "email-templates";
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $templates['email_templates'] = $response->data;
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
            return $errors->add("error", $ex->getMessage());
        }


        $errors = new MessageBag();
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $templates['labels'] = $response->data;
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

       $users = new User();
        $templates['user_column'] = $users->getTableColumns();
        
        return $templates;
    }


    public function getTemplate(Request $request, int $id, int $list_id, int $lead_id)
    {
        $email_template = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "email-template/$id/$list_id/$lead_id";
            $response = Helper::GetApi($url, [], true);
            /*echo "<pre>";print_r($response);
            die();*/
            if ($response["success"]) {
                $email_template = $response["data"];

            } else {
                foreach ($response["errors"] as $key => $message) {
                    $errors->add($key, $message);
                }
                //return view("email-template.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            return $errors->add("error", $ex->getMessage());
            //view("email-template.edit")->withErrors($errors);
        }

        //echo "<pre>";print_r($email_template[0]);die;


        return $email_template;
    }

    public function getLabelValue(Request $request, int $id, int $list_id, int $lead_id)
    {
        $email_template = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "label-data/$id/$list_id/$lead_id";
            $response = Helper::GetApi($url, [], true);
            // echo "<pre>";print_r($response);die;
        } catch (RequestException $ex) {
            return $errors->add("error", $ex->getMessage());
        }
        return $response[0];
    }

    public function getSenderValue(Request $request, string $id)
    {
        $user = User::where('id',Session::get('userId'))->get()->first();
        $title = str_replace('[[', '', $id);
        $final_title = str_replace(']]', '', $title);
        return $user[$final_title];
    }
}

