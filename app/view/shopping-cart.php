<?php 
    include '../model/product-model.php';
    $productObj=new Product(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../DataTables-1.10.22/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="../../DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
    </head>
    <body style="margin: 0px; padding: 0px;background-color:">
        <div class="container-fluid" style="position: fixed; z-index: 1; background-color: white">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.jpg" height="35px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 10px;">
                        <a style="margin-right: 50px; color: black;" href="home.php">Home</a>
                        <a style="margin-right: 50px; color: black;" href="shop.php">Shop</a>
                        <a style="margin-right: 50px; color: black;" href="about.php">About</a>
                        <a style="margin-right: 50px; color: black;" href="contact.php">Contact</a>
                    </div>
                </div>
               <div class="col-md-2" style="text-align: right">
                    <div style="padding-top: 10px;">
                        <span class="fad fa-user-alt fa-2x"></span>
                                <a href="shopping-cart.php" class="fad fa-shopping-cart fa-2x notification" id="shopping-cart"></a>
                            <span class="badge" id="item_count">
                                  <?php
                            if(isset($_COOKIE["shopping_cart"])){
                                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                $cart_data = json_decode($cookie_data, true);

                                echo count($cart_data);
                            } else {
                                echo '0';
                            }
                                ?>
                            </span>
                            <span class="shopping-cart-contend" style="width: 400px;text-align: left; background-color: white; color: black; box-shadow: 2px 2px 10px 2px gray; border-radius: 5px;">
                                
                                <h4 class="mb-4" style="text-align: left">Shopping cart</h4>
                                <?php
                                if(isset($_COOKIE["shopping_cart"]))
                       {
                                    $no=1;
                            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                            $cart_data = json_decode($cookie_data, true);
                            foreach($cart_data as $keys => $values)
                        {
                                $pId=$values["pId"];
                                $sizeId=$values["pSizeId"];
                                $priceResult=$productObj->getPriceBySize($sizeId, $pId);
                                $sRow=$priceResult->fetch_assoc();
                                $itemResult=$productObj->getProduct($pId);
                                $iRow=$itemResult->fetch_assoc();
                                
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img width="80px" height="80px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $iRow["product_img_1"];?>">
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $iRow["product_name"];?>
                                    </div>
                                    <div class="col-md-1" >
                                      <a href="#" data-toggle="tooltip" data-placement="right" title="Remove"><span class="far fa-trash-alt remove-btn"></span></a>
                                    </div>
                                </div>
                                    <?php
                                
                            }
                       }
                            ?>
                      
                            </span>
                    </div>    
                </div>
            </div><hr style="margin-top: 0px; margin-bottom: 0px;">
            
            
        </div>
        <div class="container" style="padding-top: 90px">
            <h1>Shopping cart</h1><hr>
            <table class="table table-borderless" style="background-color: white">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                            <?php
            if(isset($_COOKIE["shopping_cart"]))
   {
                $no=1;
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values)
    {
                $pId=$values["pId"];
                $sizeId=$values["pSizeId"];
                $priceResult=$productObj->getPriceBySize($sizeId, $pId);
                $sRow=$priceResult->fetch_assoc();
                $productResult=$productObj->getProduct($pId);
                $pRow=$productResult->fetch_assoc();
            ?>
                    <tr>
                        
                        <td><?php echo $no; $no++ ?> </td>
                        <td>
                            <img width="80px" height="80px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow["product_img_1"]; ?>">
                        </td>
                        <td><?php echo $pRow["product_name"]?> </td>
                        <td><?php echo $values["pSizeId"];?> </td>
                        <td><?php echo $values["pQuantity"];?> </td>
                        <td>
                            <?php 
                        echo number_format($price=$sRow["product_price"],2) ;
                        ?>
                        </td>
                        <td>
                            <?php 
                        $price=$sRow["product_price"];
                        $qty=$values["pQuantity"];
                        echo number_format($price * $qty,2) ;
                        ?>
                        </td>
                        <th>
                            <a href="#" data-toggle="tooltip" data-placement="right" title="Remove"><span class="far fa-trash-alt remove-btn"></span></a>
                        </th>
                        
                    </tr>
                             <?php
        }
   }
 else {
     ?>
                    <tr><td colspan="4" style="text-align: center"><?php echo 'You don not have add any Product to the shopping cart'; ?></td></tr>   
                    <?php
   }
 ?>
                </tbody>
            </table>
   
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../js/popper-1.16.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</html>