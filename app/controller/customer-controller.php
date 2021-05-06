<?php
include '../model/customer-model.php';
$customerObj= new Customer();

$status=$_REQUEST["status"];
switch ($status){
    case "addCustomer":
        $fName=$_POST["fName"];
        $lName=$_POST["lName"];
        $nic=$_POST["nic"];
        $tel=$_POST["con"];
        $email=$_POST["email"];
        $gender=$_POST["gender"];
        $zip=$_POST["zip"];
        $Address=$_POST["address"];
        $pass= sha1($_POST["passCnf"]);
        
        try {
            $isValidNic=$customerObj->validateNic($nic);
            $isValidTell=$customerObj->validateTell($tel);
            $isValidEmail=$customerObj->validateEmail($email);
            
            if($isValidNic===false){
                throw new Exception("nic");
            }
            if($isValidTell===false){
                throw new Exception("tel");
            }
            if($isValidEmail===false){
                throw new Exception("email");
            }
            
            $idResult=$customerObj->getLastInserId();
                $nor=$idResult->num_rows;
                if($nor==0){
                    $newid = "CUS00001";
                }
                else{
                    $idRow=$idResult->fetch_assoc();
                    $lid=$idRow["customer_id"];
                    $num=substr($lid, 3);
                    $num++;
                    $newid = "CUS".str_pad($num,5,"0",STR_PAD_LEFT);
                }
                $result=$customerObj->addCustomer($newid, $fName, $lName, $nic, $tel, $email, $gender, $zip, $Address);
                        $customerObj->addLogin($email, $pass, $newid);
                
        require '../../includes/phpMailer-header.php';

        $mail->setFrom('imagephotoframs@gmail.com');
        $mail->addAddress($email);     
        $mail->addReplyTo('imagephotoframs@gmail.com', 'Information');


        $mail->isHTML(FALSE);                                  
        $mail->Subject = 'Account Activation';
        $mail->Body    = '<p> Click below link to activate your account</p>'
                . '<p>http://localhost/imagePhotoFrameWeb/app/controller/customer-controller.php?status=activate&key='.base64_encode($newid).'</p>';
        $mail->AltBody = '';
        
        
        if ($mail->Send()) { 
            echo $result; 
            }
            else{
                echo $mail->ErrorInfo;
            }
            
                
                
            
        } catch (Exception $ex) {
            $msg=$ex->getMessage();
            print $msg;
        }
        
        break;
        
    case "activate":
        $cusId=base64_decode($_REQUEST["key"]);
        $customerObj->activate($cusId);
        header("Location:../view/login.php");
        break;
        
        case "dropMsg":
            $name=$_POST["name"];
            $email=$_POST["email"];
            $cno=$_POST["cno"];
            $subject=$_POST["subject"];
            $msg=$_POST["msg"];
            $result=$customerObj->addMsg($name, $email, $cno, $subject, $msg);
            echo $result;
            break;
}
