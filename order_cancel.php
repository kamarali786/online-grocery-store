<?php
include_once("includes/config.php");

if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
    $sql1 = "update orders set status = 'Cancelled' where order_id = '" . $id . "' ";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
        
        header('Location:' . BASE_URL . "/transaction.php?cancelled=1");
        exit;
    }

}
