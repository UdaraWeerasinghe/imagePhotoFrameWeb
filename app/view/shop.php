<?php
    include '../model/product-model.php';
    $productObj=new Product();
    $productResult=$productObj->getAllProduct();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css"> 
    </head>
    <body style="margin: 0px; padding: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.jpg" height="60px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 25px;">
                        <a style="margin-right: 50px; color: black;" href="home.php">Home</a>
                        <a style="margin-right: 50px; color: orangered;" href="shop.php">Shop</a>
                        <a style="margin-right: 50px; color: black;" href="about.php">About</a>
                        <a style="margin-right: 50px; color: black;" href="contact.php">Contact</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <hr>
            
        </div>
        <div class="row container-fluid">
            <div class="col-md-3">
                <div></div>
            </div>
            <div class="col-md-9">
                <div>
                    <div class="row">
                    <?php 
                    $count=0;
                        While($pRow=$productResult->fetch_assoc()){
                            ?>
                        <div class="col-md-3">
                            <div style="box-shadow: 2px 2px 10px 2px gray; border-radius: 10px; margin: 10px 2px;padding: 10px;">
                                <a href="#" style="text-decoration: none">
                                    <div><img width="200px" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow['product_img_1']; ?>"></div>
                                    <center>
                                        <h6 style="color: black; text-decoration: none;"><?php echo $pRow['product_name']; ?></h6>
                                        <?php $p_id=$pRow['product_id'];
                                        $productPrice=$productObj->getStatingPrice($p_id);
                                        $srow=$productPrice->fetch_assoc();
                                        ?>
                                        <p style="color: grey">Starting at Rs.<?php echo $srow['startingPrice']; ?></p>
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
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
</html>