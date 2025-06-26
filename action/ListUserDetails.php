<?php
    include "../Constants.php";
    include '../lib/DBConnection.php';
    include '../dvo/MAIN-DVO.php';
    include '../dao/MAIN-DAO.php';
    include '../functions.class.php';

    $main_dvo = new MAIN_DVO();
    $main_dao = new MAIN_DAO();
    $functions = new Functions();

    $returnArray = $UserData = [];
    $save = $error = $msg = '';

    $userId = $userDetails = '';
    if(isset($_GET['userDetails']) && $_GET['userDetails'] != '') {
        $userDetails = $functions->sanitizeInput($_GET['userDetails']);
    }

    if(isset($_GET['userId']) && $_GET['userId'] != '') {
        $main_dvo->UNIQUEID = $userId = $functions->sanitizeInput($_GET['userId']);
    }

    if(isset($userDetails) &&  isset($userId) && $userDetails)
        $UserData = $main_dao->getUserDetails($main_dvo);
    else
        $UserData = $main_dao->getAllUsers($main_dvo);

    if(count($UserData)>0){
        $returnArray['save'] = 1;
        $returnArray['error'] = 0;
        $returnArray['msg'] = 'Get Data successfully';
        $returnArray['data'] = $UserData;
    }else{
        $returnArray['save'] = 1;
        $returnArray['error'] = 0;
        $returnArray['msg'] = 'No data found/ some error occurred';
        $returnArray['data'] = $UserData;
    }
    echo json_encode($returnArray);
    exit();
?>