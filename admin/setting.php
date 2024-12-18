<?php
     ob_start();
     include_once("includes/config.php");
     include_once("includes/common_function.php");
     include_once("includes/top.php");

     $sql = "select setting_value from settings";
     $result = mysqli_query($conn,$sql);

     $errors = array();
     if(isset($_POST['submit']))
     {
         $error = null;

         $error=null;
       
         if(!empty($_FILES['file'])&&($_FILES['file']['error']==0))
         {
             $file=$_FILES['file'];
             $target_dir="../images/uploads/logo/";
 
             $imagefiletype=strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
             $img_name=strtotime('now').'.'.$imagefiletype;
             $target_file=$target_dir.$img_name;
             $filepath="images/uploads/logo/".$img_name;
             
             $size=1*1024*1024;
             if($file['size']>$size)
             {
                 $error="image size should be less than 1MB";
                 
             }
            $check=getimagesize($file["tmp_name"]);
            if(!$check)
            {
             $error="Please uload only image format";
             
            }
            if($error==null)
            {
             if(!move_uploaded_file($file['tmp_name'],$target_file)){
                 $error="file upload failed due to server error";
                 
             }
             else{
                 $_POST['logo'] = $filepath;
                 unlink(BASE_PATH."/".setting("logo"));
                 
             }
            }

         }

       foreach($_POST as $key =>$value)
       {
           if($key == 'submit')
           {
               continue;
           }
  
           $sql1 = "select * from settings where setting_name = '".$key."'";
           $result1 = mysqli_query($conn,$sql1);
  
           $row = mysqli_fetch_assoc($result1);
           if(!empty($row))
           {
               $sql = "UPDATE settings SET setting_value = '".$value."' where setting_name = '".$key."'";
            }
            else{
            
                $sql = "INSERT INTO settings(setting_name,setting_value)VALUES('".$key."','".$value."')";
            }
            $result = mysqli_query($conn,$sql);
       }
       if($result)
       {
           $success = "Setting Update Successfully";
       }

     } 
 ?>
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <label class="col-xl-12">
                        <?php include_once("includes/message.php");?>
                    </label>
                    <h3 class="mb-4"><i class="fa fa-cog"></i> General Setting</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="form row-email-input" class="form-label">Company Email </label>
                                <input type="email" class="form-control" id="form-email-input" name="email"
                                    placeholder="Enter email" value="<?php echo setting('email');?>" required>
                                <label for="form row-email-input" class="text-danger mt-1">
                                    <?php echo isset($errors['email']) ? $errors['email']:" " ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="form row-password-input" class="form-label">Company Contact No</label>
                                <input type="tel" pattern="[0-9]{10}" class="form-control" id="form row-password-input"
                                    name="phone_number" placeholder="Phone number"
                                    value="<?php echo setting('phone_number');?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="form row-input city" class="form-label">Choose Logo</label>
                                <input type="file" class="form-control" id="form row-input city" name="file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="form row-input State" class="form-label">Currency Symbol</label>
                                <select id="form row-input State" class="form-select" name="Symbol" required>
                                    <option>Choose Symbol</option>
                                    <option value="INR(₹)" <?php echo(setting('symbol')=="INR(₹)" )?"selected":" ";?>>INR(₹)</option>
                                    <option value=" USD($)"<?php echo(setting('symbol')=="USD($)" )?"selected":" ";?>>USD($)</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card body-->
            </div>

            <div class=" card">
                <div class="card-body">
                    <h3 class="mb-5"><i class="fa fa-user"></i> Social Media Setting</h3>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input"
                            class="col-sm-3 col-form-label">Facebook URL
                        </label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control"
                                id="horizontal-firstname-input" placeholder="Facebook.com"
                                name="fb_url" value="<?php echo setting('fb_url')?>"required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input"
                            class="col-sm-3 col-form-label">X URL</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control"
                                id="horizontal-firstname-input" placeholder="twitter.com"
                                name="x_url" value="<?php echo setting('x_url')?>" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input"
                            class="col-sm-3 col-form-label">Instagram URL</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control"
                                id="horizontal-firstname-input" placeholder="instagram.com"
                                name="insta_url" value="<?php echo setting('insta_url')?>"
                                required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="horizontal-firstname-input"
                            class="col-sm-3 col-form-label">Youtube URL</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control"
                                id="horizontal-firstname-input" placeholder="youtube.com"
                                name="yt_url" value="<?php echo setting('yt_url')?>" required>
                        </div>
                    </div>
                </div>
                <!--end card body-->
            </div>
              <!--end card-->
    </div>
 </div>

   <div>
       <button type="submit" class="btn btn-primary w-lg" name="submit">Save</button>
       <a href="dashboard.php" class="btn btn-danger w-lg">Back</a>
   </div>
</form>

<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>
                