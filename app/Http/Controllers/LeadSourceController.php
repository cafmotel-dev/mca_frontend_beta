<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class LeadSourceController extends Controller
{
    public function index(Request $request)
    {
        $lead_source = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-source";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $lead_source = $response->data;
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
            return view("lead-source.list", ["errors" => $errors]);
        }
        return view("lead-source.list", ["lead_source" => $lead_source]);
    }

    public function add(Request $request)
    {
        $this->validate($request, ['url' => 'required|string|max:255']);
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "add-lead-source";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            if ($response->success)
            {
                session()->flash("success", "Lead Status Added");
                return redirect("/lead-source");
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
        $url = env('API_URL') . "delete-lead-status/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/lead-status");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/lead-status");

        }
    }

    public function update(Request $request)
    {
        $lead_source_id = $request->lead_source_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "update-lead-sources/$lead_source_id";
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
        session()->flash("success", "Lead Status updated");
        return redirect()->back();

    }

    public function changeLeadStatus($lead_status_id = "",  $status = "")
    {
        $body = array('lead_status_id' => $lead_status_id,'status' => $status,);
        $url = env('API_URL') . 'change-lead-status';
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
        $body = ["url" => trim(ucwords($request->get("url"))),
        "source_title" => trim(ucwords($request->get("source_title"))),
    ];
        return $body;
    }
}


