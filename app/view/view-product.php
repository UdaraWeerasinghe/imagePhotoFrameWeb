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
        <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../DataTables-1.10.22/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="../../DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
    </head>
    <body style="margin: 0px; padding: 0px;background-color: #f9f8f4">
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
        <div class="container" style="padding-top: 80px">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="padding: 20px;">
                        <img width="100%" src="../../../ImagePhotoFrame/images/design_image/<?php echo $pRow['product_img_2'] ?>">
                    </div>
                </div>
                <div class="col-md-8" style="padding: 20px">
                    <div>
                        <h1><?php echo $pRow['product_name']; ?></h1>
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
                                    <h5>Rs. <?php echo number_format($spRow['startingPrice'],2)?></h5>
                                </div>
                                <hr>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-4"><label>Select width and height :</label></div>
                                <div class="col-md-3">
                                       <select class="form-control">
                                          <?php
                                            while ($psRow=$sizeResult->fetch_assoc()){
                                                  ?>
                                           <option><?php echo $psRow['width']."&Prime;"."&#215;".$psRow['height']."&Prime;";?></option>
                                            <?php } ?>
                                       </select>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                     <label>Quantity :</label>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <input type="number" value="1" class="form-control" min="0" onkeypress="return isNumberKey(event)" style="text-align: center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                </div>
                                <div class="col-md-6" style="text-align: end">
                                    <label style="font-weight: bold">TOTAL COST : Rs. 450.00</label>
                                </div>
                            </div>
                    </div>
                    <div>
                        <input type="button" class="form-control btn btn-warning" value="ADD TO CART">
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
    function isNumberKey(event){
          let charCode = (event.which)?event.which:event.keyCode;
          if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
        return true;
          
      }
      </script>
</html>