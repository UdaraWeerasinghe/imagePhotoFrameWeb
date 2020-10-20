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
       
       if($result->num_rows==1){
           header("Location:../view/home.php");
       }
        break;
    
    
}