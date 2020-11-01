<?php
    include '../model/product-model.php';
    $productObj=new Product();
    $productResult=$productObj->getAllProduct();
    $scatResult=$productObj->getAllSubCategory();
    $colorResult=$productObj->getAllColor();
    $materialResult=$productObj->getAllMaterial();
    
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../DataTables-1.10.22/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="../../DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
    </head>
    <body style="margin: 0px; padding: 0px;">
        <div class="container-fluid" style="position: fixed; z-index: 1; background-color: white">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.jpg" height="35px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 10px;">
                        <a style="margin-right: 50px; color: black;" href="home.php">Home</a>
                        <a style="margin-right: 50px; color: orangered;" href="shop.php">Shop</a>
                        <a style="margin-right: 50px; color: black;" href="about.php">About</a>
                        <a style="margin-right: 50px; color: black;" href="contact.php">Contact</a>
                    </div>
                </div>
                <div class="col-md-2" style="text-align: right">
                    <div style="padding-top: 10px;">
                        <span class="fad fa-user-alt fa-2x"></span>
                        <span class="fad fa-shopping-cart fa-2x"></span>
                    </div>    
                </div>
            </div>
            
            
        </div>
        <div class="row container-fluid" style="position: absolute; top: 60px;">
            <div class="col-md-3">
                <div>
                    <h5>CATEGORIES</h5><hr>
                    <div style="padding-left: 50px; padding-bottom: 10px;">
                        <?php 
                        while ($scRow=$scatResult->fetch_assoc()){
                        ?>
                        <label><input type="checkbox">&nbsp;<?php echo $scRow['sub_cat_name']; ?></label><br>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
                <div>
                    <h5>MATERIAL</h5><hr>
                    <div style="padding-left: 50px; padding-bottom: 10px;">
                       <?php
                                               while ($mRow=$materialResult->fetch_assoc()){
                                                   ?>
                        <label><input type="checkbox">&nbsp;<?php echo $mRow['cat_name']; ?></label><br>
                        <?php
                                               }
                       ?>
                        
                    </div>
                    
                </div>
                
                <div>
                    <h5>COLOR</h5><hr>
                    <div style="padding-left: 50px; padding-bottom: 10px;">
                       <?php
                                               while ($cRow=$colorResult->fetch_assoc()){
                                                   ?>
                        <label><input type="checkbox">&nbsp;<?php echo $cRow['product_color']; ?></label><br>
                        <?php
                                               }
                       ?>
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-2">
                       
                    </div>
                    <div class="col-md-3">
                       
                    </div>
                    <div class="col-md-1"></div>
                     <div class="col-md-4 mb-4">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fad fa-search"></i></span>
                            </div>
                            <input type="search" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Search</button>
                    </div>
                   
                </div>
                <div>
                    <div class="row">
                    <?php 
                    $count=0;
                        While($pRow=$productResult->fetch_assoc()){
                            ?>
                        <div class="col-md-3">
                            <div style="box-shadow: 2px 2px 10px 2px gray; border-radius: 10px; margin: 10px 2px;padding: 10px;">
                                <a href="view-product.php?pId=<?php echo $pRow['product_id']; ?>" style="text-decoration: none">
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
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
</html>