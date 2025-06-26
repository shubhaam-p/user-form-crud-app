<?php
include "ABSTRACT-DAO.php";

Class MAIN_DAO extends AbstractDAO{

    function addUser($main_dvo){
        $returnVal = 0;
        try {
            $query = "INSERT INTO user (name, email_id, dob, pwd) VALUES(?, ?, ?, ?)";
            try {
                $stmt = $this->myslqi->prepare($query);
                $stmt->bind_param('ssss', $main_dvo->NAME, $main_dvo->EMAILID, $main_dvo->DOB, $main_dvo->PWD);
            } catch (\Throwable $th) {
                $this->logException($th);
                return $returnVal;
            }

            if ($stmt->execute()) {   
                $returnVal = 1;
            }
            $stmt->free_result();
            $stmt->close();
        } catch (Exception $e) {
            $this->logException($e);
            $returnVal = 0;
        }
        return $returnVal;
    }

      function softDeleteUser($main_dvo){
        $returnVal = 0;
        try {
            $query="UPDATE user SET nstatus = 0, deletedon = NOW() WHERE id = ?";
            error_log("query ".$query);
            try {
                $stmt = $this->myslqi->prepare($query);
                $stmt->bind_param('i', $main_dvo->UNIQUEID);
            } catch (\Throwable $th) {
                $this->logException($th);
                return $returnVal;
            }

            if ($stmt->execute()) {   
                $returnVal = 1;
            }
            $stmt->free_result();
            $stmt->close();
        } catch (Exception $e) {
            $this->logException($e);
            $returnVal = 0;
        }
        return $returnVal;
    }

     function editUser($main_dvo){
        $returnVal = 0;
        try {
            $query="UPDATE user SET name = ?, email_id = ?, dob = ?, pwd= ?, updatedon = NOW() WHERE id = ?";
            try {
                $stmt = $this->myslqi->prepare($query);
                $stmt->bind_param('ssssi',  $main_dvo->NAME, $main_dvo->EMAILID, $main_dvo->DOB, $main_dvo->PWD, $main_dvo->UNIQUEID);
            } catch (\Throwable $th) {
                $this->logException($th);
                return $returnVal;
            }

            if ($stmt->execute()) {   
                $returnVal = 1;
            }
            $stmt->free_result();
            $stmt->close();
        } catch (Exception $e) {
            $this->logException($e);
            $returnVal = 0;
        }
        return $returnVal;
    }

    public function getAllUsers($main_dvo) {
        $returnVal = [];
        try {
            $query = "SELECT id, name, email_id, dob FROM user WHERE NSTATUS = 1 ORDER BY id DESC";
            $stmt = $this->myslqi->prepare($query);
            $UNIQUEID = $NAME = $EMAILID = $DOB = array(); 

            if ($stmt->execute()) {
                $stmt->bind_result($UNIQUEID, $NAME, $EMAILID, $DOB);
                while ($stmt->fetch()) {
                    array_push($returnVal, array('ID'=>$UNIQUEID, 'NAME'=>$NAME, 'EMAILID'=>$EMAILID, 'DOB'=>$DOB));
                }
            } else {
                $this->logError($this->myslqi->errno, $this->myslqi->error, 'getAllUsers');
            }
            $stmt->free_result();
            $stmt->close();
        } catch (Exception $e) {
            $this->logException($e);
        }
        return $returnVal;
    }

    public function getUserDetails($main_dvo) {
        $returnVal = [];
        try {
            $query = "SELECT id, name, email_id, dob FROM user WHERE NSTATUS = 1 AND id = ?";
            $UNIQUEID = $NAME = $EMAILID = $DOB = array(); 

            try {
                $stmt = $this->myslqi->prepare($query);
                $stmt->bind_param('i', $main_dvo->UNIQUEID);
            } catch (\Throwable $th) {
                $this->logException($th);
                return $returnVal;
            }

            if ($stmt->execute()) {
                $stmt->bind_result($UNIQUEID, $NAME, $EMAILID, $DOB);
                while ($stmt->fetch()) {
                    array_push($returnVal, array('ID'=>$UNIQUEID, 'NAME'=>$NAME, 'EMAILID'=>$EMAILID, 'DOB'=>$DOB));}
            } else {
                $this->logError($this->myslqi->errno, $this->myslqi->error, 'getUserDetails');
            }
            $stmt->free_result();
            $stmt->close();
        } catch (Exception $e) {
            $this->logException($e);
        }
        return $returnVal;
    }

}
?>