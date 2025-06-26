<?php
function getErrorCode($errno){
    return "ERR_"."FPSMEC_".$errno;
}

function myExceptionHandler($exception)
{
    echo "<?xml version='1.0'?><result><status>".getErrorCode(7).":".$exception->getMessage()."</status></result>";
}

###########
set_exception_handler('myExceptionHandler');

$arrActions=array();

$arrActions['addUser'] 			= '../action/AddUser.php';
$arrActions['editUserDetails']  = '../action/EditUserDetails.php';// to soft delete and edit user details
$arrActions['listUserDetails']  = '../action/ListUserDetails.php';// to soft delete and edit user details

$action = $_REQUEST['action'];
if($arrActions[$action]) {
    include $arrActions[$action];
} else {
    echo "<?xml version='1.0'?><result><status>".getErrorCode(12).":Page not found!</status></result>";
}
?>