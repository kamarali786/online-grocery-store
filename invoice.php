<?php 
     include_once('includes/config.php');

     if(empty($_SESSION['user']))
     {
        header("Location:".BASE_URL."/login.php");
        exit;
     }

     if(isset($_GET['order_id']))
     {
        
        $order_id = $_GET['order_id']; 
        $sql  = "select * from order_details where order_id = '".$order_id."'";
        $result= mysqli_query($conn,$sql);

        $total_price = 0;
     }
     else
     {
        
        header("Location:".BASE_URL."/index.php");
        exit;
     }
     $sql1 = "select *from user_details where user_id = '" . $_SESSION['user'] . "'";
     $result1 = mysqli_query($conn, $sql1);
     $row1 = mysqli_fetch_assoc($result1);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" type="text/css" media="all" href="assets/css/theme.css">
    <link rel="stylesheet" type="text/css" media="all" href="assets/packages/bootstrap/bootstrap.css">
</head>
<body class="body-invoice">
    <div class="container">
    <div class="invoice-container">
        <div class="header">
            <h2>Invoice</h2>
        </div>
        <div class="invoice-details">
            <div>
                <strong class="mb-5">
                    Customer Details :
                </strong><br>
                Your Name : <?php echo $row1['name']; ?> <br>
                Your Address : <?php echo $row1['address']; ?> <br>
                City : <?php echo $row1['city']; ?> <br>
                State : <?php echo $row1['state']; ?><br>
                Email: <?php echo $row1['email']; ?><br>
                phone : <?php echo $row1['phone']; ?>
            </div>
            <div class="total">
             Date Time :<?php echo date('d-m-Y h:i:s');?>
            </div>
        </div>
        <table class="item-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>

            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['product_name'];?></td>
                        <td><?php echo $row['quantity'];?></td>
                        <td>₹ <?php echo $row['price'];?></td>
                        <td>₹ <?php echo $row['total'];?></td>
                        <?php $total_price += $row['total']?>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total: ₹ <?php echo $total_price;?></strong></p>
        </div>
        <div class="footer">
            <p>Thanks you for your business!</p>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-warning" onclick = "window.print();">Print</button>
            <a href="transaction.php" class="btn btn-danger ml-2">Back</a>
        </div>
    </div>
    </div>
</body>
</html>