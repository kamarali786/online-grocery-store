<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");
if (empty($_SESSION['user'])) {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}


$sql = "select products.*,cart.* from cart left join products on cart.product_id = products.product_id where cart.user_id = '" . $_SESSION['user'] . "'";
$result = mysqli_query($conn, $sql);


$total = 0;

//delete product from cart

if (isset($_GET['cart_id'])) {

    $id = $_GET['cart_id'];
    $sql1 = "delete from cart where cart_id = '" . $id . "' ";
    $result1 = mysqli_query($conn, $sql1);
}

//show empty cart
$sql2 = "select * from cart where user_id = '".$_SESSION['user']    ."'";
$result2 = mysqli_query($conn, $sql2);
$row1 = mysqli_fetch_assoc($result2);

if (empty($row1)) {
    $empty = "Your cart is empty. Please continue shopping....";
}
?>
<div class='mt-5'>
    <img class='banner' src="./admin/images/banner/offer.jpg">
</div>
<?php if (isset($empty) && $empty != null) { ?>
    <div class='card m-5'>
        <h1 class="p-5 text-danger"><?php echo isset($empty) ? $empty : ""; ?></h1>
    </div>
        <div class="col mx-5 mb-5">
            <a href="index.php" class="btn btn-warning">Continue Shopping</a>
        </div>
        
<?php ; } 
  else{?>
<div id="page-content" class="page-content">

    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%"></th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th width="15%">Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id']; ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo $row['image']; ?>" width="60">
                                        </td>
                                        <td>
                                            <?php echo $row['product_name']; ?><br>
                                            <small><?php echo $row['unit']; ?></small>
                                        </td>
                                        <td>
                                            <?php echo " ₹ " . $row['product_price']; ?>
                                        </td>
                                        <form method="post">
                                        <td>
                                            <?php echo $row['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo " ₹ " . $row['product_price'] * $row['quantity'];
                                            $total = $row['product_price'] * $row['quantity'] + $total;

                                            ?>
                                        </td>
                                            <td>
                                                <a class="text-danger" href="cart.php?cart_id=<?php echo $row['cart_id']; ?>"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mt-5">
                    <a href="index.php  " class="btn btn-warning">Continue Shopping</a>
                </div>
                <div class="col text-right">
                    <div class="clearfix"></div>
                    <h6 class="my-3">Total: <?php echo  " ₹ " . $total; ?></h6>
                    <a href="checkout.php" class="btn btn-lg btn-primary">Checkout <i class="fa fa-shopping-bag ml-2"></i></a>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
<?php }?>
<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>
