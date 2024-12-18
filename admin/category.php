<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

$sql = "select * from categories";
$result = mysqli_query($conn,$sql);

// delete category

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $query="select image from categories where category_id='$id'";
    $result=mysqli_query($conn,$query);

    if($row=mysqli_fetch_assoc($result)){
        $oldpath=$row["image"];
        unlink(BASE_PATH."/".$oldpath);
    }
    $delete="delete from categories where category_id=$id";
    $result_delete=mysqli_query($conn,$delete);
    
    if($result_delete!=""){
        header("Location:".$adminBaseUrl."/category.php");
        exit;
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Category List</h3>
                    <a class="btn btn-outline-primary mb-3" href="add_category.php"><i class="fa fa-th-list me-1"></i> Add
                        category</a>
                </div>
                <form method="post">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category image</th>
                                <th>Category Name</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <tr>
                                <td><?php echo $row['category_id'] ?></td>
                                 
                                <td><img class="category-image"src="<?php echo BASE_URL."/".$row['image']?>" alt="image"></td>
                                <td class="h2"><?php echo $row['category_name'] ?></td>
                                <td class="text-primary"><?php echo ($row['active'] == 1)?'Active':'Inactive'?></td>
                                <td><a class="btn btn-warning" href="edit_category.php?id=<?php echo $row['category_id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="category.php?id=<?php echo $row['category_id'] ?>" onclick = "return deleted();">Delete</a>
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
      include("includes/footer.php");
      include("includes/bottom.php");
?>