
<?php

include_once("includes/config.php");

if(!empty($_SESSION['admin_id']))
{
    header("Location: ".$adminBaseUrl."/dashboard.php");
}
if(isset($_POST['submit']))
{
    $email = $_POST['email'] ;
    $password = $_POST['password'];
    $sql = "select * from users where email = '$email' and password = '$password' and type = 'admin'";
    $result = mysqli_query($conn,$sql);
    if( mysqli_num_rows($result) > 0)
    {
          while($i = mysqli_fetch_assoc($result))
          {    
             $_SESSION["admin_id"] = $i['user_id'];
          }  
       header("Location: ".$adminBaseUrl."/dashboard.php");
        
    }
    else
    {
        $error = "Please enter valid Email or Password";
    }
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Grocery store - Admin login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body style="background-image: url(images/bg-image/bg-login-img.jpg);">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"></h5>
                                        <p>Sign in to continue to grocery store.</p>
                                    </div>

                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="images/logo/admin-login.png" class="img-fluid">
                                </div>

                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>

                                </a>
                                <a href="" class="auth-logo-dark">
                                    <div class="avatar-lg profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="images/logo/admin-logo.jpeg" alt="logo" class="rounded-circle" height="100px" width="100px">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form action="" method="post" class="form-horizontal">

                                    <div class="mb-3">
                                           <?php include_once("includes/message.php");?>                                         
                                  </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control" id="username"
                                            placeholder="Enter Email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Enter Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-primary" type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                    </div>
                                  
                                    <div class="mt-3 d-grid">
                                        <button name="submit" class="btn btn-primary waves-effect waves-light"
                                            type="submit">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="rightbar-overlay"></div>
    
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    
    
    
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>


</html>
       
        
                                    




   