
<?php
        include_once("includes/config.php");
        include_once("includes/top.php");
        
        $sql = "select * from users where user_id = '".$_SESSION['admin_id']."' and type ='admin'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $oldpath = $row['image'];
        $filepath = $oldpath;
        
        if(isset($_POST['name']))
        {
            $name = $_POST['name'];
            $error = null;
            if(isset($_FILES['file']) && ($_FILES['file']['error'] == 0))
            {
                
                $file = $_FILES['file'];
                $target_dir = '../images/uploads/profile/';
                
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
                $sql = "insert into users(name,image)values('$name','$filepath')";
                
            } else {
                
                $sql = "update users set name = '$name',image='$filepath' where user_id = '" . $_SESSION['admin_id'] . "'";
            }
            $result = mysqli_query($conn,$sql);
            if($result && isset($file) && file_exists(BASE_PATH."/".$oldpath))
            {
                $success = "Profile has been Successfully Updated";
                unlink(BASE_PATH."/".$oldpath);
            }
            
            
        }
        ?>
          <h3><i class="fa fa-profile"></i> Profile</h3>
          <div class="row mt-5">
              <?php include_once('includes/message.php') ?>
              <div class="col-xl-4">
                  <div class="card">
                      <div class="card-body">
                          <form action="profile.php" method="post" enctype="multipart/form-data">
                              <div class="row mb-4">
                                  <div class="col-sm-9">
                                      <img src="<?php echo BASE_URL."/".$row['image']?>" alt="profile-image" class="rounded-circle">
                                  </div>
                              </div>
                              <label for="horizontal-firstname-input" class="col-sm-4 col-form-label">Choose Profile</label>
                              <input type="file" name="file">
                              
                         
                      </div>
                  </div>
              </div>
              <div class="col-xl-7">
                  <div class="card">
                      <div class="card-body">
                          <div class="row mb-4">
                              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Name</label>
                              <div class="col-sm-6">
                                  <input type="text" name="name" class="form-control" id="horizontal-firstname-input" value="<?php echo (isset($_POST['name']) && ($_POST))?$_POST['name']:(isset($row['name'])?$row['name']:"")?>">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="ml-3">
                  <button type="submit" class="btn btn-primary w-md col-sm-3">Submit</button>
              </div>
          </div>
        <?php
          include_once('includes/footer.php');
          include_once('includes/bottom.php');
        ?>
        
        
        
        