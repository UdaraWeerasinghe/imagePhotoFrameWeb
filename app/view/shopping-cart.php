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
                        <span id="user_icon">
                            <a href="#" class="fad fa-user-alt fa-2x notification"></a>
                        <span>
                            <?php
                            session_start();
                            if(isset($_SESSION['customer'])){
                                ?>
                            <label><?php echo $_SESSION['customer']['customer_fName'] ?></label>
                            <?php
                            }
                            ?>
                            
                        </span>
                        <span>
                        <span>&nbsp;</span>
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
                                
                            <span class="user-contend">
                                <ul style="list-style: none; margin: 0px;padding: 0px;">
                                    <li>
                                        <i class="fas fa-user"></i>
                                        &nbsp;Profile
                                    </li>
                                    <hr>
                                    <li class="btn btn-warning form-control">
                                        <i class="far fa-sign-out-alt"></i>&nbsp;
                                        <a href="../controller/login-controller.php?status=logout" style="text-decoration: none; color: black">Logout</a>
                                    </li>
                                </ul>
                                
                            </span>
                                
                                
                            <span class="shopping-cart-contend">
                                    <div class="cart-list" id="cart-list">
                                        <div class="cart-list-item">
                                            <h4 class="mb-4" style="text-align: left">Shopping cart</h4>
                                             <?php
                                if(isset($_COOKIE["shopping_cart"]))
                       {
                                    $no=1;
                            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                            $cart_data = json_decode($cookie_data, true);
                            
                            if(count($cart_data)!==0){
                                foreach($cart_data as $keys => $values)
                        {
                                $pId=$values["pId"];
                                $sizeId=$values["pSizeId"];
                                $priceResult=$productObj->getPriceBySize($sizeId, $pId);
                                $sRow=$priceResult->fetch_assoc();
                                $itemResult=$productObj->getProduct($pId);
                                $iRow=$itemResult->fetch_assoc();
                                $sResult=$productObj->getSize($sizeId);
                                $sizeRow=$sResult->fetch_assoc();
                                
                                ?>
                                <div style="padding: 0px;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img width="60px" height="60px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $iRow["product_img_1"];?>">
                                        </div>
                                        <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <a href="view-product.php?pId=<?php echo base64_encode($iRow["product_id"]); ?>">
                                                            <p style="font-size: 14px; color: #588b8b"><?php echo $iRow["product_name"]."(".$sizeRow['width']."&Prime;"."&#215;".$sizeRow['height']."&Prime;".")"; ?><p>
                                                            <p style="font-size: 14px; color: #588b8b; margin-top: -14px;">Qty: <?php echo $values["pQuantity"];?></p>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <a  onclick="load_data('<?php echo $values["psId"]; ?>')">
                                                        <span class="far fa-trash-alt remove-btn">
                                                        </span>
                                                    </a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                            }
                            }
                        else {
                                ?>
                                    <div class="row">
                                        <div class="col-12 mb-2" style="text-align: center">The Shopping Cart is Empty!</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="text-align: center">
                                            <a class="btn " style="color: orangered">Please Sign in</a>
                                        </div>
                                    </div>
                                    <?php
                        }
                            
                            
                       }
                       ?>
                                        </div>
                                        <div style="padding: 10px;">
                                            <a href="shopping-cart.php" class="btn btn-warning form-control">View Cart</a>
                                        </div>
                                    </div>
                                    
                                </span>
                    </div>    
                </div>
            </div>
            
            
        </div>
        <?php 
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        ?>
        <form method="post" action="../controller/cart-controller.php?status=proceedToCheckout">
        <div class="container" style="padding-top: 90px">
            <div class="row">
                <div class="col-md-9">
                    <div class="card" style="padding: 10px;">
                            <h3>Shopping cart (<?php echo count($cart_data); ?>)</h3><hr>
                    <div id="cart-tbl">
                        <?php
                            if(isset($_COOKIE["shopping_cart"])){
                                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                $cart_data = json_decode($cookie_data, true);

                                if(count($cart_data)>0){
                                    ?>
                                <table id="cart-table-data" class="table table-borderless" style="background-color: white">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Unt.Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                        <?php
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
                            
                        ?>

                                <tr>

                                    <td><?php echo $no; $no++ ?> </td>
                                    <td>
                                        <img width="80px" height="80px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow["product_img_1"]; ?>">
                                    </td>
                                    <?php 
                                    
                                    ?>
                                    <td><a href="view-product.php?sId=<?php echo base64_encode($sizeId);?>&pId=<?php echo base64_encode($pId); ?>"style=" color: black"><?php echo $pRow["product_name"]?> </a></td>
                                    <td><?php echo $psRow['width']."&Prime;"."&#215;".$psRow['height']."&Prime;"; ?></td>
                                    <td>
                                        <?php echo $values["pQuantity"];?>
                                    </td>
                                    <td>
                                        <?php 
                                    echo number_format($price=$sRow["product_price"],2) ;
                                    ?>
                                    </td>
                                    <td  id="pTotal">
                                        <?php 
                                    $price=$sRow["product_price"];
                                    $qty=$values["pQuantity"];
                                    echo number_format($price * $qty,2);
                                    $total=$total+($price*$qty);
                                    ?>
                                    </td>
                                    <th>
                                        <a  onclick="load_data(<?php echo $values["psId"]; ?>)">
                                            <span class="far fa-trash-alt remove-btn">
                                            </span>
                                        </a>
                                    </th>

                                </tr>
                                         
            <?php
                    }
               }
             ?>
                            </tbody>
                        </table>
                        <?php
                                }
                                    else {
                                    ?>
                        <span id="cart-table-data">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4 mb-4" style="padding-top: 50px; padding-left: 10%;">
                                    <span class="far fa-shopping-cart fa-8x"></span>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6" style="text-align: center">
                                    <h3>Your shopping cart is empty.</h3>
                                    <a  class="btn btn-warning" style="margin-top: 10px;"> Sign in to view your cart</a>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </span>

                        <?php
                                    }

                            }
                            else{
                                ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mb-4" style="padding-top: 50px; padding-left: 10%;">
                                <span class="far fa-shopping-cart fa-8x"></span>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="text-align: center">
                                <h3>Your shopping cart is empty.</h3>
                                <a class="btn btn-warning" style="margin-top: 10px;"> Sign in to view your cart</a>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>
                    </div>
                </div>
                <div class="col-md-3" id="order_summery">
                    <div id="total"  class="card" style="padding: 15px;">
                        <h4>Order summary</h4><hr>
                        <?php
                        if(isset($_COOKIE["shopping_cart"]))
               {
                        ?>
                        <div class="row">
                            <div class="col-5">Total (<?php echo count($cart_data); ?>)</div>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.<?php  echo number_format($total,2);?></label>
                            </div>
                        </div>
                        <hr style="margin-top: 0px;">
                        <div class="row" style="font-weight: bold">
                            <div class="col-5">Subtotal</div>
                            <?php $discount=0; ?>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.<?php  echo $subTotal=number_format($total-$discount,2);?></label>
                            </div>
                            <input type="hidden" name="sub_total" value="<?php echo $total-$discount; ?>">
                        </div>
                        <input type="submit" class="btn btn-warning" value="Proceed to Checkout">
                        <?php
                        } else {?>
                        <div class="row">
                            <div class="col-5">Total 0</div>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.00.00</label>
                            </div>
                        </div>
                        <hr style="margin-top: 0px;">
                        <div class="row" style="font-weight: bold">
                            <div class="col-5">Subtotal</div>
                            <div class="col-7" style="text-align: end">
                                <label>Rs.00.00</label>
                            </div>
                            <input type="hidden" name="sub_total" value="00.00">
                        </div>
                        <input id="proceedTocheckout" class="btn btn-warning" value="Proceed to Checkout">
                        <?php    
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
            
        </div>
        </form>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../js/popper-1.16.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
    <script>
</script>
</html>