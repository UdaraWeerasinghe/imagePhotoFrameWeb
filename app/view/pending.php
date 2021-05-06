<?php 
session_start();
$customerId=$_SESSION["customer"]["customer_id"];
    include '../model/product-model.php';
    $productObj=new Product(); 
    
    include '../model/order-model.php';
    $orderObj=new Order();
    $orderResult=$orderObj->getPendingOrdeByCustomer($customerId);
    
    if(isset($_GET["alert"])){
        ?>
        <input type="hidden" id="alert" value="sucess">
    <?php
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../DataTables-1.10.22/css/dataTables.bootstrap4.css"/>
        
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
            </div>
            
            
        </div>
        <div class="container"style="padding-top: 90px">
            <div class="card" style="background-color: white; padding: 10px;">
                <h3>Order Details</h3>
                <!--<hr>-->
                
                <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                  <li class="nav-item">
                      <a class="nav-link" href="order.php">All</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" href="pending.php">Pending</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="processing.php">Processing</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="completed.php">Completed</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="shipped.php">Shipped</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="received.php">Received</a>
                  </li>
                </ul>
                
                <table class="table table-hover" id="order_tbl">
                    <thead class="table-info">
                        <tr>
                            <th>Order Id</th>
                            <th>Date</th>
                            <th>Sub Total</th>
                            <th>Due Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                    while ($oderRow=$orderResult->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $oderRow["order_id"];?></td>
                            <td>
                                <?php
                                $timestamp = strtotime($oderRow["order_timestamp"]);
                               echo $date = date('d-m-Y', $timestamp);
//                               $time = date('h:i:sa', $timestamp);
                                
                                ?>
                            </td>
                            
                            <td>
                                <?php echo "Rs.".number_format($oderRow["order_sub_total"],2);?>
                            </td>
                            <td>
                                <?php 
                                if($oderRow["order_payment_status"]==0){
                                    ?>
                                <span style="color: red"><?php echo "Rs.".number_format($oderRow["order_sub_total"],2);?></span>
                                <?php
                                } 
                                elseif ($oderRow["order_payment_status"]==1) {
                                ?>
                                <span style="color: green"><?php echo "Rs.".number_format(0,2);?></span>
                                
                                <?php
                            }
                                else {
                                   ?>
                                <span style="color: orangered"><?php echo "Rs.".number_format($oderRow["order_sub_total"]/2,2);?></span>
                                <?php 
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($oderRow["order_status"]==1){
                                    ?>
                                <span class="label label-warning">Pending</span>
                                <?php
                                }
                                elseif ($oderRow["order_status"]==2) {
                                ?>
                                <span class="label label-warning">Processing</span>
                                <?php
                            }elseif ($oderRow["order_status"]==3) {
                                ?>
                                <span class="label label-warning">Wating for payment</span>
                                <?php
                            }elseif ($oderRow["order_status"]==4) {
                                ?>
                                <span class="label label-warning">Ready to delivery</span>
                                <?php
                            }elseif ($oderRow["order_status"]==5) {
                                ?>
                                <span class="label label-warning">On delivery</span>
                                <?php
                            }elseif ($oderRow["order_status"]==6) {
                                ?>
                                <span class="label label-warning">Completed</span>
                                <?php
                            }
                                ?>
                            </td>
                            <td>
                                <?php if($oderRow["order_payment_status"]==1){
                                    ?>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view" onclick="viewOrder('<?php echo $oderRow["order_id"];?>')">View</button>
                                <?php
                                }
                                elseif ($oderRow["order_payment_status"]==2) {
                                ?>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view" onclick="viewOrder('<?php echo $oderRow["order_id"];?>')">View</button>
                                <a href='payment.php?orderId=<?php echo base64_encode($oderRow["order_id"])?>' type="button" class="btn btn-sm btn-warning">Pay Now</a>
                                <?php
                            }
                                else {
                                    ?>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#view" onclick="viewOrder('<?php echo $oderRow["order_id"];?>')">View</button>
                                <a href='payment.php?orderId=<?php echo base64_encode($oderRow["order_id"])?>' type="button" class="btn btn-sm btn-warning">Pay Now</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>  
            </div>
           
        </div>
         <!--view//////modal/////////////////-->
  <div class="modal fade" id="view">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="viewOrderBody">
            
        </div>
        
        
      </div>
    </div>
  </div>
        <!--view//////modal/////////////////-->
    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../DataTables-1.10.22/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../../DataTables-1.10.22/js/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="../../js/popper-1.16.js"></script>
    <script type="text/javascript" src="../../js/sweetalert2.js"></script>
    <script type="text/javascript" src="../../js/product-validation.js"></script>
 
    <script>
        
        $(function(){
    $("#order_tbl").dataTable( {
        "order": [[ 0, "desc" ]]
    } );
  });
  
        function viewOrder(orderId){
            var url="../controller/product-controller.php?status=viewOrderModale&orderId="+orderId;
            $.post(url, {orderId:orderId}, function(data) {
                $("#viewOrderBody").html(data).show();
    
});
        }
        $(document).ready(function() {
            
            var pName = $("#alert").val();
            if(pName=="sucess"){
              Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Successfull!',
            text: 'Payment Successfull',
            showConfirmButton: false,
            timer: 1500
          });   
            }
            
        });
    
    </script>
</html>