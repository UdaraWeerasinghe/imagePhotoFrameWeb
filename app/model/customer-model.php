<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Customer{
       
     public function  validateNic($nic){ //validate nic is exist
        $con=$GLOBALS['con'];
        $sql="SELECT 1 FROM customer WHERE customer_nic='$nic'";
        $results = $con->query($sql) or die($con->error);
        if($results->num_rows>0)
         {
            return false;
         }
         else
          {
             return true;
          }
    }
    public function  validateTell($tel){ //validate nic is exist
        $con=$GLOBALS['con'];
        $sql="SELECT 1 FROM customer WHERE customer_tel='$tel'";
        $results = $con->query($sql) or die($con->error);
        if($results->num_rows>0)
         {
            return false;
         }
         else
          {
             return true;
          }
    }
    public function  validateEmail($email){ //validate nic is exist
        $con=$GLOBALS['con'];
        $sql="SELECT 1 FROM customer WHERE customer_email='$email'";
        $results = $con->query($sql) or die($con->error);
        if($results->num_rows>0)
         {
            return false;
         }
         else
          {
             return true;
          }
    }
    public function  getLastInserId(){
        $con=$GLOBALS['con'];
        $sql="SELECT customer_id FROM customer ORDER BY customer_id DESC LIMIT 1";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  addCustomer($id,$fname,$lName,$nic,$tel,$email,$gender,$zip,$address){
        $con=$GLOBALS['con'];
        $sql="INSERT INTO customer(customer_id,customer_fName,customer_lName,customer_nic,customer_tel,customer_email,customer_gender,customer_zip_code,customer_address)"
                . "VALUES('$id','$fname','$lName','$nic','$tel','$email','$gender','$zip','$address')";
        $con->query($sql) or die($con->error);
        return "success";
    }
    public function  addLogin($uname,$pass,$cusId){
        $con=$GLOBALS['con'];
        $sql="INSERT INTO customer_login(customer_user_name,customer_password,customer_id)"
                . "VALUES('$uname','$pass','$cusId')";
        $con->query($sql) or die($con->error);
        return "success";
    }
}
