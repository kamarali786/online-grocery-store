<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

$sql = "select users.name,products.product_name,product_reviews.* from product_reviews left join products on product_reviews.product_id = products.product_id left join users on product_reviews.user_id = users.user_id  where product_reviews.status = 0 order by product_reviews.review_id desc";
$result = mysqli_query($conn, $sql);

if (isset($_GET['id']) || isset($_GET['reject_id'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "update product_reviews set status = 1 where review_id = '" . $id . "'";
    } else {
        $id = $_GET['reject_id'];
        $sql = "update product_reviews set status = 2 where review_id = '" . $id . "'";
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location:' . $adminBaseUrl . '/review.php');
        exit;
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Ratings & Reviews list</h3>

                </div>
                <form method="post">
                    <div style="overflow-x: auto;">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['review_id'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['product_id'] ?></td>
                                        <td><?php echo $row['product_name'] ?></td>
                                        <td>

                                            <span class="fa fa-star <?php echo (isset($row['rating']) && ($row['rating'] >= 1)) ? 'checked' : "" ?>"></span>
                                            <span class="fa fa-star <?php echo isset($row['rating']) && ($row['rating'] >= 2) ? 'checked' : "" ?>"></span>
                                            <span class="fa fa-star <?php echo isset($row['rating']) && ($row['rating'] >= 3) ? 'checked' : "" ?>"></span>
                                            <span class="fa fa-star <?php echo isset($row['rating']) && ($row['rating'] >= 4) ? 'checked' : "" ?>"></span>
                                            <span class="fa fa-star <?php echo isset($row['rating']) && ($row['rating'] >= 5) ? 'checked' : "" ?>"></span>

                                        </td>
                                        <td><?php echo $row['message'] ?></td>
                                        <td>
                                            <a class="btn btn-success" href="review.php?id=<?php echo $row['review_id']; ?>"><i class="mdi mdi-check-all me-2"></i>Approve</a>
                                            <a class="btn btn-danger" href="review.php?reject_id=<?php echo $row['review_id']; ?>"><i class="mdi mdi-block-helper me-2"></i>Reject</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
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