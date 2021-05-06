<?php
include_once '../../commons/dbConnection.php';
$dbConnObj= new dbConnection();

class Product{
    public function  getAllProduct(){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
     public function  getAllProductPopular(){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product LIMIT 4";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
     public function  selectFeedback($productId){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM feedback WHERE product_id='$productId' GROUP BY customer_id";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  getCustomerById($cusId){
        $con = $GLOBALS['con'];
        $sql = "SELECT customer_fName, customer_lName FROM customer WHERE customer_id='$cusId'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  searchProduct($txt){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product WHERE product_name LIKE '$txt'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  searchProductByFilter($catId){
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product WHERE sub_cat_id='$catId'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  getStatingPrice($p_id){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT MIN(product_price) AS startingPrice FROM product_price WHERE product_id='$p_id'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  getAllSubCategory(){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM sub_category WHERE sub_cat_status='1'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    
    public function  getAllColor(){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT DISTINCT product_color FROM product WHERE product_status='1'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    
    public function  getAllMaterial(){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM category";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  getProduct($pId){
        
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM product WHERE product_id='$pId'";
        $results = $con->query($sql)or die($con->error);
        return $results;
    }
    public function  getSizeByType($subCatId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM sub_category_size sc, size s WHERE sc.size_id=s.size_id and sc.sub_cat_id='$subCatId'";
        $results = $con->query($sql) or die($con->error);
        return $results;
    }
    public function  getPriceBySize($sizeId,$pId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT product_price FROM product_price WHERE size_id='$sizeId' AND product_id='$pId'";
        $results = $con->query($sql) or die($con->error);
        return $results;
    }
    public function  getSize($sizeId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM size WHERE size_id='$sizeId'";
        $results = $con->query($sql) or die($con->error);
        return $results;
    }
    public function  getOrderByOrderId($orderId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail o, order_product op, product p WHERE o.order_id = op.order_id AND op.product_id=p.product_id AND o.order_id='$orderId'";
        $results = $con->query($sql) or die($con->error);
        return $results;
    }
    public function  getOrderById($orderId){
        
        $con=$GLOBALS['con'];
        $sql="SELECT * FROM order_detail WHERE order_id='$orderId'";
        $results = $con->query($sql) or die($con->error);
        return $results;
    }
}