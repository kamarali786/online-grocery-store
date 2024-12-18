<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from users where email = '$email' and password = '$password' and type = 'user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $row['user_id'];
        
        header("Location:" . BASE_URL . "/index.php");
    }
    else {
        
        $error = "Invalide Id or Password";
    }
}
?>

<div id="page-content" class="page-content" style="margin-bottom: 300px;">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('admin/images/bg-image/register.jpeg');">
            <div class="container">
                <h1 class="pt-5 mb-5">
                    Login Page
                </h1>
                <div class="card card-login mb-5">
                    <div class="card-body">
                        <?php if(isset($error)) { ?><p class="bg-danger"><?php echo $error;?></p> <?php } ?>
                        <form class="form-horizontal" action="login.php" method="post">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="email" type="text" required="" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <a href="forgot.php" class="text-light"><i class="fa fa-bell"></i> Forgot password?</a>
                                </div>
                            </div>
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Log In</button>
                                </div>
                            </div>
                            <div class="form-group row text-center mt-5">
                                <div class="col-md-12">
                                    <p>Don't have an account yet ? <a href="register.php" class="login-link">Sign up here</a></p>
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
