<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use  Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "users";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $users = $response->data;
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
            return view("users.list", ["errors" => $errors]);
        }
        // dump($users);
        return view("users.list", ["users" => $users]);
    }

    public function showNew(Request $request)
    {
        $roles = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "roles";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $roles = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }

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
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }
        return view("users.add")->with(["roles" => $roles,'group' => $group]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'password'   => 'required|string',
            'mobile'     => 'required|string'
        ]);

        $errors = new MessageBag();

        //dd($this->getBuildBody($request));
        try {
            $url = env('API_URL') . "user";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");
            //echo "<pre>";print_r($response);die;
            if ($response->success) {
                session()->flash("success", "User Added");
                return redirect("/users");
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
        $user = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "user/$id";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $user = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }

        $roles = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "roles";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $roles = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }

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
                return view("users.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.edit")->withErrors($errors);
        }

        return view("users.edit")->with(["user" => $user, "roles" => $roles, 'group' => $group]);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string',
            'mobile'     => 'required|string'
        ]);

        $errors = new MessageBag();

        //dd($this->getBuildBody($request));
        try {
            $url = env('API_URL') . "user/$id";
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
        session()->flash("success", "User Updated");
                return redirect("/users");
    }

    public function profile(Request $request)
    {
        return view("users.profile");
    }

    private function getBuildBody(Request $request)
    {
        $body = [
            "first_name" => trim(ucwords($request->get("first_name"))),
            "last_name" => trim(ucwords($request->get("last_name"))),
            "email" => trim($request->get("email")),
            "password" => trim($request->get("password")),
            "sip_extension" => trim($request->get("sip_extension")),
            "fax" => trim($request->get("fax")),
            "mobile" => trim($request->get("mobile")),
            "role" => trim($request->get("role")),
            "team_group" => trim($request->get("team_group")),
            "date_of_birth" => trim($request->get("date_of_birth")),
            "start_date" => trim($request->get("start_date"))
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


    public function changeUserStatus($user_id = "",  $status = "")
    {
        $body = array('user_id' => $user_id,'status' => $status);
        $url = env('API_URL') . 'change-user-status';
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


    function changePassword(Request $request){

        //dd($request->all());
        $validator =  Validator::make($request->all(),[
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if(isset($request->user_id)){
            $url = env('API_URL').'update-user-password';
            $body=array(
                'id' => $request->user_id,
                'password' => $request->old_password,
                'new_password' => $request->password,
                'token' => Session::get('tokenId')
            );

            //echo "<pre>";print_r($body);die;
           /* $result = Helper::PostApi($url,$body);
            echo "<pre>";print_r($result);die;
*/

            try{
                $result = Helper::PostApi($url,$body);

            //echo "<pre>";print_r($result);die;

                if($result->success == 'true'){
                    return back()->withSuccess($result->message);
                }

                 if($result->success == 'false'){
                    return back()->withSuccess($result->message);
                }
            }

            catch (BadResponseException   $e) {
                return back()->with('message',"Error code - (update-user-password): Oops something went wrong :( Please contact your administrator.)");
            }
            catch (RequestException $ex) {
                $message = "Page Not Found";
                return back()->withSuccess($message);
            }  
         }
    }
}


