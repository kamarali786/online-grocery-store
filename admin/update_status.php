<?php

include_once("includes/config.php");
if (isset($_POST['status']) && isset($_POST['id'])){
      $order_status = $_POST['status'];
      $order_id = $_POST['id'];
      $sql = "update orders set status = '".$order_status."'where order_id = '".$order_id."'";
      $result = mysqli_query($conn,$sql);        
        $data = array(
            'id' => $order_id,
            'status' => $order_status,
             
        );
        $jsonData = json_encode($data);
        echo $jsonData;
        exit;
    
}

  

