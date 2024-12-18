<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if(isset($_POST["submit"]))
{
   $category_name = $_POST['category_name'];
   $name_check = preg_match("/^[a-zA-Z\s]{1,100}$/",$category_name);
   $warning = null;
   $error = null;

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
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
    {
       $file = $_FILES['file'];
       $target_dir = '../images/uploads/category/';
       $imageFileType = strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
       $img_name = strtotime('now').'.'.$imageFileType;
       $target_file = $target_dir.$img_name;
       $filepath = 'images/uploads/category/'.$img_name;

       $size = 1 * 1024 * 1024;
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
             if($error == null && $error_name == null)
             {    
               $active = isset($_POST['active'])?1:0;
               $sql = "insert into categories(category_name,image,active)values('$category_name','$filepath','$active')"; 
               $result = mysqli_query($conn,$sql);
                
               if($result)
               {
                   header('Location: '.$adminBaseUrl."/category.php");
                   
               }
            }
       }
    
    }
    else
    {
        $error = "Please select category Image ";
    }     
    
}
?>

<div class="col-xl-6">
    <h4 class="card-title mb-4 text-uppercase">Add new category</h4>
    <div class="card">
        <div class="card-body">
            <form action="" method ="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="row my-4">
                    <p class="mb-2"><?php include_once("includes/message.php")?></p>
                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Category name</label>
                    <div class="col-sm-9">
                        <input type="text" name="category_name" class="form-control" id="horizontal-firstname-input"value = "<?php echo (($_POST && isset($_POST['category_name']))?$_POST['category_name']:"");?>">
                        <p class="text-danger"><?php echo isset($error_name) ? $error_name:""?></p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    
                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Choose image</label>
                    <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" id="horizontal-firstname-input">
                        <p class="text-primary fw-bolder mt-1">Note : Size of the Image should be less than</p>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                          <div class="form-check mb-4">
                                <input type="checkbox" name="active" id="horizontalLayout-check" class="form-check-input" checked>
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
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>