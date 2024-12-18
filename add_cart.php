<?php

include_once("includes/config.php");

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id  = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    $sql = "select * from cart where product_id = '" . $product_id . "' and  user_id = '".$_SESSION['user']."'";
    $result =  mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  
    
    if (!empty($row)) {
        $sql1 = "update cart set quantity = '" . $quantity . "' where product_id = '" . $product_id . "'and user_id = '".$_SESSION['user']."'";
    } else {
        $sql1 = "insert into cart(user_id,product_id,quantity) values ('".$_SESSION['user']. "','" . $product_id . "','" . $quantity . "')";
    }
    $result1 = mysqli_query($conn, $sql1);
    
    if ($result1) {
        $data = array(
            'id' => $product_id,
            'quantity' => $quantity,
        );
        $jsonData = json_encode($data);
        echo $jsonData;
        exit;
    }
}
