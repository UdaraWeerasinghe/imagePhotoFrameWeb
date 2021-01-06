<?php
include '../model/product-model.php';
    $productObj=new Product();
include '../model/cart-model.php';
    $cartObj=new Cart();

$status=$_REQUEST["status"];
switch ($status){
    
case "proceedToCheckout":
    session_start();
    if(!isset($_SESSION['customer'])){
        header("Location:../view/login.php");
    }
 else {
//        header("Location:../view/checkout.php");
        if(isset($_COOKIE["shopping_cart"]))
               {
            $cId=$_SESSION['customer']['customer_id'];
            $subTotal=$_POST['sub_total'];
            
            $orderId=$cartObj->addOrder($subTotal, $cId);
            
            $no=1;
            $total=0;
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        
        foreach($cart_data as $keys => $values)
        {
                            $pId=$values["pId"];
                            $sizeId=$values["pSizeId"];
                            $qty=$values["pQuantity"];
                            $priceResult=$productObj->getPriceBySize($sizeId, $pId);
                            $sRow=$priceResult->fetch_assoc();
                            $uPrice=$sRow['product_price'];
                            $productResult=$productObj->getProduct($pId);
                            $pRow=$productResult->fetch_assoc();
                            $pSizeResult=$productObj->getSize($sizeId);
                            $psRow=$pSizeResult->fetch_assoc();     
                           
            $cartObj->addOrderProduct($orderId, $pId, $sizeId, $qty, $uPrice);                
                            
                            
        }
        
	setcookie('shopping_cart', '', time() - (86400 * 30),'/');
            $orderId= base64_encode($orderId);
           header("Location:../view/place-order.php?orderId=$orderId");
               }
           }
           
    break;
    
    case "loadHalfPrice":
        
        $subTotal=$_POST["subTotal"]/100*50;
        ?>
        Rs.<?php echo number_format($subTotal,2); ?>
        <input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal; ?>">
        <?php
        break;
    case "loadFullPrice":
        
        $subTotal=$_POST["subTotal"]/50*100;
        ?>
        Rs.<?php echo number_format($subTotal,2); ?>
        <input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal; ?>">
        <?php
        
        break;
    
        case "payment":
            
            $paymentOption=$_POST["payment_option"];
            $subTotal=$_POST["subTotal"];
            $order_id=$_POST["orderId"];
            $cartObj->addPayment($order_id, $paymentOption, $subTotal);
            $cartObj->addPaymentToOrder($order_id);
            header("Location:../view/order.php?alert=success");
            break;
}