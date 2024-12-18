<?php {
    ob_start();
    include_once("includes/config.php");
    include_once("includes/top.php");

    $sql = "select users.name,orders.* from orders left join users on orders.user_id = users.user_id";
    $result = mysqli_query($conn, $sql);
    if (isset($_GET['id'])) {

        $order_id = $_GET['id'];
        $sql1 = "delete fr  om orders where order_id = '" . $order_id . "'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            header("Location:" . $adminBaseUrl . "/orders_detail.php");
            exit;
        }
    }
}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h3>Order List</h3>

                </div>
                <form method="post">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User Name</th>
                                <th>Total Amount</th>
                                <th>Order Date</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>update</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $order_id =  $row['order_id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['payment'] ?></td>

                                <td
                                    class="text-<?php echo ($row['status'] == 'Delivered') ? "success" : (($row['status'] == 'Pending') ? "warning" : (($row['status'] == 'Cancelled') ? "danger" : "")) ?>">
                                    <?php echo $row['status'] ?>
                                </td>
                                <td>

                                    <select id="up_order" data-order-id="<?php echo $row['order_id'] ?>"
                                        onchange="update_status(this);">
                                        <option value=""> ------ </option>
                                        <option value="In Process">In Process</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Cancelled">Cancelled</option>


                                    </select>
                                </td>
                                <td><a class="btn btn-danger" href="orders_detail.php?id=<?php echo $row['order_id'] ?>"
                                        onclick='return deleted();'>Delete</a>
                                </td>

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

<script>
function update_status(select) {

    Swal.fire({
        title: "Are you sure ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Update it!"
    }).then((result) => {
        if (result.isConfirmed) {
            status = $(select).val();
            order_id = $(select).data("order-id");
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: order_id,
                    status: status,
                },
                success: function(response) {
                    window.location.href = "orders_detail.php";
                }
            })
        }
    });

}
</script>

