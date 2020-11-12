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
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
    </head>
    <body style="margin: 0px; padding: 0px;">
        <div class="container-fluid" style="position: fixed; z-index: 1; background-color: white">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.png" height="35px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 10px;">
                        <a style="margin-right: 50px; color: orangered;" href="home.php">Home</a>
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
            </div>
        </div>
        <div style="height: 351.1Px; width: 100%; position: absolute; top: 65px; background-image: url(../../images/top-banner3.jpg); background-size: cover">
            <div class="row container">
                <div class="col-6" style="text-align: center; padding: 20px;">
                    
                        <p style="font-size: 50px; font-weight: bold; color: red">Add some glam to your gallery.</p>
                        <p style="font-size: 20px;">Shop new frame designs, including options with gold, silver, and browns finishers.</p>
                        <a class="btn btn-success" style="color: white;" href="shop.php">Shop Now</a>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/popper-1.16.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
</html>