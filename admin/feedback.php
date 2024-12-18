<?php
{
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

$sql = "select feedback.*,users.name from feedback left join users on feedback.user_id = users.user_id ";
$result = mysqli_query($conn,$sql);

if(isset($_GET['id']))
{
    $feedback_id = $_GET['id'];
    $sql1 = "delete from feedback where feedback_id = '".$feedback_id."'";
    $result1 = mysqli_query($conn,$sql1);
}

}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Feedback List</h3>
                    
                </div>
                <form method="post">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Feedback ID</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Message</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           <?php while($row = mysqli_fetch_assoc($result)) {?>
                            <tr>
                                <td><?php echo $row['feedback_id'];?></td>
                                <td><?php echo $row['user_id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['message'];?></td>
                                <td><a class="btn btn-danger" onclick= 'return deleted();' href="feedback.php?id=<?php echo $row['feedback_id'];?>">Delete</a></td>
                                
                            </tr>
                            <?php } ?>
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