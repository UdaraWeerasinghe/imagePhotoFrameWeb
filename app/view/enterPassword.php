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
                    <img src="../../images/logo.png" height="35px;" style="margin: 10px;">
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
                <div class="col-6" style=" padding: 10px 30px;">
                    <div style="padding: 20px; background-color: white; border-radius: 15px;" class="card">
                        <form method="post" action="../controller/login-controller.php?status=login">
                            <h4>Login</h4>
                            <label>User Name</label>
                            <input type="text" name="uname" id="uname" placeholder="Enter your Email.." class="form-control"><br>
                            <label>User Name</label>
                            <input type="password" name="upass" id="upass" placeholder="Enter your Password.." class="form-control"><br>
                            <a style="font-size: 12px;" href="#">Forgot Password</a>
                            <div style="text-align: end">
                                <a style="margin-right: 20px" href="create-account.php" data-toggle="modal" data-target="#createAccount">Create an Account</a>
                                <input type="submit" class="btn" value="Login" style="background-color: #C3272B; color: white">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
<div class="modal" id="createAccount">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Account</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form  id="createAccForm"  method="post">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <label>First Name :</label>
                    <input type="text" name="fName" id="fName" class="form-control">
                    <div id="fNameTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
                <div class="col-sm-6">
                    <label>Last Name :</label>
                    <input type="text" name="lName" id="lName" class="form-control">
                    <div id="lNameTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <label>NIC Number :</label>
                    <input type="text" name="nic" id="nic" class="form-control">
                    <div id="nicTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
                <div class="col-sm-6">
                    <label>Contact Number :</label>
                    <input type="tel" name="con" id="con" class="form-control">
                    <div id="conTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <label>Email Address :</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <div id="emailTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
                <div class="col-sm-6">
                    <label>Gender :</label><br>
                    <input style="margin-left: 50px;" type="radio" name="gender" value="1" checked><label>Male</label>
                    <input style="margin-left: 20px;" type="radio" name="gender" value="0" ><label>Female</label>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <label>ZIP Code :</label>
                    <input type="text" name="zip" id="zip" class="form-control">
                    <div id="zipTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
                <div class="col-sm-6">
                    <label>Address :</label>
                    <input type="text" name="address" id="address" class="form-control">
                    <div id="addressTooltip" style="position: absolute;width: 92%; left: 16px" class="invalid-tooltip"></div>
                </div>
            </div>
              <div class="row">
                  <div class="col-12" style="text-align: right">
                      <button type="submit" class="btn btn-success">Create Account</button>
                  </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
    </body>
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../js/sweetalert2.js"></script>
</html>