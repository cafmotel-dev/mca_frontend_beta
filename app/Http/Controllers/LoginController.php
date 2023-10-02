<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Session;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login.login');
    }

    function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . 'authentication';
            $response = Helper::PostApi($url, $this->getBuildBody($request));

//            echo "<pre>";print_r($response);die;

            if($response->success)
            {
                Session::put('permissions', (array)$response->data->permissions);

                foreach(Session::get('permissions') as $list)
        {
                           Session::put('logo', $list->companyLogo);
                           Session::put('companyName', $list->companyName);
                           

        }


                Session::put('tokenId', $response->data->token);
                Session::put('userId', $response->data->id);
                Session::put('first_name', $response->data->first_name);
                Session::put('mobile', $response->data->mobile);

                Session::put('last_name', $response->data->last_name);
                Session::put('emailId', $response->data->email);
                Session::put('userLevel', $response->data->user_level);


                return redirect('/dashboard');
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
                return redirect()->route('login')->with('message', $response->message);
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return redirect()->route('login')->with('message', $response->message);
        }
    }

    private function getBuildBody(Request $request)
    {
        $body = [
            "email" => trim($request->get("email")),
            "password" => trim($request->get("password"))
        ];
        return $body;
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }

}

