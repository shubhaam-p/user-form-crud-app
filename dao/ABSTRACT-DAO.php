<?php

abstract class AbstractDAO
{
    //
    public $errorMsg = array();
    public $exceptionMsg = array();
    public $connection = '';
    public $myslqi = '';
    public $totalRowCountQuery;
    
    public function __construct() {
        $this->connection = DBConnection::getInstance();
        $this->myslqi = $this->connection->getMySQLIConnection();
    }

    public function logException($e) {
        try {
            $this->exceptionMsg[] = $e->getMessage();
            error_log("Error in DAO :: ".$e->getMessage());
        } catch (Exception $e1) {
            
        }
    }

    public function logError($errcd, $errmsg, $functionName) {
        try {
            $this->errCd = $errcd;
            $this->errorMsg = "$errcd . ':' . $functionName . '' . $errmsg";
            $this->errorMsg = $errmsg;
            $this->funcName = $functionName;
        } catch (Exception $e1) {
            
        }
    }
     
    public function closeMySQLIConnection() {
        $this->connection->closeMySQLIConnection();
        return true;
    }
}
?>