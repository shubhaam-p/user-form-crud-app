<?php
require 'db_conf.php';
class DBConnection {
    private $dbConnection;
    private $dbMysqlIConn;

    public function getConnection(){
        if(!$this->dbConnection)
        {
            try{
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $this->dbConnection=mysql_connect(AAConf::get_databaseURL(),
                        AAConf::get_databaseUName(),AAConf::get_databasePWord());
            }catch(Exception $e){
                echo "ERR101 : Error processing request\n";
            }
        }
        return $this->dbConnection;
    }
    
    public function closeConnection() {
        if($this->dbConnection){
            try{
                mysql_close($this->dbConnection);
                $this->dbConnection=null;
            }catch(Exception $e){
                echo "ERR103 : Error processing request\n";
            }
        }
    }


    public function getMySQLIConnection($database='default'){
        if(!$this->dbMysqlIConn){
            try{
                if($database==AAConf::get_databaseName1()) {
                    $this->dbMysqlIConn = new mysqli(AAConf::get_databaseHost(),AAConf::get_databaseUName(),AAConf::get_databasePWord(),AAConf::get_databaseName1(),AAConf::get_databasePort());
                } else {
                        $this->dbMysqlIConn = new mysqli(AAConf::get_databaseHost(),AAConf::get_databaseUName(),AAConf::get_databasePWord(),AAConf::get_databaseName(),AAConf::get_databasePort());
                    error_log(AAConf::get_databaseHost() ." -- ". AAConf::get_databaseUName()." -- ".AAConf::get_databasePWord()." -- ".AAConf::get_databaseName()." -- ".AAConf::get_databasePort());
                }
            }catch(Exception $e){
                echo "ERR104 : Error processing request\n";
            }
        }
        $this->enable_profiler();
        return $this->dbMysqlIConn;
    }
    
}
?>