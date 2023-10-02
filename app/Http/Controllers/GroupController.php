<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "group";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $groups = $response->data;
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
        return view("groups.list", ["groups" => $groups]);
    }

    public function add(Request $request)
    {
        $this->validate($request, ['title' => 'required|string|max:255']);
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "add-group";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            if ($response->success)
            {
                session()->flash("success", "Group Added");
                return redirect("/groups");
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
        $group_id = $request->group_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "update-group/$group_id";
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
        session()->flash("success", "Group updated");
        return redirect()->back();

    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-group/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/groups");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/groups");

        }
    }


    public function changeGroupStatus($group_id = "",  $status = "")
    {
        $body = array('group_id' => $group_id,'status' => $status);
        $url = env('API_URL') . 'change-group-status';
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
        $body = ["title" => trim(ucwords($request->get("title")))];
        return $body;
    }
}


