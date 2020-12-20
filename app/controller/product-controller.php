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
     $psId=$_POST["pId"].$_POST["size_id"]; //get the unic id for increse qty with out add add  as new productto cart
	
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
                                
                                echo count($cart_data);
                        } 
            }
            break;
            case "changePrice":
                $price=$_POST['unitPrice'];
                $qty=$_POST['qty'];
                echo number_format($price * $qty,2);
                $total=$price*$qty;
                                    
                break;
        
}