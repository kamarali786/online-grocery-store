<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

$sql="select * from banners";
$result=mysqli_query($conn,$sql);

//delete banner

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $query="select image from banners where banner_id='$id'";
    $result=mysqli_query($conn,$query);

    if($row=mysqli_fetch_assoc($result)){
        $oldpath=$row["image"];
        unlink(BASE_PATH."/".$oldpath);
    }
    $delete="delete from banners where banner_id=$id";
    $result_delete=mysqli_query($conn,$delete);
    
    if($result_delete!=""){
        header("Location:".$adminBaseUrl."/banner.php");
        exit;
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Banner List</h3>
                    <a class="btn btn-outline-primary mb-3" href="add_banner.php"><i class="fa fa-plus me-1"></i> Add
                        Banner</a>
                </div>
                <form method="post">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Banner image</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($i=mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td>
                                    <?php echo"$i[banner_id]";?>
                                </td>
                                <td>
                                    <div class='mt-2'>
                                        <img src="<?php echo
                                            BASE_URL."/"."$i[image]";?>" alt='banner'class='img-rounded'width="250px"height="100px">

                                    </div>
                                </td>
                                <td class="text-primary">
                                    <?php echo($i['active']==1)?"Active":"Inactive";?>
                                </td>
                                <td><a type="submit" class="btn btn-warning" href="edit_banner.php?id=<?php echo
                                        "$i[banner_id]"?>">Edit</a>
                                    <a type="submit" class="btn btn-danger" href="banner.php?id=<?php echo
                                        "$i[banner_id]"?>" onclick='return deleted();'>Delete</a>

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