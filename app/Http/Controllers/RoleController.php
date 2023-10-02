<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "roles";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $roles = $response->data;
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
            return view("roles.list", ["errors" => $errors]);
        }
        return view("roles.list", ["roles" => $roles]);
    }

}


