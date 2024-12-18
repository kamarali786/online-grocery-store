<?php
     ob_start();
     include_once("includes/config.php");
     include_once("includes/top.php");

     if(isset($_GET["id"]))
     {
         $id = $_GET["id"];
         $query = "select category_name,image,active from categories where category_id = $id";
         $result  = mysqli_query($conn,$query);
         
         if($row = mysqli_fetch_assoc($result))
         {
             $category_name = $row['category_name'];
             $oldpath = $row['image'];
             $active = $row['active'];
         }
     }
     else{
         header("Location: ".$adminBaseUrl."/category.php");
         exit;
     }
    if(isset($_POST['submit']))
    {
        $category_name = $_POST['category_name'];   
        $name_check = preg_match("/^[a-zA-Z\s]{1,100}$/",$category_name);
 
    if(!empty($category_name))
    {
        
 
        if(empty($name_check))
        {
             $error_name="Please Enter the category name Correctly !";
        }
    }
    else
    {
        $error_name = "Please Enter category name";
    }
      
      $error = null;
     
      $filepath = $oldpath;
      if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
      {
          
          $file = $_FILES['file'];
          $target_dir = '../images/uploads/category/';

          $imageFileTyple = strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
          $img_name = strtotime('now').".".$imageFileTyple;
          $target_file = $target_dir.$img_name;
          $filepath = 'images/uploads/category/'.$img_name;

          $size = 0.8 * 1024 * 1024;
          if($file['size'] > $size)
          {
              $error = "Image size should be less than 800KB";
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
        if($error == null && $error_name == null)
        {
       
            $active_update = isset($_POST['active'])?1:0;      
            $sql = "update categories set category_name ='$category_name',image = '$filepath',active = '$active_update' where category_id = '$id'";
            $result = mysqli_query($conn,$sql);
            
            if($result && isset($file))
            {
                unlink(BASE_PATH."/".$oldpath);
              }
              header('Location:'.$adminBaseUrl."/category.php");
        }
          
  }
   
?>
<div class="col-xl-6">
    <h4 class="card-title mb-4 text-uppercase">update category</h4>
    <div class="card">
        <div class="card-body">
            <form action="" method ="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="row my-4">
                    <p class="mb-2"><?php include_once("includes/message.php")?></p>
                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Category name</label>
                    <div class="col-sm-9">
                        <input value = "<?php echo (($_POST && isset($_POST['category_name']))?$_POST['category_name']:$category_name);?>"type="text" name="category_name" class="form-control" id="horizontal-firstname-input">
                        <label class="text-danger"><?php echo isset($error_name)?$error_name:"";?></label>
                    </div>
                </div>
                
                <div class="row mb-3">
                    
                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Choose image</label>
                    <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" id="horizontal-firstname-input">
                        <p class="text-primary fw-bolder mt-1">Note : Size of the Image should be less than 1MB</p>
                    </div>
                    
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                         <div class="col-sm-12">
                            <img src="<?php echo BASE_URL." /".$oldpath?>" alt="category_image"width="200px"height="100px">
                         </div>
                          <div class="form-check mb-4">
                                <input type="checkbox" name="active" id="horizontalLayout-check" class="form-check-input" <?php echo $check = (($_POST && isset($_POST['active'])||$active == 1)?true:((!isset($_POST) && $active == 1)?true:false))?"checked":""?> >
                                <label for="horizontalLayout-check" class="form-check-lable">Active</label>
                          </div> 
                          <div>
                            <button name="submit" class="btn btn-primary mt-4" type="submit">Save</button>
                            <a href="category.php" class="btn btn-danger mt-4 ms-2">Back</a>
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