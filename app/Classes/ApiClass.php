<?php
namespace App\Classes;

use App\Helper\Helper;
use App\Http\Controllers\PusherController;
use mysqli;
class ApiClass
{
    function labelList($clientId)
    {
        $database = "client_".$clientId;

        $mysqli = new mysqli("localhost","root","d^(@KdCSAQL0MfX",$database);
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $sql = "SELECT * FROM crm_label where (edit_mode=1 and status=1 and merchant_required='1') order by display_order asc";
        $result = $mysqli -> query($sql);

        $label = $result -> fetch_all(MYSQLI_ASSOC);

        $result -> free_result();
        $mysqli -> close();
        return $label;
    }

    function leadList($clientId,$leadId)
    {
        $database = "client_".$clientId;

        $mysqli = new mysqli("localhost","root","d^(@KdCSAQL0MfX",$database);
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $sql = "SELECT * FROM crm_lead_data where id='".$leadId."'";
        $result = $mysqli -> query($sql);

        $leads = $result -> fetch_all(MYSQLI_ASSOC);

        $result -> free_result();
        $mysqli -> close();
        return $leads;
    }


    function documentTypeList($clientId)
    {
        $database = "client_".$clientId;

        $mysqli = new mysqli("localhost","root","d^(@KdCSAQL0MfX",$database);
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $sql = "SELECT * FROM crm_documents_types";
        $result = $mysqli -> query($sql);

        $document_types = $result -> fetch_all(MYSQLI_ASSOC);

        $result -> free_result();
        $mysqli -> close();
        return $document_types;
    }

       function documentTypeValueList($types,$parent_id)
    {
        $database = "client_".$parent_id;

        $mysqli = new mysqli("localhost","root","d^(@KdCSAQL0MfX",$database);
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        $sql = "SELECT * FROM crm_documents_types where type_title_url='".$types."'";
        $result = $mysqli -> query($sql);

        $document_types = $result -> fetch_all(MYSQLI_ASSOC);

        $result -> free_result();
        $mysqli -> close();
        return $document_types;

         
    }
}