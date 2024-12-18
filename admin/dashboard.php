<?php
ob_start();

include_once("includes/config.php");
include("includes/top.php");

$sql = "select * from orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);

$sql2 = "select * from orders where status = 'Delivered'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_num_rows($result2);

$sql3 = "select * from orders where status = 'Pending'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_num_rows($result3);

$sql4 = "select * from orders where status = 'Canceled'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_num_rows($result4);

$currentYear = date('Y');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date('Y');
$previousYear = 5;

$selling_report = "select MONTH(orders.date) as month,sum(order_details.total) as total_price from orders left join order_details on order_details.order_id = orders.order_id where year(orders.date)  = '" . $selectedYear . "' and orders.status = 'Delivered' GROUP BY MONTH(orders.date) ORDER BY MONTH(orders.date)";
$result_sellingReport = mysqli_query($conn, $selling_report);

$totalSales = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);
if ($result_sellingReport->num_rows > 0) {

    while ($row1 = $result_sellingReport->fetch_assoc()) {
        $months = ($row1['month']);
        $totalSales[$months] = intval($row1['total_price']);
    }
}
?>
<div class="page-wrapper">
    <div class="page-content">
        <h1 class="mb-5">Order Summary</h1>
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"> Total Orders</p>
                                <h4 class="my-1"><?php echo $row ?></h4>
                            </div>
                            <div class="widgets-icon bg-light-success text-primary ms-auto">
                                <i class="bx bxs-shopping-bag-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"> Pending Orders</p>
                                <h4 class="my-1"><?php echo $row3 ?></h4>
                            </div>
                            <div class="widgets-icon bg-light-warning text-warning ms-auto">
                                <i class="bx bxs-cart-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"> Delivered Orders</p>
                                <h4 class="my-1"><?php echo $row2 ?></h4>
                            </div>
                            <div class="widgets-icon bg-light-success text-success ms-auto">
                                <i class="bx bxs-shopping-bag-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"> Canceled Orders</p>
                                <h4 class="my-1"><?php echo $row4 ?></h4>
                            </div>
                            <div class="widgets-icon bg-light-danger text-danger ms-auto">
                                <i class="bx bxs-shopping-bag-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container mt-3">
            <div class="d-flex align-items-center d-inline-block">
                <span class="me-3">Select Year</span>
                <form name="form" id="myForm" method="post">
                    <select name="year" id="year1" class="form-select" aria-label="Default select example">
                        <option value="select"><?php echo isset($_POST) ? $selectedYear : "Select" ?></option>
                        <?php for ($i = 0; $i < $previousYear; $i++) {
                            $year = $currentYear - $i;
                        ?>
                            <option value="<?php echo $year ?>"><?php echo $year ?></option>
                        <?php } ?>
                    </select>
                </form>

            </div>
        </div>


    </div>
</div>

<div class="card p-5 container">
    <canvas id="myChart"></canvas>
</div>

<?php

include("includes/footer.php");
include("includes/bottom.php");
?>
<script>
    document.getElementById("year1").addEventListener("change", function() {
        // Get the selected year
        var selectedYear = this.value;
        // Modify the form action to include the selected year
        document.getElementById("myForm").action = "dashboard.php?year=" + selectedYear;
        // Submit the form
        document.getElementById("myForm").submit();
    });
    const ctx = document.getElementById('myChart');
    var total = <?php echo json_encode(array_values($totalSales)) ?>;
    new Chart(ctx, {
        type: 'bar',
        Animation: true,
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],

            datasets: [{
                label: 'Total Seling',
                data: total,
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    function selected() {

        $.ajax({
            url: 'dashbord.php',
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
        return;
    };
</script>