<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Cart{
    
    public function  addOrder($subTotal,$cId){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO order_detail(order_sub_total,customer_id) VALUES('$subTotal','$cId')";
        $con->query($sql) or die($con->error);
        $orderId=$con->insert_id;
        return $orderId;
    }
    
    public function  addOrderProduct($orderId,$pId,$sizeId,$qty,$uPrice){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO order_product(order_id,product_id,size_id,quantity,unit_price) VALUES('$orderId','$pId','$sizeId','$qty','$uPrice')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  getOrdeTotal($orderId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE order_id='$orderId';";
//        $con->query($sql) or die($con->error);
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  addPayment($order_id,$paymentOption,$subTotal){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO payment(order_id,payment_type,payment_amount) VALUES('$order_id','$paymentOption','$subTotal')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
}