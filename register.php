<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if(isset($_POST['submit']))
{
    $insert = 1;
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if(!($password == $cpassword))
    {
        $error = "Password does'nt match";
        $insert = 0;
    }
    if($insert == 1)
    {
    $sql = "insert into users(name,email,password,type)values('$name','$email','$password','user')";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        header("Location: ".BASE_URL."/login.php");
    }
    }

}
?>

<div id="page-content" class="page-content" style="margin-bottom: 300px;">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center " style="background-image: url('admin/images/bg-image/register.jpeg'); height: max-content;">
            <div class="container">
                <h1 class="pt-5 mb-5">
                    Register Page
                </h1>


                <div class="card card-login mb-5">
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="register.php">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input name="name" class="form-control" type="text" required="" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input name="email" class="form-control" type="email" required="" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input name="password" class="form-control" type="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input name="cpassword" class="form-control" type="password" required="" placeholder="Confirm Password">
                                </div>
                                <label class="text-danger ml-3 mt-2 text-lowercase"><?php echo isset($error)?$error:""; ?></label>
                            </div>
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button name="submit" type="submit" class="btn btn-primary btn-block text-uppercase">Register</button>
                                </div>
                            </div>
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <p>Already have an account ?
                                        <a href="login.php" class="login-link">sign in here</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>