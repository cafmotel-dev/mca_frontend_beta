<?php

namespace App\Http\Controllers;

use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class LabelController extends Controller
{
    public function index(Request $request)
    {
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
            return view("labels.list", ["errors" => $errors]);
        }

        return view("labels.list", ["labels" => $labels]);
    }

    public function add(Request $request)
    {
        $this->validate($request, ['title' => 'required|string|max:255', 'edit_mode' => 'required|int', 'data_type' => 'required|string']);
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "add-label";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");

            if ($response->success) {
                session()->flash("success", "Label Added");
                return redirect("/labels");
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

    public function update(Request $request)
    {
        $label_id = $request->label_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "update-label/$label_id";
            $response = Helper::PostApi($url, $this->getBuildBody($request));
            if (!$response->success) {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
                return redirect()->back()->withInput($request->input())->withErrors($errors);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput($request->input())->withErrors($errors);
        }
        session()->flash("success", "Label updated");
        return redirect()->back();

    }

    public function delete(Request $request, $id)
    {
        $url = env('API_URL') . "delete-label/$id";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success) {
            session()->flash("success", $response->message);
            return redirect("/labels");
        } else {
            session()->flash("message", $response->message);
            return redirect("/labels");

        }
    }


    public function changeLabelStatus($label_id = "", $status = "")
    {
        $body = array('label_id' => $label_id, 'status' => $status);
        $url = env('API_URL') . 'change-label-status';
        $response = Helper::PostApi($url, $body);
        //echo "<pre>";print_r($body);die;
        if ($response->success) {
            session()->flash("success", $response->message);
            echo json_encode(array('status' => "true", 'message' => $response->message));
        } else {
            session()->flash("message", $response->message);
            echo json_encode(array('status' => "false", 'message' => $response->message));
        }
    }

    public function changeViewOnLead($label_id = "", $view_on_lead = "")
    {
        $body = array('label_id' => $label_id, 'view_on_lead' => $view_on_lead);
        $url = env('API_URL') . 'change-view-on-lead-status';
        $response = Helper::PostApi($url, $body);
        //echo "<pre>";print_r($body);die;
        if ($response->success) {
            session()->flash("success", $response->message);
            echo json_encode(array('status' => "true", 'message' => $response->message));
        } else {
            session()->flash("message", $response->message);
            echo json_encode(array('status' => "false", 'message' => $response->message));
        }
    }



    private function getBuildBody(Request $request)
    {
        $arrValues = explode(',', $request->get("select_choices"));

        $body = ["title" => trim(ucwords($request->get("title"))),
            "edit_mode" => $request->get("edit_mode"),
            "display_order" => $request->get("display_order"),

            "required" => $request->get("required"),
            "merchant_required" => $request->get("merchant_required"),
            
            "data_type" => $request->get("data_type"),
            "values" => json_encode($arrValues)];
        return $body;
    }

    public function updateDisplayOrder(Request $request)
    {

        //dd(array_filter($this->getBuildBody($request)));

        $intLabelId = $request->lead_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "/label/updateDisplayOrder";
            $response = Helper::PostApi($url, array_filter($this->getBuildBody($request)));

            echo "<pre>";print_r($response);die;
            if (!$response->success) {
                foreach ($response->errors as $key => $message) {
                    if (is_array($message)) {
                        foreach ( $message as $index => $strInsideMessage )
                            $errors->add($index, $strInsideMessage);
                    } else {
                        $errors->add($key, $message);
                    }
                }
                return redirect()->back()->withInput($request->input())->withErrors($errors);
            }
            else
            {
               /* echo $response->data->lead_status;
                echo $response->data->old_lead_status;die;*/

                $leadId = $response->data->id;
                if($response->data->lead_status != $response->data->old_lead_status)
                $notifications = array('lead_id'=> $leadId,'message'=>'updated lead status from <b>'.strtoupper(str_replace('_',' ',$response->data->old_lead_status)).'</b> to <b>'.strtoupper(str_replace('_',' ',$response->data->lead_status)).'</b>.');
                else
                $notifications = array('lead_id'=> $leadId,'message'=>'updated <b>lead</b> information.');
                $result = (new NotificationController)->add($notifications);
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput($request->input())->withErrors($errors);
        }
        session()->flash("success", "Lead updated");
        return redirect()->back();

    }
}


