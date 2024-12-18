<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");
if (empty($_SESSION['user'])) {
    header("Location: " . BASE_URL . "/login.php");
    exit;
}


$sql1 = "select cart.* , products.* from cart left join products on products.product_id = cart.product_id where user_id = '" . $_SESSION['user'] . "'";
$result1 = mysqli_query($conn, $sql1);
$cart_total = 0;

$sql = "select * from user_details where user_id = '" .$_SESSION['user']. "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];

    if (empty($row)) {
        $sql = "insert into user_details(user_id,name,address,city,state,email,zip_code,phone,note)values('$_SESSION[user]','$name','$address','$city','$state','$email','$zip_code','$phone','$note')";
    
    } else {
        
        $sql = "update user_details set name = '$name',address = '$address',city = '$city',state = '$state',email = '$email',zip_code = '$zip_code', phone ='$phone',note = '$note' where user_id = '" . $_SESSION['user'] . "'";
    }
    $result = mysqli_query($conn,$sql);
    if ($result) {
        if (isset($_POST['payment']) && $_POST['payment'] == 'Credit card payment') {
            $_SESSION['payment'] = $_POST['payment'];
            header("Location:" . BASE_URL . "/payment.php");
        } else {
            $_SESSION['payment'] = $_POST['payment'];
            header("Location:" . BASE_URL . "/order.php");
        }
    }

    
}
?>
<div id="page-content" class="page-content">

    <div class='mt-5'>
        <img class='banner' src="./admin/images/banner/offer.jpg">
    </div>

    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <h5 class="mb-3">BILLING DETAILS</h5>
                    <!-- Bill Detail of the Page -->
                    <form class="bill-detail" method="post">
                        <fieldset>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" placeholder="Name" pattern="^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$" type="text" name="name" required value="<?php echo ($_POST && isset($_POST['name']) ? $_POST['name'] : (isset($row['name'])?$row['name']:"")) ?>">
                                </div>

                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Address" name="address" required><?php echo ($_POST && isset($_POST['address']) ? $_POST['address'] : (isset($row['address'])?$row['address']:"")) ?></textarea>
                            </div>
                            <div class="form-group">
                                <input pattern="^[a-zA-Z][a-zA-Z\s]{0,20}" class="form-control" placeholder="Town / City" type="text" name="city" required value="<?php echo ($_POST && isset($_POST['city']) ? $_POST['city'] : (isset($row['city'])?$row['city']:"")) ?>">
                            </div>
                            <div class="form-group">
                                <input pattern="^[a-zA-Z][a-zA-Z\s]{0,20}" class="form-control" placeholder="State / Country" type="text" name="state" required value="<?php echo ($_POST && isset($_POST['state']) ? $_POST['state'] : (isset($row['state'])?$row['state']:"")) ?>">
                            </div>
                            <div class="form-group">
                                <input pattern="[0-9]{6}" class="form-control" placeholder="Postcode / Zip" type="text" name="zip_code" required value="<?php echo ($_POST && isset($_POST['zip_code']) ? $_POST['zip_code'] : (isset($row['zip_code'])?$row['zip_code']:"") )?>">
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" placeholder="Email Address" type="email" name="email" required value="<?php echo ($_POST && isset($_POST['email']) ? $_POST['email'] : (isset($row['email'])?$row['email']:"")) ?>">
                                </div>
                                <div class="col">
                                    <input class="form-control" placeholder="Phone Number" pattern="[0-9]{10}" type="text" name="phone" required value="<?php echo ($_POST && isset($_POST['phone']) ? $_POST['phone'] : (isset($row['phone'])?$row['phone']:"")) ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Order Notes" name="note"><?php echo ($_POST && isset($_POST['note'])) ? $_POST['note'] : "" ?></textarea>
                            </div>
                        </fieldset>
                        <!-- Bill Detail of the Page end -->
                </div>
                <div class="col-xs-12 col-sm-5">
                    <div class="holder">
                        <h5 class="mb-3">YOUR ORDER</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row1['product_name'] . " x " . $row1['quantity']; ?>
                                            </td>
                                            <td class="text-right">
                                                ₹ <?php echo $total =  $row1['quantity'] * $row1['product_price'];
                                                     $cart_total += $total;
                                                    

                                                    ?>

                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td>
                                            <strong>Cart Subtotal</strong>
                                        </td>
                                        <td class="text-right">
                                            ₹ <?php echo $cart_total; ?>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td>
                                            <strong>ORDER TOTAL</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong> ₹ <?php echo $_SESSION['full_total'] = $cart_total?></strong>
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>

                        <h5 class="mb-3">PAYMENT METHODS</h5>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="cash on delivery" checked>
                                Cash on delivery
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="Credit card payment">
                                Credit Card
                            </label>
                        </div>
                    </div>

                    <a href="index.php" class="btn btn-warning mt-5">Continue Shopping</a>
                    <button class="btn btn-primary float-right mt-5" name="submit">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
            </form>
    </section>
</div>
<?php

include_once("includes/footer.php");
include_once("includes/bottom.php");
?>