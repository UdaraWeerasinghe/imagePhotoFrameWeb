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
                        <a style="margin-right: 50px; color: black;" href="home.php">Home</a>
                        <a style="margin-right: 50px; color: black" href="shop.php">Shop</a>
                        <a style="margin-right: 50px; color: black;" href="about.php">About</a>
                        <a style="margin-right: 50px; color: orangered;" href="contact.php">Contact</a>
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
                                    </li><hr>
                                     <li>
                                        <i class="fas fa-bags-shopping"></i>
                                        &nbsp;<a href="order.php">My orders</a>
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
                                                      <a  onclick="load_data(<?php echo $values["psId"]; ?>)">
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
        <div class="row container-fluid" style="padding-top: 64px;">
            <div class="container"style="padding-top :50px;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 card" style="padding: 50px;">
                    <h4 align="center" style="margin-bottom: 50px;">Drop A Message</h4>
                    
                    <form id="dropMsg">
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label>Name</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control">
                                <div class="invalid-tooltip" id="nameTooltip" style="position: initial;"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label>Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="email" id="email" class="form-control">
                                <div class="invalid-tooltip" id="emailTooltip" style="position: initial;"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label>Contact No</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="cno" id="cno" class="form-control">
                                <div class="invalid-tooltip" id="cnoTooltip" style="position: initial;"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label>Subject</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="subject" id="subject" class="form-control">
                                <div class="invalid-tooltip" id="subjectTooltip" style="position: initial;"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label>Message</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea name="msg" id="msg" class="form-control"></textarea>
                                <div class="invalid-tooltip" id="msgTooltip" style="position: initial;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="text-align: right">
                                <button class="btn btn-primary btn-sm">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                </div>   
            </div>
        </div>
                        
        </div>
        </div>
<?php
                       include 'footer.php';
                       ?>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
    <script type="text/javascript" src="../../js/sweetalert2.js"></script>
    <script>
        $('#dropMsg').on('submit', function (e) {
            var name=$("#name").val();
            var email=$("#email").val();
            var cno=$("#cno").val();
            var subject=$("#subject").val();
            var msg=$("#msg").val();
            
            var name_ptn = /^[a-zA-Z]{1,}$/;
            var email_ptn = /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
            var cno_ptn = /^[0]\d{9}$/;
            
            if(name==""){
            $("#nameTooltip").html("Please enter the  name");
            $("#name").addClass("is-invalid");
                return false;
                }else{
                    $("#name").removeClass("is-invalid");
                    $("#name").addClass("is-valid");
                }
            if (!name.match(name_ptn)){
            $("#nameTooltip").html("Please enter valid name");
            $("#name").addClass("is-invalid");
            return false;
        } else{
            $("#name").removeClass("is-invalid");
            $("#name").addClass("is-valid");
        }
        
        if(email==""){
            $("#emailTooltip").html("Please enter the email address");
            $("#email").addClass("is-invalid");
                return false;
                }else{
                    $("#email").removeClass("is-invalid");
                    $("#email").addClass("is-valid");
                }
            if (!email.match(email_ptn)){
            $("#emailTooltip").html("Please enter valid email address");
            $("#email").addClass("is-invalid");
            return false;
        } else{
            $("#email").removeClass("is-invalid");
            $("#email").addClass("is-valid");
        }
        
        if(cno==""){
            $("#cnoTooltip").html("Please enter the contact number");
            $("#cno").addClass("is-invalid");
                return false;
                }else{
                    $("#cno").removeClass("is-invalid");
                    $("#cno").addClass("is-valid");
                }
            if (!cno.match(cno_ptn)){
            $("#cnoTooltip").html("Please enter valid contact number");
            $("#cno").addClass("is-invalid");
            return false;
        } else{
            $("#email").removeClass("is-invalid");
            $("#email").addClass("is-valid");
        }
        
        if(subject==""){
            $("#subjectTooltip").html("Please enter the subject");
            $("#subject").addClass("is-invalid");
                return false;
                }else{
                    $("#subject").removeClass("is-invalid");
                    $("#subject").addClass("is-valid");
                }
        if(msg==""){
            $("#msgTooltip").html("Please enter the Message");
            $("#msg").addClass("is-invalid");
                return false;
                }else{
                    $("#msg").removeClass("is-invalid");
                    $("#msg").addClass("is-valid");
                }
            
            e.preventDefault();
            $.ajax({
            type: 'post',
            url: '../controller/customer-controller.php?status=dropMsg',
            data: $('#dropMsg').serialize(),
            success: function (result) {
                
                if(result=="success"){
                    console.log(result);
                       Swal.fire({
                        icon: 'success',
                        title: 'Sent',
                        text: 'Message successfully sent',
                        showConfirmButton: true
                        
                      });
                }
                $('#dropMsg')[0].reset();
            }
        });
        });
$("#dropMsg").keyup(function(){
        $("#name").removeClass("is-invalid");
        $("#email").removeClass("is-invalid");
        $("#cno").removeClass("is-invalid");
        $("#subject").removeClass("is-invalid");
        $("#msg").removeClass("is-invalid");
});
    </script>