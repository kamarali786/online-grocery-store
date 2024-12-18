<?php
include_once("includes/config.php");
include_once("includes/top.php");

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="select products.*,categories.image as category_image,categories.category_name from products right join categories on products.category_id=categories.category_id where categories.category_id='$id'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
   
}
?>
<div class="page-content mb-5">
    <div class="mt-5">
        <img class='banner' src='<?php echo BASE_URL.'/'.$row['category_image']?>'>
    </div>
    <div class="container text-center rounded-0">
        <div class="text-primary">
            <h1 class="pt-3">
                BUY
                <?php echo $row['category_name'];?>
            </h1>
            <p class="lead">Save the time, buy groceries from us.</p>
        </div>
     
        <?php if ($row['product_id'] <= 0){?>
        <div class="card m-5">
            <h1>PRODUCTS NOT AVAILABLE</h1>
        </div>
        <?php } else {?>
        <div class="row justify-content-start">
            <?php mysqli_data_seek($result,0);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <a href="product.php?id=<?php echo $row['product_id'] ?>">
                <div class="product-card">
                    <img class="product-img" src="<?php echo BASE_URL.'/'.$row['image'] ?>" alt="Product 1 Image">
                    <div class="product-details">
                        <h4 class="product-title">
                            <?php echo $row['product_name']?>
                        </h4>
                        <p class="product-price">₹
                            <?php echo $row['product_price']?>
                        </p>
                        <p class="product-unit">
                            <?php echo $row['unit']?>
                        </p>

                        <a class="btn btn-primary add-cart-btn" href="product.php?id=<?php echo $row['product_id']?>"><i
                                class="fa fa-eye-dropper"></i>View Product</a>
                    </div>
                </div>
                </a>
                <?php }} ?>
        </div>
    </div>
</div>
<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>

