// var fname=$("#fName").val();
 
 $(function () {
        $('#createAccForm').on('submit', function (e) {
             var fname=$("#fName").val();
             var lName=$("#lName").val();
             var nic=$("#nic").val();
             var con=$("#con").val();
             var email=$("#email").val();
             var zip=$("#zip").val();
             var address=$("#address").val();
             var pass=$("#pass").val();
             var passCnf=$("#passCnf").val();
             
            var name_ptn = /^[a-zA-Z]{1,}$/;
            var email_ptn = /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
            var cno_ptn = /^[0]\d{9}$/;
            var nic_ptn_new = /^[0-9]{12}$/;
            var nic_ptn_old = /^[0-9]{9}[vVxX]{1}$/;
            
             
            if(fname==""){
            $("#fNameTooltip").html("Please enter the first name");
            $("#fName").addClass("is-invalid");
            console.log("n");
                return false;
                }else{
                    $("#fName").removeClass("is-invalid");
                    $("#fName").addClass("is-valid");
                }
            if (!fname.match(name_ptn)){
            $("#fNameTooltip").html("Please enter valid name");
            $("#fName").addClass("is-invalid");
            return false;
        } else{
            $("#fName").removeClass("is-invalid");
            $("#fName").addClass("is-valid");
        }
                
            if(lName==""){
            $("#lNameTooltip").html("Please enter the first name");
            $("#lName").addClass("is-invalid");
                return false;
                }else{
                    $("#lName").removeClass("is-invalid");
                    $("#lName").addClass("is-valid");
                }
                
            if (!lName.match(name_ptn)){
            $("#lNameTooltip").html("Please enter valid name");
            $("#lName").addClass("is-invalid");
            return false;
        } else{
            $("#lName").removeClass("is-invalid");
            $("#lName").addClass("is-valid");
        }
        
            if(nic==""){
            $("#nicTooltip").html("Please enter the first name");
            $("#nic").addClass("is-invalid");
                return false;
                }else{
                    $("#nic").removeClass("is-invalid");
                    $("#nic").addClass("is-valid");
                }
                
            if (!nic.match(nic_ptn_old)&&!nic.match(nic_ptn_new)){
            $("#nicTooltip").html("Please enter valid NIC number");
            $("#nic").addClass("is-invalid");
            return false;
        } else{
            $("#nic").removeClass("is-invalid");
            $("#nic").addClass("is-valid");
        }
            if(con==""){
            $("#conTooltip").html("Please enter the contact number");
            $("#con").addClass("is-invalid");
                return false;
                }else{
                    $("#con").removeClass("is-invalid");
                    $("#con").addClass("is-valid");
                }
                
            if (!con.match(cno_ptn)){
            $("#conTooltip").html("Please enter valid contact number");
            $("#con").addClass("is-invalid");
            return false;
        } else{
            $("#con").removeClass("is-invalid");
            $("#con").addClass("is-valid");
        }
        
            if(email==""){
            $("#emailTooltip").html("Please enter the email");
            $("#email").addClass("is-invalid");
                return false;
                }else{
                    $("#email").removeClass("is-invalid");
                    $("#email").addClass("is-valid");
                }
            if (!email.match(email_ptn)){
            $("#emailTooltip").html("Please enter valid email");
            $("#email").addClass("is-invalid");
            return false;
        } else{
            $("#email").removeClass("is-invalid");
            $("#email").addClass("is-valid");
        }
            if(zip==""){
            $("#zipTooltip").html("Please enter the ZIP code");
            $("#zip").addClass("is-invalid");
                return false;
                }else{
                    $("#zip").removeClass("is-invalid");
                    $("#zip").addClass("is-valid");
                }
            if(address==""){
            $("#addressTooltip").html("Please enter the address");
            $("#address").addClass("is-invalid");
                return false;
                }else{
                    $("#address").removeClass("is-invalid");
                    $("#address").addClass("is-valid");
                }
            if(pass==""){
            $("#passTooltip").html("Please enter the password");
            $("#pass").addClass("is-invalid");
                return false;
                }else{
                    $("#pass").removeClass("is-invalid");
                    $("#pass").addClass("is-valid");
                } 
             if(passCnf==""){
            $("#passCnfTooltip").html("Please enter the password again");
            $("#passCnf").addClass("is-invalid");
                return false;
                }else{
                    $("#passCnf").removeClass("is-invalid");
                    $("#passCnf").addClass("is-valid");
                } 
                
            if(pass!==passCnf){
            $("#passCnfTooltip").html("password does not match");
            $("#passCnf").addClass("is-invalid");
                return false;
                }else{
                    $("#passCnf").removeClass("is-invalid");
                    $("#passCnf").addClass("is-valid");
                } 
                
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: '../controller/customer-controller.php?status=addCustomer',
            data: $('#createAccForm').serialize(),
            success: function (result) {
                console.log(result);
                if(result=="nic"){
                    $("#nicTooltip").html("NIC Number is alredy exist"); 
                    $("#nic").addClass("is-invalid");
                    $("#nic").focus();
                }
                else if(result=="tel"){
                    $("#conTooltip").html("Conact Number is alredy exist"); 
                    $("#con").addClass("is-invalid");
                    $("#con").focus();
                }
                else if(result=="email"){
                    $("#emailTooltip").html("Conact Number is alredy exist"); 
                    $("#email").addClass("is-invalid");
                    $("#email").focus();
                }
                else if(result=="success"){
                    Swal.fire({
//                        position: 'top-end',
                        icon: 'success',
                        title: 'Registration Successfull',
                        text: 'Please check your email and activate your account',
                        showConfirmButton: true
                        
                      });  
                      $('#createAccount').modal('hide');;
                }
            }
          });
        });
      });
$("#fName").keyup(function(){
    $("#fName").removeClass("is-invalid");
});
$("#lName").keyup(function(){
    $("#lName").removeClass("is-invalid");
});
$("#zip").keyup(function(){
    $("#zip").removeClass("is-invalid");
}); 
$("#email").keyup(function(){
    $("#email").removeClass("is-invalid");
});
$("#cno").keyup(function(){
    $("#cno").removeClass("is-invalid");
});
$("#nic").keyup(function(){
    $("#nic").removeClass("is-invalid");
});
$("#address").keyup(function(){
    $("#address").removeClass("is-invalid");
});
$("#pass").keyup(function(){
    $("#pass").removeClass("is-invalid");
});
$("#passCnf").keyup(function(){
    $("#passCnf").removeClass("is-invalid");
});

