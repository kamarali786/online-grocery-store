<?php
date_default_timezone_set('Asia/Calcutta');
include_once("includes/config.php");

if(($_SESSION['full_total'] != "") &&  ($_SESSION['payment']))
{
    
    $sql = "insert into orders(user_id,price,status,date,payment)values('".$_SESSION['user']."','".$_SESSION['full_total']."','Pending','".date('Y-m-d')."','".$_SESSION['payment']."')";
    $result = mysqli_query($conn,$sql);
    
       
        if(mysqli_insert_id($conn))
        {
            $order_id = mysqli_insert_id($conn);  
            $sql1 = "select cart.*,products.* from cart join products on cart.product_id = products.product_id where user_id = '".$_SESSION['user']."'";
            $result1 = mysqli_query($conn,$sql1);
            
            $total_price = 0;
            
            
            while($row = mysqli_fetch_assoc($result1))
            {
                $total_price = $row['product_price'] * $row['quantity'];
                $sql = "insert into order_details(product_id,cart_id,order_id,total,quantity,product_name,price)values('".$row['product_id']."','".$row['cart_id']."','".$order_id."','".$total_price."','".$row['quantity']."','".$row['product_name']."','".$row['product_price']."') ";
                $result = mysqli_query($conn,$sql);
                
                $upadate_quantity = $row['stock'] - $row['quantity'];
                $sql3 = "update products set stock = '".$upadate_quantity."' where product_id = '".$row['product_id']."'";
                $result3 = mysqli_query($conn,$sql3);
                
                if($result)
                {
                    
                    $sql2 = "delete from cart where cart_id = '".$row['cart_id']."'";
                    $result2 = mysqli_query($conn,$sql2);
                }
                
            }
            
                 header("Location: ".BASE_URL."/transaction.php?success=1");
                 exit;
            

         }
    else
    {
        header("Location:".BASE_URL."/login.php");
        exit;
    
    }
    
}

?>
