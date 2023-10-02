<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class LenderController extends Controller
{
    public function index(Request $request)
    {
        $lenders = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lenders";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $lenders = $response->data;
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
            return view("lenders.list", ["errors" => $errors]);
        }
        // dump($users);
        return view("lenders.list", ["lenders" => $lenders]);
    }

    public function showNew(Request $request)
    {
        
        return view("lenders.add")->with([]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'lender_name' => 'required|string|max:255',
            'email'      => 'required|email',
            'contact_person'   => 'required|string',
        ]);

        $errors = new MessageBag();

        //dd($this->getBuildBody($request));
        try {
            $url = env('API_URL') . "lender";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            ///echo "<pre>";print_r($response);die;
            if ($response->success) {
                session()->flash("success", "Lender Added");
                return redirect("/lenders");
            } else {
                foreach ( $response->errors as $key => $messages ) {
                    if (is_array($messages)) {
                        foreach ( $messages as $index => $message )
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

    public function show(Request $request, int $id)
    {
        $lender = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "lender/$id";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $lender = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("lenders.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("lenders.edit")->withErrors($errors);
        }

       

       

        return view("lenders.edit")->with(["lender" => $lender]);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'lender_name' => 'required|string|max:255',
            'email'      => 'required|email',
            'contact_person'   => 'required|string',
        ]);

        $errors = new MessageBag();

        //dd($this->getBuildBody($request));
        try {
            $url = env('API_URL') . "lender/$id";
            $response = Helper::PostApi($url, $this->getBuildBody($request));
            //echo "<pre>";print_r($response);die;
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
        session()->flash("success", "Lender Updated");
                return redirect("/lenders");
    }

    public function profile(Request $request)
    {
        return view("users.profile");
    }

    private function getBuildBody(Request $request)
    {
        $body = [
            "lender_name" => trim(ucwords($request->get("lender_name"))),
            "email" => trim($request->get("email")),
            "contact_person" => trim($request->get("contact_person")),
            "city" => trim($request->get("city")),
            "address" => trim($request->get("address")),
            "state" => trim($request->get("state")),
            "phone" => trim($request->get("phone")),

        ];
        return $body;
    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-user/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success)
        {
            session()->flash("success", $response->message);
            return redirect("/users");
        }
        else
        {
            session()->flash("message", $response->message);
            return redirect("/users");

        }
    }


    public function changeLenderStatus($lender_id = "",  $status = "")
    {
        $body = array('lender_id' => $lender_id,'status' => $status);
        $url = env('API_URL') . 'change-lender-status';
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
}


