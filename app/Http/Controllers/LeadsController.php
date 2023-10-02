<?php
namespace App\Http\Controllers;
use Session;
use Pusher\Pusher;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use PDF;
use Illuminate\Support\Str;

class LeadsController extends Controller
{
    public function index(Request $request)
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
            return view("leads.list", ["errors" => $errors]);
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
            return view("leads.list", ["errors" => $errors]);
        }

        $arrLeadStatusRekeyed = Helper::rekeyArray($lead_status, 'lead_title_url');
        $arrUsersRekeyed = Helper::rekeyArray($users, 'id');
        
        $page=0;
        $upper_limit=50;
        $urlpage = $request->page;
        if (!empty($urlpage) && $urlpage > 1)
        {
            $urlpage = $urlpage - 1;
            $lower_limit = $urlpage * 10;
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


        $body = array
        (
            'level' => Session::get('userLevel'),
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'lower_limit' => $lower_limit,
            'upper_limit' => $upper_limit,
            'id' => Session::get('id'),
            'lead_status' => $request->lead_status,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'legal_company_name' => $request->legal_company_name,
            'assigned_to' => $request->assigned_to,
            'lead_type' => $request->lead_type,
            'phone_number' => $request->phone_number,
            'crm_id' => $request->crm_id,


        );

            //echo "<pre>";print_r($body);die;




        $leads = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "leads";
        try
        {
            $response = Helper::PostApi($url, $body);
           // echo "<pre>";print_r($response);die;
            if ($request->submit_download == 'excel')
            {

           // echo "<pre>";print_r($response);die;
                
                header("Content-type: text/csv");
                header("Content-Disposition: attachment; filename=" . time() . ".csv");
                header("Pragma: no-cache");
                header("Expires: 0");
                $columns = array('first_name', 'last_name','email','phone','state','legal_company_name','lead_status','created_at');

                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                if (!empty($response->data))
                {
                    foreach ($response->data as $key => $val)
                    {
                        fputcsv($file, array($val->first_name, $val->last_name , $val->email, $val->phone, $val->state, $val->legal_company_name, $val->lead_status, $val->created_at));
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

       // echo "<pre>";print_r($leads);die;

        return view("leads.list", ["leads" => $leads, "record_count" => $record_count , "lower_limit" => $lower_limit, "lead_status" => $arrLeadStatusRekeyed, 'users' => $arrUsersRekeyed,'page' =>$page, 'view_on_leads' => $view_on_leads]);
    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Returns add lead page
     */
    public function addShow(Request $request)
    {
        $uuid = Str::uuid();

        $users = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "users";
        try {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success) {
                $users = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.list", ["errors" => $errors]);
        }


        $lead_status = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-status";
        try {
            $response = Helper::GetApi($url);
            if ($response->success) {
                $lead_status = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("labels.list", ["errors" => $errors]);
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
            return view("labels.list", ["errors" => $errors]);
        }

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
            return view("leads.add", ["errors" => $errors]);
        }

        //echo "<pre>";print_r($labels);die;


        return view("leads.add")->with(["labels" => $labels, "lead_status" => $lead_status, 'users' => $users, 'lead_source' => $lead_source, 'uuid' => $uuid]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * Returns edit lead page
     */
    public function editShow(Request $request, $intLeadId)
    {

        //users
        $users = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "users";
        try {
            $response = Helper::GetApi($url);
            //echo "<pre>";print_r($response);die;
            if ($response->success) {
                $users = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("users.list", ["errors" => $errors]);
        }


        //Lead status
        $lead_status = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead-status";
        try {
            $response = Helper::GetApi($url);
            if ($response->success) {
                $lead_status = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("labels.list", ["errors" => $errors]);
        }

        //echo "<pre>";print_r($lead_status);die;

        //Labels
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

        //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try {
            $response = Helper::GetApi($url);
            if ($response->success) {
                $arrLead = $response->data;
            } else {
                foreach ($response->errors as $key => $message) {
                    $errors->add($key, $message);
                }
            }
        } catch (RequestException $ex) {
            $errors->add("error", $ex->getMessage());
            return view("labels.list", ["errors" => $errors]);
        }

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
            return view("leads.add", ["errors" => $errors]);
        }



        return view("leads.edit")->with(["labels" => $labels, "lead_status" => $lead_status, 'users' => $users, 'lead' => (array) $arrLead, 'lead_source' => $lead_source]);
    }

    public function add(Request $request)
    {
      

        $errors = new MessageBag();

        try {

            //echo "<pre>";print_r($this->getBuildBody($request));die;
            $url = env('API_URL') . "/lead/add";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBody($request), "json");

            //echo "<pre>";print_r($response);die;

            if ($response->success) {

                //notes and updates
                $leadId = $response->data->id;
                $notifications = array('lead_id'=> $leadId,'message'=>'created lead <b>manually</b>.');
                $result = (new NotificationController)->add($notifications);


                session()->flash("success", "Lead Added");
                return redirect("/leads");
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


    public function import(Request $request)
    {
        $file = $request->file('list_file');
        $list_title = $request->input('list_title');
        $extension = $file->getClientOriginalExtension();
        $filename = Session::get('id') . time() . '.' . $extension;
        $rootPath = env("FILE_UPLOAD_PATH", "/var/www/html/api/upload/");
        $file->move($rootPath, $filename);
        $body = array(
            'file' => $filename,
            'title'=>$list_title
        );

        try
        {
            $url = env('API_URL') . 'lead/import';
            $response = Helper::PostApi($url, $body);

            //echo "<pre>";print_r($response);die;

            if ($response->success)
            {
                $listId = $response->list_id;
                return redirect("/list/$listId/edit");
            }
            else
            {
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

    public function update(Request $request, $intLabelId)
    {
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "/lead/$intLabelId/edit";
            $response = Helper::PostApi($url, array_filter($this->getBuildBody($request)));
            //echo "<pre>";print_r($response);die;
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
                $notifications = array('lead_id'=> $leadId,'message'=>'updated lead status from <b>'.ucwords(str_replace('_',' ',$response->data->old_lead_status)).'</b> to <b>'.ucwords(str_replace('_',' ',$response->data->lead_status)).'</b>.');
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

    public function delete(Request $request, $id)
    {

        $url = env('API_URL') . "/lead/$id/delete";
        $response = Helper::RequestApi($url, "DELETE");
        if ($response->success) {
            return response()->json([
                "status" => true,
                "message" => $response->message
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => $response->getMessage()
            ]);

        }
    }

    private function getBuildBody(Request $request)
    {
        //get labels
        $labels = $body = [];
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $labels = $response->data;
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
            return view("labels.list", ["errors" => $errors]);
        }

        foreach($labels as $key => $label){
            $body[$label->column_name] = $request->get($label->column_name);
        }

        $body['lead_status'] = $request->get('lead_status');
        $body['assigned_to'] = $request->get('assigned_to');
        $body['lead_type'] = $request->get('lead_type');
        $body['lead_source_id'] = $request->get('lead_source_id');
        //$body['unique_token'] = $this->generateCode();
        return $body;
    }

    public function view(Request $request)
    {
        $intLeadId =  $request->query('id');
        $errors = new MessageBag();

        //Labels
        $labels = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $labels = $response->data;
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

        //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $arrLead = $response->data;
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

        /*$arrUsersRekeyed = Helper::rekeyArray($users, 'id');
        echo "<pre>";print_r($arrUsersRekeyed);die;*/


        //"lead_status" => $arrLeadStatusRekeyed, 'users' => $arrUsersRekeyed

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
            return view("leads.view", ["errors" => $errors]);
        }

        //notes and updates
        $notification = (new NotificationController)->notificationByLeadId($intLeadId);
        return view("leads.view")->with(['users' => $users, 'lead_id' => $intLeadId, "labels" => $labels, 'lead' => (array) $arrLead, 'notification' => (array) $notification, "lead_status" => $arrLeadStatusRekeyed]);
    }

    public function docsInView(Request $request, $intLeadId)
    {
        $errors = new MessageBag();

        //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $arrLead = $response->data;
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

        return view("leads.docs")->with(['lead_id' => $intLeadId, 'lead' => (array) $arrLead]);
    }

    // Leads Come from another domain

    public function addLead(Request $request)
    {
        $get_url = $_SERVER['REQUEST_URI'];
        $errors = new MessageBag();
        //echo "<pre>";print_r($this->getBuildBodyLead($request));die;
        try
        {
            $url = env('API_URL') . "/lead/addLead";
            $response = Helper::RequestApi($url, "PUT", $this->getBuildBodyLead($request), "json");
            //echo "<pre>";print_r($response);die;

            if ($response->success)
            {
                //lead source log
                $leadId = $response->data->id;
                $lead_source_log = array('lead_id'=> $leadId,'lead_source_url'=>$get_url);

                $result = (new NotificationController)->addLogForLeadSource($lead_source_log);

                //notes and updates
                $notifications = array('lead_id'=> $leadId,'message'=>'created lead on <b>Call</b>.');
                $result = (new NotificationController)->add($notifications);
                session()->flash("success", "Lead Added");
                return redirect("/lead/view?id=".$leadId);
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
                //return redirect()->back()->withInput()->withErrors($errors);

                return redirect("/404");
            }
        }
        catch (RequestException $ex)
        {
            $errors->add("error", $ex->getMessage());
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }


    private function getBuildBodyLead(Request $request)
    {
        //get labels
        $labels = $body = [];
        $url = env('API_URL') . "labels";
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $labels = $response->data;
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
            return view("labels.list", ["errors" => $errors]);
        }

        foreach($labels as $key => $label){
            $body[$label->column_name] = $request->get($label->label_title_url);
        }

        $body['lead_status'] = 'new_lead'; //$request->get('lead_status');
        $body['assigned_to'] = Session::get("userId");//$request->get('assigned_to');
        $body['lead_type'] = $request->get('lead_type');
        $body['lead_source_id'] = $request->get('lead_source_id');
        return $body;
    }




    

    public function errorPage(Request $request)
    {
        return view("errorpage.404");
    }

    public function createApplication(Request $request, $intLeadId)
    {


        //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $arrLead = $response->data;
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

        foreach(Session::get('permissions') as $list)
        {
            $arrLead->companyName =  $list->companyName;
            $arrLead->companyLogo =  $list->companyLogo;

            $arrLead->address_1 =  $list->address_1;
            $arrLead->domain =  $list->domain;
        }


        $user_id = $arrLead->assigned_to;


        $lead_phone = $arrLead->phone;

        $phone = preg_replace("/[^0-9]*/",'',$lead_phone);
  if(strlen($phone) != 10) return(false);
  $sArea = substr($phone,0,3);
  $sPrefix = substr($phone,3,3);
  $sNumber = substr($phone,6,4);
  $phone = "(".$sArea.") ".$sPrefix."-".$sNumber;

            $arrLead->phone =  $phone;


        $user = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "user/$user_id";
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

        $arrLead->assign_to_first_name = $user['first_name'];
        $arrLead->assign_to_last_name = $user['last_name'];
        $arrLead->assign_to_email = $user['email'];


        $phone = $user['mobile'];


         $phone = preg_replace("/[^0-9]*/",'',$phone);
  if(strlen($phone) != 10) return(false);
  $sArea = substr($phone,0,3);
  $sPrefix = substr($phone,3,3);
  $sNumber = substr($phone,6,4);
  $phone = "(".$sArea.") ".$sPrefix."-".$sNumber;
  

        $arrLead->assign_to_mobile = $phone;


        $lead_data = (array)$arrLead;



        //echo "<pre>";print_r($lead_data);die;
        $file_name = 'signed_application_'.$lead_data['id'].'_'.$lead_data['first_name'].'_'.$lead_data['last_name'].'.pdf';
        if(\File::exists(public_path('uploads/'.$file_name)))
                {
                    \File::delete(public_path('uploads/'.$file_name));
                }
        $pdf = PDF::loadView('myPDF', $lead_data)->save('uploads/'.$file_name);
        return redirect('/uploads/'.$file_name);

    }


    public function previewApplication(Request $request, $intLeadId)
    {


        //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $arrLead = $response->data;
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

        foreach(Session::get('permissions') as $list)
        {
            $arrLead->companyName =  $list->companyName;
            $arrLead->companyLogo =  $list->companyLogo;

            $arrLead->address_1 =  $list->address_1;
            $arrLead->domain =  $list->domain;
        }


        $user_id = $arrLead->assigned_to;


        $lead_phone = $arrLead->phone;

        $phone = preg_replace("/[^0-9]*/",'',$lead_phone);
  if(strlen($phone) != 10) return(false);
  $sArea = substr($phone,0,3);
  $sPrefix = substr($phone,3,3);
  $sNumber = substr($phone,6,4);
  $phone = "(".$sArea.") ".$sPrefix."-".$sNumber;

            $arrLead->phone =  $phone;


        $user = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "user/$user_id";
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

        $arrLead->assign_to_first_name = $user['first_name'];
        $arrLead->assign_to_last_name = $user['last_name'];
        $arrLead->assign_to_email = $user['email'];


        $phone = $user['mobile'];


         $phone = preg_replace("/[^0-9]*/",'',$phone);
  if(strlen($phone) != 10) return(false);
  $sArea = substr($phone,0,3);
  $sPrefix = substr($phone,3,3);
  $sNumber = substr($phone,6,4);
  $phone = "(".$sArea.") ".$sPrefix."-".$sNumber;
  

        $arrLead->assign_to_mobile = $phone;


        $lead_data = (array)$arrLead;



        //echo "<pre>";print_r($lead_data);die;

        return view('myPDF',$lead_data);
      //  $file_name = 'signed_application_'.$lead_data['id'].'_'.$lead_data['first_name'].'_'.$lead_data['last_name'].'.pdf';
        /*if(\File::exists(public_path('uploads/'.$file_name)))
                {
                    \File::delete(public_path('uploads/'.$file_name));
                }
        //$pdf = PDF::loadView('myPDF', $lead_data)->save('uploads/'.$file_name);
        return redirect('/uploads/'.$file_name);
*/
    }


        public function updateByLeadStatus(Request $request)
    {

        //dd(array_filter($this->getBuildBody($request)));

        $intLabelId = $request->lead_id;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "/lead-status/$intLabelId/edit";
            $response = Helper::PostApi($url, array_filter($this->getBuildBody($request)));
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
                if($response->data->lead_type != $response->data->old_lead_type)
                {

                    if(empty($response->data->old_lead_type))
                    {
                        $response->data->old_lead_type = 'NEW';
                    }

                                        if(empty($response->data->old_lead_type))
                    {
                        $response->data->lead_type = 'NEW';
                    }
                $notifications = array('lead_id'=> $leadId,'message'=>'updated lead type from <b>'.strtoupper(str_replace('_',' ',$response->data->old_lead_type)).'</b> to <b>'.strtoupper(str_replace('_',' ',$response->data->lead_type)).'</b>.');
                }


                else
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



    //signed application

    public function signedApplication(Request $request, $intLeadId)
    {


        $signed_application = null;
        $errors = new MessageBag();
        try {
            $url = env('API_URL') . "signed-application/$intLeadId";
            $response = Helper::GetApi($url, [], true);
            //echo "<pre>";print_r($response);
            //die();
            if ($response["success"]) {
                $email_template = $response['data']['template_html'];

            } else {
                foreach ($response["errors"] as $key => $message) {
                    $errors->add($key, $message);
                }
                //return view("email-template.edit")->withErrors($errors);
            }
        } catch (RequestException $ex) {
            return $errors->add("error", $ex->getMessage());
            //view("email-template.edit")->withErrors($errors);
        }

       // echo "<pre>";print_r($email_template);die;


                //Lead
        $arrLead = [];
        $errors = new MessageBag();
        $url = env('API_URL') . "lead/" . $intLeadId;
        try
        {
            $response = Helper::GetApi($url);
            if ($response->success)
            {
                $arrLead = $response->data;
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

        foreach(Session::get('permissions') as $list)
        {
            $arrLead->companyName =  $list->companyName;
            $arrLead->companyLogo =  $list->companyLogo;

            $arrLead->address_1 =  $list->address_1;
            $arrLead->domain =  $list->domain;
        }


     



       



        $lead_data = (array)$arrLead;




        //echo "<pre>";print_r($email_template);die;
        $file_name = 'signed_application_'.$lead_data['id'].'_'.$lead_data['first_name'].'_'.$lead_data['last_name'].'.pdf';
        if(\File::exists(public_path('uploads/'.$file_name)))
                {
                    \File::delete(public_path('uploads/'.$file_name));
                }
        //$pdf = PDF::loadView('myPDF', $lead_data)->save('uploads/'.$file_name);

                $email_template .= '<style>table {width: 100%;border-collapse: collapse !important;}</style>';

                $pdf = PDF::loadHTML($email_template);

        // download pdf file
        return $pdf->download('pdfview.pdf');


        return redirect('/uploads/'.$file_name);

    }
}


