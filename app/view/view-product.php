<?php
    include '../model/product-model.php';
    $productObj=new Product();
    $productResult=$productObj->getAllProduct();
    $scatResult=$productObj->getAllSubCategory();
    $colorResult=$productObj->getAllColor();
    $materialResult=$productObj->getAllMaterial();
    $pId=$_REQUEST['pId'];
    $viewProductResult=$productObj->getProduct($pId);
    $productPrice=$productObj->getStatingPrice($pId);
    $pRow=$viewProductResult->fetch_assoc();
    $subCatId = $pRow['sub_cat_id'];
    $sizeResult=$productObj->getSizeByType($subCatId);

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
    <body style="margin: 0px; padding: 0px;">
        <div class="container-fluid" style="position: fixed; z-index: 1; background-color: white">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.jpg" height="35px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 10px;">
                        <a href="home.php" style="margin-right: 50px; color: black;">Home</a>
                        <a href="shop.php" style="margin-right: 50px; color: orangered;">Shop</a>
                        <a href="about.php" style="margin-right: 50px; color: black;">About</a>
                        <a href="contact.php" style="margin-right: 50px; color: black;">Contact</a>
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
                                        <select class="form-control" id="frameSize" name="frameSize">
                                              <?php
                                                while ($psRow=$sizeResult->fetch_assoc()){
                                                      ?>
                                            <option value="<?php echo $psRow['size_id']; ?>"><?php echo $psRow['width']."&Prime;"."&#215;".$psRow['height']."&Prime;";?></option>
                                                <?php } ?>
                                           </select>
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
                            <input type="button" id="add_to_cart" name="add_to_cart" class="form-control btn btn-primary" value="ADD TO CART">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
</html>