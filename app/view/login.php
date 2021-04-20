<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.css"> 
        <link type="text/css" rel="stylesheet" href="../../fontawesome-pro-5.13.0-web/css/all.css">
    </head>
    <body style="margin: 0px; padding: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <img src="../../images/logo.png" height="60px;" style="margin: 10px;">
                </div>
                <div class="col-md-8" style="text-align: center">
                    <div style="padding-top: 25px;">
                        <a style="margin-right: 50px; color: orangered;">Home</a>
                        <a style="margin-right: 50px;">About</a>
                        <a style="margin-right: 50px;">Contact</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            
        </div>
        <div style="height: 351.1Px; width: 100%; background-image: url(../../images/top-banner3.jpg); background-size: cover">
            <div class="row container">
                <div class="col-6" style=" padding: 20px;">
                    <div style="box-shadow: 5px 5px 20px 5px gray; padding: 20px; background-color: white; border-radius: 15px;">
                        <form method="post" action="../controller/login-controller.php?status=login">
                            <h4>Login</h4>
                            <label>User Name</label>
                            <input type="text" name="uname" id="uname" placeholder="Enter your Email.." class="form-control"><br>
                            <label>User Name</label>
                            <input type="password" name="upass" id="upass" placeholder="Enter your Password.." class="form-control"><br>
                            <a style="font-size: 12px;" href="#">Forgot Password</a>
                            <div style="text-align: end">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
</html>