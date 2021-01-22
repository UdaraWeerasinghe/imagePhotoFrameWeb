<?php 
    session_start();
    include '../model/product-model.php';
    $productObj=new Product(); 
    include '../model/cart-model.php';
    $cartObj=new Cart();
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
                    
                </div>
               <div class="col-md-2" style="text-align: right">
                       
                </div>
            </div>
            
            
        </div>
        <div class="container" style="padding-top: 90px;">
            <div style="background-color: white; padding: 10px;" class="card">
                <div>
                    <form method="post" action="../controller/cart-controller.php?status=payment">
                        <h3>Payment Details</h3>
                        <hr>
                        <?php
                            $orderId= base64_decode($_REQUEST["orderId"]); 
                            $orderResult=$cartObj->getOrdeTotal($orderId);
                            $oRow=$orderResult->fetch_assoc();
                            $subTotal=$oRow["order_sub_total"];
                            
                            if($oRow["order_payment_status"]=='0'){
                                ?>
                        <div class="row">
                            <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
                            <div class="col-md-5">
                                <p>How you going to do the payment?</p>
                            </div>
                            <div class="col-md-4">
                                <label><input type="radio" name="payment_option" id="full" value="1"  checked>&nbsp;&nbsp; Full amount</label>
                            </div>
                            <div class="col-md-3">
                                <label><input type="radio" name="payment_option" id="half" value="2">&nbsp;&nbsp; 50% from the full amount</label>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        <div>
                                <span style="font-size: 23px; font-weight: bold">
                                    Payable Amount
                                </span>
                                <span id="total" style="font-size: 27px; color: orangered; font-weight: bold">
                                    Rs.<?php echo number_format($subTotal,2); ?>
                                    <input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal; ?>">
                                </span>
                        </div>
                        <?php
                            }else if($oRow["order_payment_status"]=='2'){
                                ?>
                        <div class="row">
                            <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
                            <input type="hidden" name="payment_option" value="3">
                        </div>
                        <div>&nbsp;</div>
                        <div>
                                <span style="font-size: 23px; font-weight: bold">
                                    Payable Amount
                                </span>
                                <span id="total" style="font-size: 27px; color: orangered; font-weight: bold">
                                    Rs.<?php echo number_format($subTotal/2,2); ?>
                                    <input type="hidden" id="subTotal" name="subTotal" value="<?php echo $subTotal/2; ?>">
                                </span>
                        </div>
                        <?php
                            }
                            ?>
                        <div>&nbsp;</div>
                        <div style="margin-top: 30px;">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h5>Credit or Debit Card Details</h5>
                                </div>
                                <div class="col-md-3"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label style="font-weight: bold; margin-top: 10px;">Name on card </label><br>
                                    <input type="text" class="form-control">  

                                    <label style="font-weight: bold; margin-top: 10px;">Card Number </label><br>
                                    <input type="text" class="form-control"> 

                                    <div class="row">
                                        <div class="col-3">
                                            <div style="padding: 0px 10px 0px 0px">
                                                <label style="font-weight: bold; margin-top: 10px;">CVC</label><br>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div style="padding: 0px 10px 0px 0px">
                                                <label style="font-weight: bold; margin-top: 10px;">Expiration </label><br>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div style="text-align: end">
                                        <input type="submit" class="btn btn-warning" value="Pay Now">
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/sweetalert2.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
    <script>
        $("#half").click(function () {
            
        var url = "../controller/cart-controller.php?status=loadHalfPrice";
        var subTotal = $("#subTotal").val();
        $.post(url, {subTotal:subTotal}, function (data){
            $("#total").html(data).show();
        });
    });
    $("#full").click(function () {
          
        var url = "../controller/cart-controller.php?status=loadFullPrice";
        var subTotal = $("#subTotal").val();
        $.post(url, {subTotal:subTotal}, function (data){
            $("#total").html(data).show();
        });
    });
    </script>
</html>