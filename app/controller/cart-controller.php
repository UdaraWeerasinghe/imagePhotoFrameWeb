<?php
include '../model/product-model.php';
    $productObj=new Product();
include '../model/cart-model.php';
    $cartObj=new Cart();

$status=$_REQUEST["status"];
switch ($status){
    
case "proceedToCheckout":
    $idResult=$cartObj->getInsertIdOrder();
                $nor=$idResult->num_rows;
                if($nor==0){
                    $newid = "OR00001";
                }
                else{
                    $idRow=$idResult->fetch_assoc();
                    $lid=$idRow["order_id"];
                    $num=substr($lid, 2);
                    $num++;
                    $newid = "OR".str_pad($num,5,"0",STR_PAD_LEFT);
                }
                    
                                session_start();
              if(!isset($_SESSION['customer'])){
                  header("Location:../view/login.php");
              }
           else {
          
                  if(isset($_COOKIE["shopping_cart"]))
                         {
                      $cId=$_SESSION['customer']['customer_id'];
                      $subTotal=$_POST['sub_total'];

                      $isAdded=$cartObj->addOrder($newid,$subTotal, $cId);
            
            if($isAdded=="true")
            {
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

                            $cartObj->addOrderProduct($newid, $pId, $sizeId, $qty, $uPrice);                
                        }
                        setcookie('shopping_cart', '', time() - (86400 * 30),'/');
                        $orderId= base64_encode($newid);
                        header("Location:../view/payment.php?orderId=$orderId");
            }
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
            
            
            $idResult=$cartObj->getInsertIdPyment();
                $nor=$idResult->num_rows;
                if($nor==0){
                    $newid = "P00001";
                }
                else{
                    $idRow=$idResult->fetch_assoc();
                    $lid=$idRow["payment_id"];
                    $num=substr($lid, 1);
                    $num++;
                    $newid = "P".str_pad($num,5,"0",STR_PAD_LEFT);
                }
                $invoiceIdResult=$cartObj->getInsertIdInvoice();
                $norInInvoice=$invoiceIdResult->num_rows;
                if($norInInvoice==0){
                    $newInvoiceId = "IN00001";
                }
                else{
                    $inIdRow=$invoiceIdResult->fetch_assoc();
                    $lidInvoice=$inIdRow["invoice_id"];
                    $numIn=substr($lidInvoice, 2);
                    $numIn++;
                    $newInvoiceId = "IN".str_pad($numIn,5,"0",STR_PAD_LEFT);
                }
                    
                if($paymentOption=='3'){//when custome has paid 50% and second time comes to pay
                   $option=2;
                   $updateOPtion=1;
                    $cartObj->addPayment($newid,$order_id, $option, $subTotal);
                    $cartObj->addPaymentToOrder($order_id,$updateOPtion);
                    $cartObj->addInvoice($newInvoiceId, $newid, $order_id);
                } else {//new payment
                    $cartObj->addPayment($newid,$order_id, $paymentOption, $subTotal);
                    $cartObj->addPaymentToOrder($order_id,$paymentOption);
                    $cartObj->addInvoice($newInvoiceId, $newid, $order_id);
                }
                
            header("Location:../view/order.php?alert=success");
            break;
            
}