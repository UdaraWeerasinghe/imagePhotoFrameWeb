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
}