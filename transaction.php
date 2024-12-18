<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");


$sql = "select *from orders where user_id = '" . $_SESSION['user'] . "'";
$result = mysqli_query($conn, $sql);


if (isset($_SESSION['user'])) {
    $sql1 = "select products.*,cart.* from cart join products on cart.product_id = products.product_id where cart.user_id = '" . $_SESSION['user'] . "'";
    $result1 = mysqli_query($conn, $sql1);
    $cart_total = 0;

   
} else {
    header('Location:' . BASE_URL . "/login.php");
    exit;
}
if (isset($_SESSION['payment']) && ($_SESSION['payment'] != null)) {
    $_SESSION['payment'] = "Cash on Delivery";
} else {
    $_SESSION['payment'] = "Credit Card Payment";
}

?>
<div id="page-content" class="page-content">
    <div class='mt-5'>
        <img class='banner' src="./admin/images/banner/offer.jpg">
    </div>

    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php if(isset($_GET['success']))
                        { ?>
                      <label class="col-sm-12 text-white bg-success">
                        <?php   
                          echo "Your order has been successfully Accepted"; 
                          } 
                          ?></label>
                           <?php 
                          if(isset($_GET['cancelled']))
                          {?>  
                          <label class="col-sm-12 text-white bg-danger">
                          <?php echo "Your order has been successfully Cancelled"; 
                          } 
                          ?></label>
                      <div class="table-responsive">
                          <form action="" method="post">
                              <table class="table">
                                  <thead>
                                      <tr>
  
                                          <th>No.</th>
                                          <th>Date</th>
                                          <th>Total</th>
                                          <th>Status</th>
                                          <th>Payment Method</th>

                                          <th>Details</th>
                                          <th>Action</th>
  
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr><?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                              <td><?php echo $row['order_id'] ?></td>
                                              <td>
                                                  <?php echo $row['date']; ?>
                                              </td>
                                              <td>₹
                                                  <?php echo $row['price'] ?>
                                              </td>
                                              <td class="text-<?php echo ($row['status'] == 'Delivered')?"success":(($row['status'] == 'Pending')?"warning":(($row['status'] == 'Canceled')?"danger":""))?>">
                                                <?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['payment'] ?>
                                            </td>
                                            <?php if($row['status'] != 'Canceled'){ ?>
                                              <td>
                                                  <a href="invoice.php?order_id=<?php echo $row['order_id'];?>" class="btn btn-default btn-sm">
                                                      Invoice
                                                 </a>
                                              </td>
                                              <?php } else { ?>
                                              <td></td>
                                              <?php }?>

                                              <td>
                                                  <a type="button" href="order_cancel.php?order_id=<?php echo $row['order_id'];?>" class="btn btn-danger btn-sm">
                                                      Cancel
                                                  </button>
                                              </td>
                                      </tr>
                                  <?php } ?>
                                  </tbody>
                              </table>
                          </form>
                      </div>
  
                      
                  </div>
              </div>
          </div>
      </section>
  
      
  </div>
  <?php
  include_once("includes/footer.php");
  include_once("includes/bottom.php");
  ?>