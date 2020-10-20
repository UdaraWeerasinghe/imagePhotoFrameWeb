<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class login{
    public function  loginValidation($uname, $upass){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM customer c , customer_login l WHERE c.customer_id=l.customer_id AND l.customer_user_name='$uname' AND l.customer_password='$upass'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
}
