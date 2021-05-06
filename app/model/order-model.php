<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Order{

    
    public function  getproductBy($orderId){ //order product for feedback
        
        $con=$GLOBALS['con'];
        $sql="SELECT o.product_id,(SELECT product_name FROM product "
                . "WHERE product_id=o.product_id ) AS pName,"
                . "(SELECT customer_id FROM order_detail "
                . "WHERE order_id=o.order_id) as cusId FROM order_product o "
                . "WHERE o.order_id='$orderId' GROUP BY o.product_id";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
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
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='1'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getProcessingOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='2'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getCompletedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='3'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getShippedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND (order_status='4' OR order_status='5')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
    public function  getReceivedOrdeByCustomer($customerId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE customer_id='$customerId' AND order_status='6'";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
     public function  addfeedBack($productId,$cusId,$rating,$feedbackmsg){
        
        $con=$GLOBALS['con'];
        $sql="INSERT INTO feedback (product_id,customer_id,rating,feedback_msg) VALUES('$productId','$cusId','$rating','$feedbackmsg')";
        $result=$con->query($sql) or die($con->error);
        return $result;
    }
}
