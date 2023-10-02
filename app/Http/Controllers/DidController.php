<?php

namespace App\Http\Controllers;

use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


class DidController extends Controller
{
    function index(Request $request)
    {
        $dids = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "dids";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $dids = (array) $response->data;
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
            return view("dashboard.dashboard", ["errors" => $errors]);
        }

        

        return view("dids.list", ['dids' => $dids]);
    }

    


}


