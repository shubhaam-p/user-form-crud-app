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
    $queryXML = str_replace("\'", "'", $_REQUEST["xmlData"]);
    $xml = simplexml_load_string(htmlspecialchars_decode($queryXML));

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
        $main_dvo->PWD = hash('sha256', $main_dvo->PWD);
    }
  
    $result = $xml->xpath("//dob");
    if(!empty($result) && $result[0] !== ''){
        $main_dvo->DOB = $functions->sanitizeInput(trim($result[0]));
    }
    $result = 0;
    if(isset($main_dvo->NAME) && isset($main_dvo->PWD)){
        error_log("pwd ".$main_dvo->PWD);
        $result = $main_dao->addUser($main_dvo);
    }
    if(!empty($result)){
        $save = 1;
        $error = 0;
        $msg = 'Saved successfully';
    }else{
        $save = 0;
        $error = 1;
        $msg = 'Error while saving data';

    }
    $returnArray['save'] = $save;
    $returnArray['error'] = $error;
    $returnArray['msg'] = $msg;
    echo json_encode($returnArray);
    exit();
?>