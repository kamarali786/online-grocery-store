<?php
     ob_start();
     include_once("includes/config.php");
     include_once("includes/top.php");

     $sql = "select products.*,categories.category_name from products left join categories on products.category_id = categories.category_id";
     $result = mysqli_query($conn,$sql);
     
     //delete product
     if(isset($_GET["id"])){
        $id=$_GET["id"];
        $query="select image from products where product_id='$id'";
        $result=mysqli_query($conn,$query);
    
        if($row=mysqli_fetch_assoc($result)){
            $oldpath=$row["image"];
            unlink(BASE_PATH."/".$oldpath);
        }
        $delete="delete from products where product_id=$id";
        $result_delete=mysqli_query($conn,$delete);
        
        if($result_delete!=""){
            header("Location:".$adminBaseUrl."/product.php");
            exit;
        }
    }

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Product list</h3>
                    <a class="btn btn-outline-primary mb-3" href="add_product.php"><i class="fab fa-product-hunt me-1"></i> Add
                        product</a>
                </div>
                <form method="post">
                    <table id="datatable" class="table table-bordered dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product image</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Stock</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Category Name</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <td><?php echo $row['product_id'];?></td>
                                    <td><img class="category-image"src="<?php echo BASE_URL."/".$row['image']?>" alt="image"></td>
                                    <td class="h2"><?php echo $row['product_name'];?></td>
                                    <td><?php echo $row['description'];?></td>
                                    <td><?php echo $row['stock'];?></td>
                                    <td><?php echo $row['unit'];?></td>
                                    <td><?php echo $row['product_price'];?></td>
                                    <td><?php echo $row['category_name']?></td>
                                    <td class="text-primary"><?php echo ($row['active'] == 1)?'Active':'Inactive'?></td>
                                    <td><a class="btn btn-warning" href="edit_product.php?id=<?php echo $row['product_id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="product.php?id=<?php echo $row['product_id'] ?>" onclick = "return deleted();">Delete</a>
                               </td>
                                
                                </tr>
                            <?php }?>
                        </tbody>                
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<?php
     
     include_once("includes/footer.php");
     include_once("includes/bottom.php");
?>
                               
