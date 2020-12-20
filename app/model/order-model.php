<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Order{

    
    public function  getOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getOrderQty($orderId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_product WHERE order_id='$orderId'";
        $result=$con->query($sql) or die($con->error);
        $qty=$result->num_rows;
        return $qty;
    }
    public function  getPendingOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='2'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getProcessingOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='3'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getCompletedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='4'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getShippedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='5'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getReceivedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='6'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
}
