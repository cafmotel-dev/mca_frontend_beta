<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $lists = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lists";
        try
        {
            $response = Helper::GetApi($url);
            
            if ($response->success)
            {
                $lists = $response->data;
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
            return view("lists.list", ["errors" => $errors]);
        }
        return view("lists.list", ["lists" => $lists]);
    }


    public function show(Request $request, int $list_id)
    {
        $lists = null;
        $errors = new MessageBag();
        try
        {
            $url = env('API_URL') . "list/$list_id";
            $response = Helper::GetApi($url, [], true);
            if ($response["success"]) {
                $lists = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("lists.edit")->withErrors($errors);
            }
        } 
        catch (RequestException $ex) 
        {
            $errors->add("error", $ex->getMessage());
            return view("lists.edit")->withErrors($errors);
        }


        $list_header = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "list-header/$list_id";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);die;
            if ($response["success"]) {
                $list_header = $response["data"];
            } else {
                foreach ($response->errors as $key => $messages) {
                    if (is_array($messages)) {
                        foreach ($messages as $index => $message)
                            $errors->add("$key.$index", $message);
                    } else {
                        $errors->add($key, $messages);
                    }
                }
                return view("lists.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("lists.edit")->withErrors($errors);
        }



        $labels = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "labels";
        try {
            $response = Helper::GetApi($url);
            if ($response->success) {
                $labels = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("lists.edit", ["errors" => $errors]);
        }

        if ($request->isMethod('post'))
        {
            $body = array(
                'title' => $request->title,
            );

            $url = env('API_URL') . "list/$list_id";

            try
            {
                $list_data = Helper::PostApi($url, $body);
                if ($list_data->success == 'true')
                {
                    return back()->withSuccess($list_data->message);
                }
            }

            catch (RequestException $ex)
            {
                $errors->add("error", $ex->getMessage());
                return view("lists.edit", ["errors" => $errors]);
            }
        }

        return view("lists.edit", ["labels" => $labels, 'lists' => $lists, 'list_header' => $list_header]);
    }


    function updateLeadColumns(Request $request)
    {
        $email_template = null;
        $errors = new MessageBag();

         $body = array(
                'label_id' => $request->label_id,
                'option_id' => $request->option_id,
                'list_id' => $request->list_id,
                'header_id' => $request->header_id

            );

         //echo "<pre>";print_r($body);die;
        $url = env('API_URL') . "list-update";
            try {
                $response = Helper::PostApi($url, $body);

                echo "<pre>";print_r($response);die;
                if ($list_data->success == 'true') {
                    return back()->withSuccess($list_data->message);

                }
            }
            catch (RequestException $ex)
            {
                $errors->add("error", $ex->getMessage());
                return view("lists.edit", ["errors" => $errors]);
            }
        return $response[0];
    }


    

    private function getBuildBody(Request $request)
    {
        $body = ["title" => trim(ucwords($request->get("title")))];
        return $body;
    }
}


