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
           echo 'success';
       } else {
           echo 'error';
       }
        break;
        
    case "redirect":
        session_start();
        $status=$_SESSION["customer"]["status"];
        $cusId=$_SESSION["customer"]["customer_id"];
        $email=$_SESSION["customer"]["customer_email"];
        if($status=="1"){
           header("Location:../view/home.php"); 
        }else{
            
         require '../../includes/phpMailer-header.php';

        $mail->setFrom('imagephotoframs@gmail.com');
        $mail->addAddress($email);     
        $mail->addReplyTo('imagephotoframs@gmail.com', 'Information');


        $mail->isHTML(FALSE);                                  
        $mail->Subject = 'Account Activation';
        $mail->Body    = '<p> Click below link to activate your account</p>'
                . '<p>http://localhost/imagePhotoFrameWeb/app/view/home.php?key='.$cusId.'</p>';
        $mail->AltBody = '';
        
        $name= base64_encode($_POST["name"]);
        $msg= base64_encode("Successfully Sent Email To");
        
        if ($mail->Send()) { 
            header("https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox"); 
            }
            else{
                echo $mail->ErrorInfo;
            }
            
            
            
            
        }
        break;
        
    case "logout":
        
        session_start();
        unset($_SESSION['customer']);
            header("Location:../view/login.php");
        break;
    
    
}