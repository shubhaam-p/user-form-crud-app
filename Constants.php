<?php

    include "ConstantDomainConfigs.php";

    $ENCRYPT_DECRYPT_KEY = '!@#oncontract$%^123ABC456DEF7890';
    $CONST_REPLACE_STR = 'CAAS';
    define('CONST_REPLACE_STR', $CONST_REPLACE_STR);
    $COOKIEDOMAIN = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

?>  