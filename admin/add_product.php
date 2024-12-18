<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

$sql="select category_name,category_id from categories";
$result=mysqli_query($conn,$sql);

if(isset($_POST['submit']))
{

    $insert=true;
    $errors=array();
    //validation of product name

    if(!empty($_POST['product_name'])){
        if(preg_match("/^[a-zA-Z0-9\s\._-]{1,100}$/",$_POST['product_name'])){
            $product_name=$_POST['product_name'];
        }
        else{
            $errors['name']="Please enter valid product name";
            $insert=false;
            }
          } 
     else{
            $errors['name']="Please enter product name";
         }
        // validation of product description
        if(!empty($_POST['description'])){
          $length=strlen($_POST['description']);
          if($length>1000){
            $errors['description']="Description should be less than 1000 characters";
            $insert=false;
          }  
          else{
              $description=$_POST['description'];
          }
     } 
          else{
              $errors['description']="Please enter product description";
          }
          // validation of product stock

          if((empty($_POST['stock'])||($_POST['stock']<=0))){
              $errors['stock']="At least one stock should be enter";
              $insert=false;
          }
          else{
              $stock=$_POST['stock'];
          }

          //validation of product unit
          if((isset($_POST['unit']))&& $_POST['unit']=="select unit"){
            $errors['unit']="Please select product unit";
            $insert=false;  
        }
        else{
            $unit=$_POST['unit'];
        }
        // validation of product category
        if((isset($_POST['category_name']))&& $_POST['category_name']=="select category"){
            $errors['category']="Please select product category";
            $insert=false;  
        }
        else{
           
            $category_id = $_POST['category_name'];
            
        }
        // validation of product price
        if(empty($_POST['product_price'])){
            $errors['price'] = "Please select product price";
            $insert=false;
        }
        else{
            $price=$_POST['product_price'];
            if($price <= 0){
                $errors['price'] = "Please enter minimum 1₹";
                $insert = false;
            }
        }
        //upload product image
        $error=null;
       
        if(!empty($_FILES['file'])&&($_FILES['file']['error']==0)){
            $file=$_FILES['file'];
            $target_dir="../images/uploads/product/";

            $imagefiletype=strtolower(pathinfo(basename($file['name']),PATHINFO_EXTENSION));
            $img_name=strtotime('now').'.'.$imagefiletype;
            $target_file=$target_dir.$img_name;
            $filepath="images/uploads/product/".$img_name;
            
            $size=1*1024*1024;
            if($file['size']>$size){
                $error="image size should be less than 1MB";
                $insert=false;
            }
        $check=getimagesize($file["tmp_name"]);
        if(!$check){
            $error="Please uload only image format";
            $insert=false;
        }
        if($error==null){
            if(!move_uploaded_file($file['tmp_name'],$target_file)){
                $error="file upload failed due to server error";
                $insert=false;
            }
        }
    }
    else{
        $error="Please select product image";
        $insert=false;
    }
    if(!empty($insert)){
        $active=isset($_POST['active'])?1:0;
        
        $sql="insert into products(product_name,description,stock,unit,product_price,category_id,image,active)values('$product_name','$description','$stock','$unit','$price','$category_id','$filepath','$active')";
        $result2=mysqli_query($conn,$sql);
        if($result2){
            header('Location:'.$adminBaseUrl."/product.php");
        }
    }

}
?>
<div class="row">
     <div class="col-xl-6">
          <div class="card">
               <div class="card-body">
                    <h4 class="card-title mb-5 text-uppercase">Update Product</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                         <div class="row mb-4">
                              <span>
                                   <?php include("includes/message.php");?>
                              </span>
                              <label for="horizontal-firstname-input" class="col-sm-3 col-form-label"> Product
                                   Name</label>
                              <div class="col-sm-9">
                                   <input type="text" name="product_name" class="form-control"
                                        id="horizontal-firstname-input" placeholder="Enter product name" value="<?php echo ($_POST && (isset($product_name)))?$product_name:""?>">
                                   <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['name'])?$errors['name']:"")?></label>
                              </div>
                         </div>
                         <div class="row mb-4">

                              <label for="horizontal-description-input" class="col-sm-3 col-form-label">
                                   Description</label>
                              <div class="col-sm-9">
                                   <textarea name="description" id="horizontal-description-input" cols="40" rows="8"
                                        placeholder="Enter product description"><?php echo ($_POST && (isset($description)))?$description:""?></textarea>
                                        <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['description'])?$errors['description']:"")?></label>
                              </div>
                         </div>
                         <div class="row mb-4">

                              <label for="horizontal-stock-input" class="col-sm-3 col-form-label"> Product Stock</label>
                              <div class="col-sm-9">
                                   <input type="text" name="stock" class="form-control" id="horizontal-stock-input"
                                        placeholder="Enter Stock" value="<?php echo ($_POST && (isset($stock)))?$stock:""?>"">
                                        <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['stock'])?$errors['stock']:"")?></label>
                              </div>
                         </div>
                         <div class="row mb-4">

                              <label for="horizontal-unit-input" class="col-sm-3 col-form-label"> Product Unit</label>
                              <div class="col-sm-9">
                                   <select name="unit" class="form-select">
                                        <option class="fw-bolder" value="select unit">Select unit</option>
                                        <option value="250 gm"
                                        <?php echo ($_POST && ($_POST['unit'] == "250 gm"))?"selected":""?>>250 gm</option>
                                        <option value="500 gm"
                                        <?php echo ($_POST && ($_POST['unit'] == "500 gm"))?"selected":""?>>500 gm</option>
                                        <option value="750 gm"
                                        <?php echo ($_POST && ($_POST['unit'] == "750 gm"))?"selected":""?>>750 gm</option>
                                        <option value="1 Kg"
                                        <?php echo ($_POST && ($_POST['unit'] == "1 Kg"))?"selected":""?>>1 Kg</option>
                                        <option value="2 Kg"
                                        <?php echo ($_POST && ($_POST['unit'] == "2 Kg"))?"selected":""?>>2 Kg</option>
                                        <option value="5 Kg"
                                        <?php echo ($_POST && ($_POST['unit'] == "5 Kg"))?"selected":""?>>5 Kg</option>
                                        <option value="10 Kg"
                                        <?php echo ($_POST && ($_POST['unit'] == "10 Kg"))?"selected":""?>>10 Kg</option>

                                   </select>
                                   <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['unit'])?$errors['unit']:"")?></label>
                              </div>
                         </div>
                         <div class="row mb-4">

                              <label for="horizontal-category-input" class="col-sm-3 col-form-label">
                                   Category</label>
                              <div class="col-sm-9">
                                   <select name="category_name" class="form-select">
                                        <option class="fw-bolder" value="select category">Select category</option>
                                        <?php while($row = mysqli_fetch_assoc($result)){?>                                            
                                        <option value="<?php echo $row['category_id'];?>"
                                        <?php echo ($_POST && (isset($category_id)) && $category_id == $row['category_id'])?"selected":""?>>
                                             <?php echo $row['category_name']; ?>
                                        </option>
                                        <?php }?>
                                   </select>
                                   <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['category'])?$errors['category']:"")?></label>
                              </div>
                         </div>

                         <div class="row mb-3">

                              <label for="horizontal-price-input" class="col-sm-3 col-form-label"> Product Price</label>
                              <div class="col-sm-9">
                                   <input type="text" name="product_price" class="form-control" id="horizontal-price-input"
                                        placeholder="Ex:00.00" value="<?php echo ($_POST && (isset($price)))?$price:""?>"">
                                        <label class="text-danger mt-1"><?php echo (isset($errors) && !empty($errors['price'])?$errors['price']:"")?></label>
                              </div>
                         </div>
                         <div class="row mb-3">
                              
                              <label class="col-sm-3 col-form-label">Choose Image</label>
                              <div class="col-sm-9">
                                   <input type="file" name="file" class="form-control">
                                   <p class="text-primary fw-bolder">Note: Size of the image should be less than 1MB</p>
                              </div>
                         </div>

                         <div class="row justify-content-end">

                              <div class="col-sm-9">
                                   <div class="form-check mb-4">
                                   <input type="checkbox" name="active" id="horizontalLayout-check" class="form-check-input" checked>
                                   <label for="horizontalLayout-check" class="form-check-lable">Active</label>
                                   </div>
                                   <div>
                                        <button name="submit" type="submit" class="btn btn-primary w-md">Add
                                             Product</button>
                                        <a href="product.php" class="btn btn-danger">Back</a>
                                   </div>
                              </div>
                         </div>

                    </form>
               </div>
          </div>
     </div>
</div>

<?php
      include("includes/footer.php");
      include("includes/bottom.php");
?>