 $(document).ready(function() {
     // add to shopping cart
         $("#add_to_cart").click(function () {
            var url = "../controller/product-controller.php?status=addToCart";
            var frameSize = $("#frameSize").val();
            var pId = $("#pId").val();
            var pQuantity = $("#pQuantity").val();
            var add_to_cart = $("#add_to_cart").val();
            $.post(url, {size_id:frameSize,pId:pId,pQuantity:pQuantity,add_to_cart:add_to_cart}, function (data){
                $("#item_count").html(data).show();
                
            var pName = $("#pName").val();
            var qty = $("#pQuantity").val();
                Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: "Succesfuly added "+pName+" "+"</br>("+" "+"Quantity"+" "+qty+" "+")",
                  showConfirmButton: false,
                  timer: 1500
                });
            });
        });
  
        //add to shopping cart
  
 //filter product
    $("#filter").click(function () {
            var url = "../controller/product-controller.php?status=filter";
            var catId = $("#catId").val();
            var matId = $("#matId").val();
            var color = $("#color").val();
            alert(catId);
            $.post(url, {catId:catId,matId:matId,color:color}, function (data){
                $("#product").html(data).show();
            });
        });
    //filter product     
       
  
 //price by size
    $("#frameSize").change(function () {
            var url = "../controller/product-controller.php?status=getPrice";
            var x = $("#frameSize").val();
            var pId = $("#pId").val();
            var pQuantity = $("#pQuantity").val();
            $.post(url, {size_id:x,pId:pId,pQuantity:pQuantity}, function (data){
                $("#price").html(data).show();
            });
        });
    //price by size
     //price by qty
    $("#pQuantity").change(function () {
            var url = "../controller/product-controller.php?status=getPrice";
            var x = $("#frameSize").val();
            var pId = $("#pId").val();
            var pQuantity = $("#pQuantity").val();
            $.post(url, {size_id:x,pId:pId,pQuantity:pQuantity}, function (data){
                $("#price").html(data).show();
            });
        });
    //price by qty
    
    
    
    
      $("#search-bar").keyup(function () {
            var url = "../controller/product-controller.php?status=loadProductOnSearch";
            var seaechText = $("#search-bar").val();
            $.post(url, {seaechText:seaechText}, function (data){
                $("#product").html(data).show();
            });
        });
        
    $("#payment").submit( function (){
        var name=$("#name").val();
        var number=$("#number").val();
        var cvc=$("#cvc").val();
        var date=$("#date").val();
        
        var name_ptn = /^[a-zA-Z]{1,}$/;
        
          
            if(name==""){
            $("#nameTooltip").html("Please enter the name");
            $("#name").addClass("is-invalid");
            console.log("n");
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
        
        if(number==""){
            $("#numberTooltip").html("Please enter the creadit card number");
            $("#number").addClass("is-invalid");
            console.log("n");
                return false;
                }else{
                    $("#number").removeClass("is-invalid");
                    $("#number").addClass("is-valid");
                }
                
                if(cvc==""){
            $("#cvcTooltip").html("Please enter the cvc number");
            $("#cvc").addClass("is-invalid");
            console.log("n");
                return false;
                }else{
                    $("#cvc").removeClass("is-invalid");
                    $("#cvc").addClass("is-valid");
                }
           
           if(date==""){
            $("#dateTooltip").html("Please enter theexpire date");
            $("#date").addClass("is-invalid");
            console.log("n");
                return false;
                }else{
                    $("#date").removeClass("is-invalid");
                    $("#date").addClass("is-valid");
                }
           
           
    });
    
    
     $('#shopping-cart').mouseover(function() {
        $('.shopping-cart-contend').load(' #cart-list');
    });
     $("#shopping-cart").mouseover(function(){
         $(".shopping-cart-contend").css("display", "block");
     });
     $(".shopping-cart-contend").mouseover(function(){
         $(".shopping-cart-contend").css("display", "block");
     });
     $("#shopping-cart").mouseout(function(){
         $(".shopping-cart-contend").css("display", "none");
     });
     $(".shopping-cart-contend").mouseout(function(){
         $(".shopping-cart-contend").css("display", "none");
     });
     
     
     $("#user_icon").mouseover(function(){
         $(".user-contend").css("display", "block");
     });
     $("#user_icon").mouseout(function(){
         $(".user-contend").css("display", "none");
     });
     $(".user-contend").mouseover(function(){
         $(".user-contend").css("display", "block");
     });
     $(".user-contend").mouseout(function(){
         $(".user-contend").css("display", "none");
     });
     
     
        
    
});



function isNumberKey(event){
          var charCode = (event.which)?event.which:event.keyCode;
          if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
        return true;
          
      };
//remove from shopping cart
         function load_data(psId) {
        var url="../controller/product-controller.php?status=removeFromCart";
        $.post(url, {psId:psId}, function(data){
            $("#item_count").html(data).show();
            $("#cart-tbl").load(" #cart-table-data");//remove from cart table
            $('.shopping-cart-contend').load(' #cart-list');//remove from hover cart
            $('#order_summery').load(' #total');//remove from hover cart
        });
    }
//remove from shopping cart


$("#proceedTocheckout").click(function () {  
Swal.fire({
  icon: 'warning',
  title: 'Shopping cart is empty',
  showConfirmButton: false,
  footer: '<a href="shop.php" class="btn btn-primary">Add items to cart</a>'
});
});
