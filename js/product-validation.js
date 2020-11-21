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
            });
        });
  
        //add to shopping cart
       
       
  
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
     
     
        
    function isNumberKey(event){
          let charCode = (event.which)?event.which:event.keyCode;
          if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
              return false;
        return true;
          
      };
});

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

$("#add_to_cart").click(function () {
    var pName = $("#pName").val();
    var qty = $("#pQuantity").val();
swal({
  title: "Added to shopping cart"+"("+" "+"Item"+" "+qty+" "+")",
  text: pName,
  icon: "success"
//  button: "Aww yiss!"
});
});