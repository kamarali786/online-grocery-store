<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if (isset($_POST['submit'])) {
    $total = 0;
    $dateRange = $_POST['daterange'];
  
    list($startDate, $endDate) = explode(" - ", $dateRange);
    //$start_date = $_POST['date1'];
    $startDate = strtotime($startDate);
    $startDate = date('Y-m-d', $startDate);
    echo $startDate;
    
    //$end_date = $_POST['date2'];
    $endDate = strtotime($endDate);
    $endDate = date('Y-m-d', $endDate);
    echo $endDate;

    $sql = "select orders.* , order_details.*,products.*,sum(order_details.quantity) as total_quantity,sum(order_details.total) as total_price from order_details left join orders on order_details.order_id = orders.order_id left join products on order_details.product_id = products.product_id where date between '" . $startDate . "' and '" . $endDate . "' and orders.status = 'Delivered' group by products.product_id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
   

}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-3">
                    <h1>Selling Report</h1>

                </div>

                <form method="post" action="report.php">
                    <div class="d-flex mb-5 ">
                        <h3 class="me-5">Search</h3>
                    
                        <input type="text" class="ms-2 form-control js-daterangepicker" name="daterange">

                        <button name="submit" class="btn btn-dark ms-4">Search</button>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Unit</th>
                                <th>quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)){?>
                            <tr>
                                <td><?php echo $row['product_id']?></td>
                                <td><?php echo $row['product_name']?></td>
                                <td><img class="category-image" src="<?php echo BASE_URL."/".$row['image'];?>" alt=""></td>
                                <td><?php echo $row['unit']?></td>
                                <td><?php echo  $row['total_quantity']?></td>
                                <td>₹ <?php echo $row['product_price']." x ".$row['total_quantity']?></td>
                                <td>₹ <?php echo $row['total_price'];  
                                     $total +=  $row['total_price']  ?></td>
                                
                            </tr>
                            
                            
                            
                            <?php } ?>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">Total</td>
                                <td class="font-weight-bold">₹ <?php echo isset($total)?$total:""?></td>
                                
                            </tr>
                            
                        </tfoot>
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
<script>
    
  $(document).ready(function () {
    // initialization of daterangepicker
    $('.js-daterangepicker').daterangepicker()
  });


</script>

    