<?php
    include '../model/product-model.php';
    $productObj=new Product();
    $productResult=$productObj->getAllProduct(); //load all product
    $scatResult=$productObj->getAllSubCategory();
    $colorResult=$productObj->getAllColor();
    $materialResult=$productObj->getAllMaterial();  ///get product materials
    $pId= base64_decode($_REQUEST['pId']);
    $viewProductResult=$productObj->getProduct($pId);
    $productPrice=$productObj->getStatingPrice($pId);
    $pRow=$viewProductResult->fetch_assoc();
    $subCatId = $pRow['sub_cat_id'];
    $sizeResult=$productObj->getSizeByType($subCatId);
    $feedBackResul=$productObj->selectFeedback($pId);

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
                        <a href="home.php" style="margin-right: 50px; color: black;">Home</a>
                        <a href="shop.php" style="margin-right: 50px; color: orangered;">Shop</a>
                        <a href="about.php" style="margin-right: 50px; color: black;">About</a>
                        <a href="contact.php" style="margin-right: 50px; color: black;">Contact</a>
                    </div>
                </div>
                <div class="col-md-2" style="text-align: right;">
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
                                        <a href="../controller/login-controller.php?status=logout" style="text-decoration: none; color: black"> <?php 
                                            if(isset($_SESSION["customer"])){
                                                echo 'Logout';
                                            }else{
                                                echo 'Login';
                                            }
                                            ?></a>
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
            </div><hr style="margin-top: 0px; margin-bottom: 0px;">
            
            
        </div>
        <div class="container" style="padding-top: 90px">
            <div class="row">
                <div class="col-md-4" style="padding: 15px;">
                    <div class="card" style="padding: 20px;">
                        <img width="100%" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow['product_img_1'] ?>">
                    </div>
                </div>
                <div class="col-md-8" style="padding: 0px 20px">
                    <form method="post">
                        <div>
                            <h1><?php echo $pRow['product_name']; ?></h1>
                            <input id="pName" name="pName" type="hidden" value="<?php echo $pRow['product_name']; ?>">
                            <input id="pId" name="pId" type="hidden" value="<?php echo $pRow['product_id']; ?>">
                        </div>
                        <div class="mb-4" style="padding: 20px; border: #cccccc solid 1px; border-radius: 5px; background-color: white">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6>Frame <?php echo $pRow['product_code'].", ".$pRow['product_color'] ?></h6> 
                                    </div>
                                    <div class="col-md-3" style="text-align: end">
                                                        <?php
                                        $spRow=$productPrice->fetch_assoc();
                                        ?>

                                    </div>
                                    <hr>
                                </div><hr>
                                <div class="row">
                                    <div class="col-md-4"><label>Select width and height :</label></div>
                                    <div class="col-md-3">
                                        <?php
                                        if(isset($_GET['sId'])){
                                            ?>
                                        <select class="form-control" id="frameSize" name="frameSize">
                                              <?php
                                               $sResult=$productObj->getSize(base64_decode($_REQUEST['sId']));
                                               $psRow=$sResult->fetch_assoc();
                                                      ?>
                                            <option value="<?php echo $psRow['size_id']; ?>"><?php echo $psRow['width']."&Prime;"."&#215;".$psRow['height']."&Prime;";?></option>
                                               
                                           </select>
                                        <?php
                                        }
                                        else{
                                            ?>
                                        <select class="form-control" id="frameSize" name="frameSize">
                                              <?php
                                                while ($psRow=$sizeResult->fetch_assoc()){
                                                      ?>
                                            <option value="<?php echo $psRow['size_id']; ?>"><?php echo $psRow['width']."&Prime;"."&#215;".$psRow['height']."&Prime;";?></option>
                                                <?php } ?>
                                           </select>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">
                                         <label>Quantity :</label>
                                    </div>
                                    <div class="col-md-2 mb-4">
                                        <input id="pQuantity" name="pQuantity" type="number" value="1" class="form-control" min="0" onkeypress="return isNumberKey(event)" style="text-align: center">
                                    </div>
                                </div>
                                <div class="row"  id="price">
                                    <div class="col-md-6">
                                        <label style="font-weight: bold">Unit price : Rs. <?php echo number_format($spRow['startingPrice'],2)?></label>
                                       
                                    </div>
                                    <div class="col-md-6" style="text-align: end">
                                        <label style="font-weight: bold">TOTAL COST : Rs. <?php echo number_format($spRow['startingPrice'],2)?></label>
                                    </div>
                                </div>
                        </div>
                        <div>
                            <input type="button" id="add_to_cart" name="add_to_cart" class="form-control btn btn-warning" value="ADD TO CART">
                        </div>
                    </form>
                </div>
                
            </div>
            <h3 style="margin: 20px; text-align: center">Customer Feedback</h3>
            <?php
            if($feedBackResul->num_rows>0){
                while($fRow=$feedBackResul->fetch_assoc()){
                    $cusResult=$productObj->getCustomerById($fRow["customer_id"]);
                    $cusRow=$cusResult->fetch_assoc();
                ?>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <lable><b><?php echo $cusRow["customer_fName"]." ".$cusRow["customer_lName"]; ?></b></lable><br>
                    <label
                        <?php
                        for ($x = 1; $x <= 5; $x++) {
                            if($fRow["rating"]>=$x){
                               ?>
                        <i class="fas fa-star" style="color: orange"></i>
                        <?php 
                            }else{
                                ?>
                        <i class="fal fa-star" style="color: orange"></i>
                        <?php
                            }
                            
                        }
                        ?>
                    </label><br>
                    <label><?php echo $fRow["feedback_msg"]; ?></label>
                </div>
                <div class="col-3"></div>
            </div>
            <?php
                }
            }else{
                ?>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">Does not have any feedback</div>
                <div class="col-3"></div>
            </div>
            <?php 
            }
            ?>
            
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/sweetalert2.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
  
</html>