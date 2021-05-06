<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../../PHPMailer-6.2.0/src/PHPMailer.php';
require '../../PHPMailer-6.2.0/src/SMTP.php';
require '../../PHPMailer-6.2.0/src/Exception.php';


$mail = new PHPMailer(true);
  
    $mail->SMTPDebug = 0;                   
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                  
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'imagephotoframs@gmail.com';                     
    $mail->Password   = 'Image#123';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;     