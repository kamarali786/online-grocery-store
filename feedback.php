<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if (isset($_POST['submit'])) {
    
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "select email from users where type = 'user'";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result))
    {
        $error = null;
        if($email == $row['email'])
        {
            $sql1 = "insert into feedback(user_id,email,message)values('".$_SESSION['user']."','".$email."','".$message."')";
            $result1 = mysqli_query($conn,$sql1);
            if($result1)
            {
                $success = "FeedBack Send Successfully...!";
            }
            break;
        }
        else{
            $error = "Email Are not Exist !..";
        }
    }

}
?>

<div id="page-content" class="page-content" style="margin-bottom: 300px;">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('admin/images/bg-image/bg-lock-screen.jpg');">
            <div class="container">
                <h1 class="pt-5 mb-5">
                    FeedBack
                </h1>

                <div class="card card-login mb-5">
                    <div class="card-body bg-white">
                        <?php if(isset($success)){?>
                            <label class="bg-success alert"><?php echo $success;?></label>
                            <?php } ?>
                        <form class="form-horizontal" action="" method="post">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="email" type="text" required placeholder="Enter Email">
                                </div>
                                <label for="" class="text-danger ml-3 mt-1"><?php echo isset($error)?$error:""?></label>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" required id="message" cols="45" rows="8" placeholder="Enter feedback message"></textarea>
                                </div>
                            </div>
                                                       
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Send FeedBack</button>
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
