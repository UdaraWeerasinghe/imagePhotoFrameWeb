 $('#login').on('submit', function (e) {
     if($('#uname').val()==""){
            $("#unameTooltip").html("Please enter the  user name");
            $("#uname").addClass("is-invalid");
                return false;
        }else{
            $("#uname").removeClass("is-invalid");
            $("#uname").addClass("is-valid");
        }
        
        if($('#upass').val()==""){
            $("#upassTooltip").html("Please enter the password");
            $("#upass").addClass("is-invalid");
                return false;
        }else{
            $("#upass").removeClass("is-invalid");
            $("#upass").addClass("is-valid");
        }
      e.preventDefault();
            $.ajax({
            type: 'post',
            url: '../controller/login-controller.php?status=login',
            data: $('#login').serialize(),
            success: function (result) {
                console.log(result);
                if(result=="success"){
                   window.location.href = "../controller/login-controller.php?status=redirect";
                }else{
                    $("#upassTooltip").html("User name and password does not match");
                    $("#upass").addClass("is-invalid");
                }
//                $('#login')[0].reset();
            }
        });
     
 });
 $("#dropMsg").keyup(function(){
        $("#name").removeClass("is-invalid");
    });