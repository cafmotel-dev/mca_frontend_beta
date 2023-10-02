<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "notifications";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                return $notification = $response->data;
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
            return $errors;
        }
    }

    public function addNotes(Request $request)
    {
        $url = env('API_URL') . "/notification/add";
        $response = Helper::RequestApi($url, "PUT", $request->all(), "json");
            if ($response->success) {
                return true;
            } else {
                return false;
               
            }
      
    }

    public function add($body)
    {

       /* $this->validate($request, [
            'user_id' => 'required|int',
            'lead_id' => 'required|int',
            'message' => 'required',
        ]);*/

        $errors = new MessageBag();
          try {
                   
                    $url = env('API_URL') . "/notification/add";
            $response = Helper::RequestApi($url, "PUT", $body, "json");
           // dd($response);
            if ($response->success) {
                //session()->flash("success", "Lead Added");
                return redirect("/leads");
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
            

    public function notificationByLeadId($lead_id)
    {
        
        $notification = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "notification/$lead_id";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                return $notification = $response->data;
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
            return $errors;
        }

    }

    private function getBuildBody(Request $request)
    {
        $body = [
            "user_id" => trim(ucwords($request->get("user_id"))),
            "lead_id" => trim(ucwords($request->get("lead_id"))),
            "message" => trim(ucwords($request->get("message")))
        ];
        return $body;
    }


    public function addLogForLeadSource($body)
    {
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "/add-log-for-lead-source/add";
            $response = Helper::RequestApi($url, "PUT", $body, "json");
            //dd($response);
            if ($response->success) {
                session()->flash("success", "Lead Source Log Added");
                return redirect("/leads");
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
}


