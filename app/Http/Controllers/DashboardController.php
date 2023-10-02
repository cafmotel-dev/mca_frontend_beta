<?php

namespace App\Http\Controllers;

use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;


class DashboardController extends Controller
{
    function index1(Request $request)
    {
        $lead_status = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-status";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $lead_status = (array) $response->data;
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

        $lead_status_count = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "dashboard-lead-status";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $lead_status_count = (array)$response->data;
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

        $arrLeadStatusRekeyed = Helper::rekeyArray($lead_status, 'lead_title_url');

        //echo "<pre>";print_r($lead_status_count);die;

        return view("dashboard.dashboard", ['lead_status_count' => $lead_status_count,  "lead_status" => $arrLeadStatusRekeyed]);
    }

     function index(Request $request)
    {

        $view_on_leads = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "view-on-leads";
        try
        {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success)
            {
                $view_on_leads = (array) $response->data;
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
            return view("leads.list", ["errors" => $errors]);
        }


        $lead_status_count = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "dashboard-lead-status";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $lead_status_count = (array)$response->data;
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

        $users = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "users";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $users = (array) $response->data;
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
            return view("users.list", ["errors" => $errors]);
        }

        $lead_status = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-status";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $lead_status = (array) $response->data;
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
            return view("labels.list", ["errors" => $errors]);
        }

        $arrLeadStatusRekeyed = Helper::rekeyArray($lead_status, 'lead_title_url');
        $arrUsersRekeyed = Helper::rekeyArray($users, 'id');

        //TODO: https://php.watch/versions/8.1/compact-non-string-warning
        /* return view('dashboard.dashboard', ['lead_status_count' => $lead_status_count,"lead_status" => $arrLeadStatusRekeyed,"leads" => $leads,'users' =>  $arrUsersRekeyed]);*/
        
        $page=0;
        $upper_limit=50;
        $urlpage = $request->page;
        if (!empty($urlpage) && $urlpage > 1)
        {
            $urlpage = $urlpage - 1;
            $lower_limit = $urlpage * 50;
        }
        else
        {
            $lower_limit = 0;
        }

        if ($request->isMethod('post')) {
           $lower_limit = 0;
           $page=1;
        }

         if ($request->submit_download == 'excel') {

             $upper_limit='';
         }

         $lead_status = $request->lead_status;
        $body = array
        (
            'level' => Session::get('userLevel'),
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'lower_limit' => $lower_limit,
            'upper_limit' => $upper_limit,
            'id' => Session::get('id'),
            'lead_status' => $lead_status,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'legal_company_name' => $request->legal_company_name,
            'assigned_to' => $request->assigned_to,
            'lead_type' => $request->lead_type,
            'phone_number' => $request->phone_number,

        );

        //echo "<pre>";print_r($body);die;

        $leads = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "leads";
        try
        {
            $response = Helper::PostApi($url, $body);

        //echo "<pre>";print_r($response);die;

            if ($request->submit_download == 'excel')
            {
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename=" . time() . ".csv");
                header("Pragma: no-cache");
                header("Expires: 0");
                $columns = array('first_name', 'last_name');

                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                if (!empty($response->data))
                {
                    foreach ($response->data as $key => $val)
                    {
                        fputcsv($file, array($val->first_name, $val->last_name));
                    }
                }
                exit();
            }

            if ($response->success)
            {
                $leads = $response->data;
                $record_count = $response->record_count;
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
            return view("leads.list", ["errors" => $errors]);
        }


        return view("dashboard.dashboard", ['lead_status_count' => $lead_status_count,"leads" => $leads, "record_count" => $record_count , "lower_limit" => $lower_limit, "lead_status" => $arrLeadStatusRekeyed, 'users' => $arrUsersRekeyed, 'page' =>$page,'view_on_leads' => $view_on_leads]);
    }


}


