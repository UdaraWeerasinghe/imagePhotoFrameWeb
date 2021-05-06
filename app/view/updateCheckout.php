<?php 
    session_start();
    include '../model/product-model.php';
    $productObj=new Product(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
    </head>
    <body style="margin: 0px; padding: 0px;background-color: #f5f6f8">
        <div class="container-fluid" style="position: fixed; z-index: 1; background-color: white">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.png" height="35px;" style="margin: 10px;">
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
                            <span class="shopping-cart-contend" style="width: 420px;text-align: left; background-color: white; color: black; box-shadow: 2px 2px 10px 2px gray; border-radius: 5px;">
                                
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
                                <a>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img width="80px" height="80px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $iRow["product_img_1"];?>">
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $iRow["product_name"];?>
                                    </div>
                                    <div class="col-md-1" >
                                      <a href="#"><span class="far fa-trash-alt remove-btn"></span></a>
                                    </div>
                                </div>
                                    <?php
                                
                            }
                       }
                            ?>
                            </span>
                    </div>    
                </div>
            </div>
            
            
        </div>
        <?php 
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        ?>
        <div class="container" style="padding-top: 90px">
            <div class="row">
                <div class="col-md-9">
                    <div class="card" style="padding: 10px;">
                            <h3>Checkout (<?php echo count($cart_data); ?>&nbsp;items)</h3><hr>
                            
                        <?php
                            if(isset($_COOKIE["shopping_cart"])){
                                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                $cart_data = json_decode($cookie_data, true);

                                if(count($cart_data)>0){
                                    
                        if(isset($_COOKIE["shopping_cart"]))
               {
                            $no=1;
                            $total=0;
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
                            $pSizeResult=$productObj->getSize($sizeId);
                            $psRow=$pSizeResult->fetch_assoc();
                            
                            $values["pQuantity"];
                            $price=$sRow["product_price"];
                            $qty=$values["pQuantity"];
                            $total=$total+($price*$qty);
                                    
                    }
               }
                                }

                            }
                        ?>
                        <form method="post" action="../controller/">
                            <div style="padding: 20px;">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <lable>First Name</lable>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_fName']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <lable>Last Name</lable>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_lName']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <lable>Phone Number</lable>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" value="<?php echo $_SESSION['customer']['customer_tel']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <lable>Email</lable>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" value="<?php echo $_SESSION['customer']['customer_email']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <lable>Address</lable>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_address']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4">
                                        <lable>Latitude</lable>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <lable>Longitude</lable>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-12" style="text-align: end; margin-top: 20px;">
                                        <input type="submit" class="btn btn-success" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3" id="order_summery">
                    <div id="total"  class="card" style="padding: 15px;">
                        <h4>Order summary</h4><hr>
                        <div class="row">
                            <div class="col-5">Total (<?php echo count($cart_data); ?>)</div>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.<?php  echo number_format($total,2);?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">Discount</div>
                            <div class="col-7" style="text-align: end">
                                <?php
                                $discount=0;
                                $price=0;
                                    if ($total>$price){
                                        ?>
                                        <label>Rs.<?php  echo number_format($discount,2);?></label>
                                        <?php
                                    } else {
                                        ?>
                                        <label>Rs.<?php  echo number_format(0,2);?></label>
                                        <?php
                                    }
                                 ?>
                                
                            </div>
                        </div>
                        <hr style="margin-top: 0px;">
                        <div class="row" style="font-weight: bold">
                            <div class="col-5">Subtotal</div>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.<?php  echo number_format($total-$discount,2);?></label>
                            </div>
                        </div>
                        <a href="../view/checkout.php" class="btn btn-warning">Place Order</a>
                    </div>
                </div>
            </div>
            
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
    <script>
        
        $('#createAccForm').on('submit', function (e) {
            var name=$("#name").val();
            
        });
    </script>
   
</html>