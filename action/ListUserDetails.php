<?php
    include "../Constants.php";
    include '../lib/DBConnection.php';
    include '../dvo/MAIN-DVO.php';
    include '../dao/MAIN-DAO.php';
    include '../functions.class.php';

    $main_dvo = new MAIN_DVO();
    $main_dao = new MAIN_DAO();
    $functions = new Functions();

    $returnArray = $UserDetails = [];
    $save = $error = $msg = '';

    $UserDetails = $main_dao->getAllUsers($main_dvo);

    if(count($UserDetails)>0){
        $returnArray['save'] = 1;
        $returnArray['error'] = 0;
        $returnArray['msg'] = 'Get Data successfully';
        $returnArray['data'] = $UserDetails;
    }else{
        $returnArray['save'] = 1;
        $returnArray['error'] = 0;
        $returnArray['msg'] = 'No data found/ some error occurred';
        $returnArray['data'] = $UserDetails;
    }
    echo json_encode($returnArray);
    exit();
?>