<?php

include_once("includes/config.php");
include_once("includes/top.php");

if (isset($_POST['submit'])) {
    $sql = "select * from users";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $_POST['email']) {
                $error_email = null;
            if ($_POST['password'] == $_POST['cpassword']) {
                $sql1 = "update users set password = '" . $_POST['password'] . "' where email = '" . $_POST['email'] . "' ";
                $result1 = mysqli_query($conn,$sql1);
                $success = "Password Changed Successfully";
            }
            else
            {
                $error = "Password Doesn't Match";
            }
        }
        else
        {
            $error_email = "Email ID are not Exist!";
        }
    }
}
?>
<div id="page-content" class="page-content" style="margin-bottom: 300px;">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('admin/images/bg-image/register.jpg');">
            <div class="container">
                <h1 class="pt-5 mb-5 text-dark">
                    Forgot Password
                </h1>
                <div class="card card-login bg-dark mb-5">
                    <div class="card-body">
                        <?php if(isset(($success))){?>
                        <label for="" class="text-white bg-success col-sm-12 p-2 mb-5"><?php echo $success?></label>   
                        <?php } ?>
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="email" type="text" required="" placeholder="Email">
                                </div>
                                <label for="" class="text-danger ml-3 mt-2"><?php echo isset($error_email)?$error_email:" ";?></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" name="cpassword" type="cpassword" required="" placeholder="confirm Password">
                                </div>
                                <label for="" class="text-danger ml-3 mt-2"><?php echo isset($error)?$error:"";?></label>
                            </div>

                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Save Password</button>
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