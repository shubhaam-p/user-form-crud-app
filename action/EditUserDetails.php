<?php
    include "../Constants.php";
    include '../lib/DBConnection.php';
    include '../dvo/MAIN-DVO.php';
    include '../dao/MAIN-DAO.php';
    include '../functions.class.php';

    $main_dvo = new MAIN_DVO();
    $main_dao = new MAIN_DAO();
    $functions = new Functions();

    $returnArray = [];
    $save = $error = $msg = '';
    $updateShortDesc = $updateLongDesc = 0;

    $queryXML = str_replace("\'", "'", $_REQUEST["xmlData"]);
    $xml = simplexml_load_string(htmlspecialchars_decode($queryXML));

    $result = $xml->xpath("//nid");
    if(isset($result[0]) && $result[0] != null){
        $main_dvo->UNIQUEID = $functions->sanitizeInput(trim($result[0]));
    }else{
        $returnArray['save'] = '0';
        $returnArray['error'] = '1';
        $returnArray['msg'] = 'User id is not valid';
        echo json_encode($returnArray);
        exit();
    }

    $result = $xml->xpath("//name");
    if(!empty($result) && $result[0] !== ''){
        $main_dvo->NAME = $functions->sanitizeInput(trim($result[0]));
    }

    $result = $xml->xpath("//emailId");
    if(!empty($result) && $result[0] !== ''){
        $main_dvo->EMAILID = $functions->sanitizeInput(trim($result[0]));
    }

    $result = $xml->xpath("//pwd");
    if(!empty($result) && $result[0] !== ''){
        $main_dvo->PWD = $functions->sanitizeInput(trim($result[0]));
    }
  
    $result = $xml->xpath("//dob");
    if(!empty($result) && $result[0] !== ''){
        $main_dvo->DOB = $functions->sanitizeInput(trim($result[0]));
    }
    
    // $editArr = [];
    $result = $xml->xpath("//edit");//0 or 1- edit
    // error_log("edit 11 ".print_r($result,1));

    if(!empty($result) && (string)$result[0] !== ''){
        $edit = $functions->sanitizeInput(trim($result[0]));
        // $editArr = explode(",",$edit);// 1- short desc, 2- long desc 
    }

    $res = $remove = $missingParameter = 0;
    $result = $xml->xpath("//remove");//0 or 1 - remove
    if(isset($result[0]) && $result[0] != null){
        $remove = $functions->sanitizeInput(trim($result[0]));
    }

    error_log("rem,oev ".$remove);
    if($remove == 1){
        $res = $main_dao->softDeleteUser($main_dvo);
        $save = 1;
        $error = 0;
        $msg = 'Removed successfully';
    }else if(!empty($edit)){
        $res = $main_dao->editUser($main_dvo);
        $msg = 'Updated successfully';
    }else{
        $error = 1;
        $missingParameter = 1;
        $msg = 'Request is not processed, provide parameter.';
    }

    if($res){
        $save = 1;
        $error = 0;
    }else if(!$missingParameter){
        $action = $remove?"Removing":"Updating";
        $save = 0;
        $error = 1;
        $msg = "Error while $action data";
    }

    $returnArray['save'] = $save;
    $returnArray['error'] = $error;
    $returnArray['msg'] = $msg;
    echo json_encode($returnArray);
    exit();
?>