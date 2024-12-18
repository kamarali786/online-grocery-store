<?php

    $server  = "localhost";
    $user = "root";
    $password = "";
    $db = "grocery_store";

    $conn = mysqli_connect($server,$user,$password,$db);
    
    if($conn->connect_error)
    {
        die('connection failed'.mysqli_connect_error());
        exit;
    }
  ?>
   

