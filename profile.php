<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");
if (empty($_SESSION['user'])) {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}

$sql = "select * from user_details where user_id = '" . $_SESSION['user'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];
    $phone = $_POST['phone'];
    $oldpath = $row['image'];
    
    $error = null;
    $filepath = $oldpath;
    if(isset($_FILES['file']) && ($_FILES['file']['error'] == 0))
       {
          
           $file = $_FILES['file'];
           $target_dir = './images/uploads/profile/';
 
           $imageFileTyple = strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
           $img_name = strtotime('now').'.'.$imageFileTyple;
           $target_file = $target_dir.$img_name;
           $filepath = 'images/uploads/profile/'.$img_name;
            
           $size = 0.8 * 1024 * 1024;
           if($file['size'] > $size)
           {
               $error = "Image size should be less than 1MB";
           }  
 
           $check = getimagesize($_FILES["file"]["tmp_name"]);
           if(!$check)
           {
               $error = "Please upload only Image Format";
           }
           if($error == null)
           {
               if(!move_uploaded_file($file["tmp_name"],$target_file))
               {
                   $error = "File upload failed due to server error ";
                 
               }
              
                 
            }
        
        }

    if (empty($row)) {
         
        $sql = "insert into user_details(user_id,name,address,city,state,email,zip_code,phone,image)values('$_SESSION[user]','$name','$address','$city','$state','$email','$zip_code','$phone','$filepath')";
    } else {
        
        $sql = "update user_details set name = '$name',address = '$address',city = '$city',state = '$state',email = '$email',zip_code = '$zip_code', phone ='$phone',image='$filepath' where user_id = '" . $_SESSION['user'] . "'";
    }
    $result = mysqli_query($conn, $sql);
    if($result && isset($file))
    {
        $success = "Profile has been Successfully Updated";
        if(isset($oldpath) && isset($file) && file_exists(BASE_PATH."/".$oldpath))
        {
           unlink(BASE_PATH."/".$oldpath);
        }
    }
    
}
?>
<div id="page-content" class="page-content">

    <div class='mt-5'>
        <img class='banner' src="./admin/images/banner/offer.jpg">
    </div>

    
  
</div>
<div id="page-content" class="page-content">
        <section id="checkout">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-6">
                        <?php include_once('./admin/includes/message.php');?>
                        <h5 class="mb-5"><i class="fa fa-user"> </i> USER PROFILE</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="" class="bill-detail" method = "post" enctype="multipart/form-data" >
                            <fieldset>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="File" type="File" name="file" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name" type="text" name = "name" required value="<?php echo ($_POST && isset($_POST['name']) ? $_POST['name'] : (isset($row['name'])?$row['name']:"")) ?>">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Address" name="address" required><?php echo ($_POST && isset($_POST['address']) ? $_POST['address'] : (isset($row['address'])?$row['address']:"")) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Town / City" type="text" name ="city" required value="<?php echo ($_POST && isset($_POST['city']) ? $_POST['city'] : (isset($row['city'])?$row['city']:"")) ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="State / Country" type="text" name="state" required value="<?php echo ($_POST && isset($_POST['state']) ? $_POST['state'] : (isset($row['state'])?$row['state']:"")) ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Postcode / Zip" type="text" name = "zip_code" required value="<?php echo ($_POST && isset($_POST['zip_code']) ? $_POST['zip_code'] : (isset($row['zip_code'])?$row['zip_code']:"")) ?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" placeholder="Email Address" type="email" name = "email" required value="<?php echo ($_POST && isset($_POST['email']) ? $_POST['email'] : (isset($row['email'])?$row['email']:"")) ?>">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" placeholder="Phone Number" type="text" name = "phone" required value="<?php echo ($_POST && isset($_POST['phone']) ? $_POST['phone'] : (isset($row['phone'])?$row['phone']:"")) ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group text-right">
                                    <button name="submit" class="btn btn-primary">UPDATE</button>
                                    <div class="clearfix">
                                </div>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php

include_once("includes/footer.php");
include_once("includes/bottom.php");
?>

