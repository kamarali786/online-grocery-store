<?php
     ob_start();
     include_once("includes/config.php");
     include_once("includes/top.php");

  if(isset($_GET["id"]))
  {
      $id = $_GET["id"];
      $query = "select image,active from banners where banner_id = $id";
      $result  = mysqli_query($conn,$query);
      
      if($row = mysqli_fetch_assoc($result))
      {
          $oldpath = $row['image'];
          $active = $row['active'];
      }
  }
  else{
      header("Location: ".$adminBaseUrl."/banner.php");
      exit;
  }

  if(isset($_POST['submit']))
  {
      
      $error = null;
     
      $filepath = $oldpath;
      if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
      {
          
          $file = $_FILES['file'];
          $target_dir = '../images/uploads/banner/';

          $imageFileTyple = strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
          $img_name = strtotime('now').".".$imageFileTyple;
          $target_file = $target_dir.$img_name;
          $filepath = 'images/uploads/banner/'.$img_name;

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
        if($error == null)
        {
       
            $active_update = isset($_POST['active'])?1:0;      
            $sql = "update banners set image = '$filepath',active = '$active_update' where banner_id = '$id'";
            $result = mysqli_query($conn,$sql);
            
            if($result && isset($file))
            {
                unlink(BASE_PATH."/".$oldpath);
            }
              header('Location:'.$adminBaseUrl."/banner.php");
        }
          
  }
        
        ?>
<div class="col-xl-9">
    <h4 class="card-title mb-4 text-uppercase">Update banner</h4>
    <div class="card">
        <div class="card-body">
            <form action="" class="form-horizontal" enctype="multipart/form-data" method="post">

                <div class="row my-4">
                    <p>
                        <?php include_once("includes/message.php");?>
                    </p>
                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Choose Banner</label>
                    <div class="col-sm-6">
                        <input name="file" type="file" class="form-control" id="horizontal-firstname-input">
                        <p class="text-primary mt-1 fw-bolder">Note: size of the image should be less than 1 MB</p>
                    </div>
                   
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                    <div class="col-sm-6">
                        <img src="<?php echo BASE_URL." /".$oldpath?>" alt="banner"width="200px"height="100px" class="mb-3">
                    </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="horizontalLayout-check" name="active"
                            <?php echo $check = (($_POST && isset($_POST['active'])||$active == 1)?true:((!isset($_POST) && $active == 1)?true:false))?"checked":""?>
                            >
                            <label for="horizontalLayout-check" class="form-check-label"> Activate </label>
                        </div>
                        <div>
                            <button class="btn btn-primary mt-2" type="submit" name="submit"> Update </button>
                            <a href="banner.php" class="text-white btn btn-danger mt-2">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
        include("includes/footer.php");
        include("includes/bottom.php");
        ?>