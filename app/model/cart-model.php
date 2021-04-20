<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Cart{
    
    public function  addOrder($oId,$subTotal,$cId){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO order_detail(order_id,order_sub_total,customer_id) VALUES('$oId','$subTotal','$cId')";
        $con->query($sql) or die($con->error);
        $orderId=$con->insert_id;
        return $orderId;
    }
    public function  getInsertIdOrder(){
        
        $con=$GLOBALS['con'];
        $sql="SELECT order_id FROM order_detail ORDER BY order_id DESC LIMIT 1;";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  addOrderProduct($orderId,$pId,$sizeId,$qty,$uPrice){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO order_product(order_id,product_id,size_id,quantity,unit_price) VALUES('$orderId','$pId','$sizeId','$qty','$uPrice')";
        $con->query($sql) or die($con->error);
        $isAdded="true";
        return $isAdded;
    }
    
    public function  getOrdeTotal($orderId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE order_id='$orderId';";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  getInsertIdPyment(){
        
        $con=$GLOBALS['con'];
        $sql="SELECT payment_id FROM payment ORDER BY payment_id DESC LIMIT 1;";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
     public function  getInsertIdInvoice(){
        
        $con=$GLOBALS['con'];
        $sql="SELECT invoice_id FROM invoice ORDER BY invoice_id DESC LIMIT 1;";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  addPayment($paymentId,$order_id,$paymentOption,$subTotal){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO payment(payment_id,order_id,payment_type,payment_amount) VALUES('$paymentId','$order_id','$paymentOption','$subTotal')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  addInvoice($InvoiceId,$paymentId,$order_id){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO invoice(invoice_id,payment_id,order_id) VALUES('$InvoiceId','$paymentId','$order_id')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    
    public function  addPaymentToOrder($order_id,$paymentOption){
        
        $con=$GLOBALS['con'];
        $sql="UPDATE order_detail SET order_payment_status='$paymentOption' WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error); 
    }
}