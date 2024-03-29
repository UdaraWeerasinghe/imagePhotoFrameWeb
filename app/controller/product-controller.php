<?php
include '../model/product-model.php';
$productObj=new Product();


$status=$_REQUEST["status"];
switch ($status){
    
    case "getPrice":
        $sizeId=$_POST['size_id'];
        $pId=$_POST['pId'];
        $qty=$_POST['pQuantity'];
        $productResult=$productObj->getPriceBySize($sizeId, $pId);
        $pRow=$productResult->fetch_assoc();
        $productPrice=$pRow['product_price'];
        
        $total=$productPrice * $qty;
        ?>
        <div class="col-md-6">
            <label style="font-weight: bold">Unit price : Rs. <?php echo number_format($productPrice,2)?></label>
            <input id="pPrice" name="pPrice" type="hidden" value="<?php echo $productPrice; ?>">
        </div>
        <div class="col-md-6" style="text-align: end">
            <label style="font-weight: bold">TOTAL COST : Rs. <?php echo number_format($total,2)?></label>
            <input id="pTotal" name="pTotal" type="hidden" value="<?php echo $spRow['startingPrice']; ?>">
        </div>
<?php
    break;


    case "addToCart":
       if(isset($_POST["add_to_cart"]))
{
	if(isset($_COOKIE["shopping_cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
	}
 else {
     $cart_data = array();
 }
 
 $item_id_list = array_column($cart_data, 'psId');
 $psId=$_POST["pId"].$_POST["size_id"]; //get the unic id for increse qty with out add add  as new productto cart
 
 if(in_array($psId, $item_id_list)){
     
     echo count($cart_data);//display ntification
     
     foreach ($cart_data as $keys => $values){
         if($cart_data[$keys]["psId"] == $psId){
             $cart_data[$keys]["pQuantity"] = $cart_data[$keys]["pQuantity"] + $_POST["pQuantity"];
         }
     }
 }
 else {
     $psId=$_POST["pId"].$_POST["size_id"]; //get the unic id for increse qty with 
                                            //out add add  as new productto cart
		$item_array = array(
                    'psId' => $psId,
                    'pId' => $_POST["pId"],
                    'pQuantity' => $_POST["pQuantity"],
                    'pSizeId' => $_POST["size_id"]
		);
		$cart_data[] = $item_array;
                
                echo count($cart_data);//display ntification
 }
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (86400 * 30),'/');
       
        } 
        
        break;
        
        case "removeFromCart":
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
         
            
            foreach($cart_data as $keys => $values)
    {                
                if($cart_data[$keys]["psId"] == $_POST["psId"])
			{
				unset($cart_data[$keys]);
                                $item_data = json_encode($cart_data);
				setcookie("shopping_cart", $item_data, time() + (86400 * 30),'/');
                                
                                echo count($cart_data); //update the count
                        } 
            }
            break;
            case "changePrice":
                $price=$_POST['unitPrice'];
                $qty=$_POST['qty'];
                echo number_format($price * $qty,2);
                $total=$price*$qty;
                                    
                break;
            
            case "viewOrderModale":
                    $orderId=$_POST["orderId"];
                    $oResult=$productObj->getOrderById($orderId);
                    $tRow=$oResult->fetch_assoc();
                    $orderResult=$productObj->getOrderByOrderId($orderId);
                    ?>
                    <label style="font-weight: bold">Order Id :&nbsp;</label><?php echo $orderId ?> &nbsp;|&nbsp;
                    <?php $timestamp = strtotime($tRow["order_timestamp"]); ?>
                    <label style="font-weight: bold">Date :&nbsp;</label><?php echo date('d-m-Y', $timestamp); ?>&nbsp;|&nbsp;
                    <label style="font-weight: bold">Time :&nbsp;</label><?php echo date('h:i:sa', $timestamp); ?>
                    <?php
                    if($tRow["order_payment_status"]=='1'){
                        ?>
                    <label style="font-weight: bold">Payment Status :&nbsp;</label> 
                    <label style="background-color: #28a745; font-size: 14px; color: white;padding: 3px; border-radius: 5px;">Completed </label>  
                     <?php
                    }else if($tRow["order_payment_status"]=='2'){
                        ?>
                    <label style="font-weight: bold">Payment Status :&nbsp;</label> 
                    <label style="background-color: #ffc107; font-size: 14px; padding: 3px; border-radius: 5px;">Not Completed </label>  
                        <?php
                    }else if($tRow["order_payment_status"]=='0'){
                        ?>
                    <label style="font-weight: bold">Payment Status :&nbsp;</label> 
                    <label style="background-color: #dc3545; font-size: 14px; color: white; padding: 3px; border-radius: 5px;">Not Paid </label>  
                        <?php
                    }
                    ?>
                    <table class="table table-borderless table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=0;
                                $total=0;
                    while ($oRow=$orderResult->fetch_assoc()){
                        $sizeResult=$productObj->getSize($oRow["size_id"]);
                        $sRow=$sizeResult->fetch_assoc();
                            $no++;
                            $total=$total+$oRow["unit_price"]*$oRow["quantity"];
                                 
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $oRow["product_name"]."(".$sRow['width']."&Prime;"."&#215;".$sRow['height']."&Prime;".")";?></td>
                                    <td><?php echo $oRow["quantity"]; ?></td>
                                    <td><?php echo "Rs.".number_format($oRow["unit_price"]*$oRow["quantity"],2)?></td>
                                </tr>
                    <?php } ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><hr style="margin: 0px;"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="font-weight: bold;">Sub Total</td>
                                    <td></td>
                                    <td style="font-weight: bold;"><?php echo "Rs.".number_format($total,2); ?></td>
                                </tr>
                                <?php
                    if($tRow["order_payment_status"]=='1'){
                        ?>
                                </tbody>
                        </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                            <?php
                    }else if($tRow["order_payment_status"]=='2'){
                        ?>
                                <tr>
                                    <td></td>
                                    <td style="font-weight: bold">Outstanding Amount</td>
                                    <td></td>
                                    <td style="font-weight: bold; color: orangered;"><?php echo "Rs.".number_format($total/2,2); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                        </table>
                    <div class="modal-footer">
                        <a href='../view/payment.php?orderId=<?php echo base64_encode($orderId)?>' type="button" class="btn btn-sm btn-warning">Pay Now</a>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                                <?php
                    }else if($tRow["order_payment_status"]=='0'){
                        ?>
                                <tr>
                                    <td></td>
                                    <td style="font-weight: bold">Outstanding Amount</td>
                                    <td></td>
                                    <td style="font-weight: bold"><?php echo "Rs.".number_format($total,2); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        <a href='../view/payment.php?orderId=<?php echo base64_encode($orderId)?>' type="button" class="btn btn-sm btn-warning">Pay Now</a>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    
                        <?php
                    }
                    break;
                    
                case "loadProductOnSearch":
                    $seaechTxt="%".$_POST["seaechText"]."%";
                    $productResult=$productObj->searchProduct($seaechTxt);
                    ?>
                   <div class="row">
                    <?php 
                    $count=0;
                        While($pRow=$productResult->fetch_assoc()){
                            $pId= base64_encode($pRow["product_id"]);
                            ?>
                        <div class="col-md-3">
                            <div class="card" style="border-radius: 10px; margin: 10px 2px;padding: 10px;" >
                                <a href="view-product.php?pId=<?php echo $pId; ?>" style="text-decoration: none">
                                    <div><img width="100%" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow['product_img_1']; ?>"></div>
                                    <center>
                                        <h6 style="color: black; text-decoration: none;"><?php echo $pRow['product_name']; ?></h6>
                                        <?php $p_id=$pRow['product_id'];
                                        $productPrice=$productObj->getStatingPrice($p_id);
                                        $srow=$productPrice->fetch_assoc();
                                        ?>
                                        <p style="color: grey">Starting at Rs.<?php echo number_format($srow['startingPrice'],2); ?></p>
                                        <h6 style="color: black">Color : <?php echo $pRow['product_color']; ?> </h6>
                                    </center>
                                    
                                </a>
                            </div>
                        </div>
                        <?php 
                        $count++;
                            if($count%4==0){
                                ?>
                               </div>  
                    <div class="row">
                    <?php
                            }
                        ?>
                       
                                <?php
                        }
                    ?>
                </div>
                        <?php
                    break;
                    
                    case "giveFeedBack":
                        $orderId= base64_decode($_REQUEST["orderId"]);
                        include '../model/order-model.php';
                        $orderObj=new Order();
                        $productResult=$orderObj->getproductBy($orderId);
                        
                        $rate=$_POST["rate"];
                        $feedBack=$_POST["feedBack"];
                        while($pRow=$productResult->fetch_assoc()){
                            $orderObj->addfeedBack($pRow["product_id"], $pRow["cusId"], $rate, $feedBack);
                        }
                        header("Location:../view/home.php");
                        break;
        
}