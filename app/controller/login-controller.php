<?php
include '../model/login-model.php';
$loginObj= new login();

$status=$_REQUEST["status"];
switch ($status){
    
    case "login":
       $uname=$_POST['uname'];
       $upass=$_POST['upass'];
       $upass= sha1($upass);
       $result=$loginObj->loginValidation($uname, $upass);
       $customer_details=$result->fetch_assoc();
       
       session_start();
       $_SESSION['customer']=$customer_details;
       
       if($result->num_rows==1){
           header("Location:../view/home.php");
       }
        break;
        
    case "logout":
        
        session_start();
        unset($_SESSION['customer']);
            header("Location:../view/login.php");
        break;
    
    
}