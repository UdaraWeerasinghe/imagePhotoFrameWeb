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
}