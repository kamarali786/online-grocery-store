<?php
ob_start();
include_once("includes/config.php");
include_once("includes/top.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from products where product_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $category_id = $row['category_id'];
    $product_id = $row['product_id'];
    $stock = $row['stock'];
    $count = 0;

    $sql1 = "select product_reviews.*,users.name from product_reviews left join users on product_reviews.user_id = users.user_id where product_id ='" . $id . "' and status = 1 order by product_reviews.review_id desc";
    $result = mysqli_query($conn, $sql1);

    $sql2 = "SELECT rating, COUNT(*) as count,count(review_id) as review_id FROM product_reviews where product_id = '" . $product_id . "' and status = 1 GROUP BY rating";
    $result2 = mysqli_query($conn, $sql2);
    // //$rating = mysqli_fetch_assoc($result2);
    $sql_total = "SELECT SUM(review_id) AS overall_total_reviews FROM ($sql2) AS subquery";
    $result_total = mysqli_query($conn, $sql_total);
    if ($result_total) {
        $row_total = mysqli_fetch_assoc($result_total);
        //echo "Overall Total Reviews: " . $row_total['overall_total_reviews'];
        $total_review = $row_total['overall_total_reviews'];
    }

    $star1 = 0;
    $star2 = 0;
    $star3 = 0;
    $star4 = 0;
    $star5 = 0;
    if ($result2->num_rows > 0) {
        // Output data of each row
        while ($row2 = $result2->fetch_assoc()) {


            if ($row2['rating'] == 5) {
                $total_5star = $row2['count'];
                $star5 = $row2['count'] * 100 / $total_review;
                //$star5 = round($star5) . "%";
                $star5 = ($star5) . "%";
            }
            if ($row2['rating'] == 4) {
                $total_4star = $row2['count'];
                $star4 = $row2['count'] * 100 / $total_review;
                $star4 = ($star4) . "%";
            }
            if ($row2['rating'] == 3) {
                $total_3star = $row2['count'];
                $star3 = $row2['count'] * 100 / $total_review;
                $star3 = ($star3) . "%";
            }
            if ($row2['rating'] == 2) {
                $total_2star = $row2['count'];
                $star2 = $row2['count'] * 100 / $total_review;
                $star2 = ($star2) . "%";
            }
            if ($row2['rating'] == 1) {
                $total_1star = $row2['count'];
                $star1 = $row2['count'] * 100 / $total_review;
                $star1 = ($star1) . "%";
            }
        }
    }
}
$sql = "select * from products where category_id = $category_id";
$result1 = mysqli_query($conn, $sql);

?>

<div class='mt-5'>
    <img class='banner' src="./admin/images/banner/offer.jpg">
</div>

<div class="product-detail">

    <h2 class="title">Product Details</h2>
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="slider-zoom">
                    <div class="card">
                        <img alt="Detail Zoom thumbs image" src="<?php echo BASE_URL . "/" . $row['image']; ?>"
                            style="width: 100%; margin-top: 50px;">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <p>
                <h5><strong>Description</strong></h5><br>
                <?php echo $row['description']; ?>
                </p>
                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            <strong>Price</strong> (/Pack)<br>
                            <span class="price">₹ <?php echo $row['product_price'] ?></span>
                            <span class="old-price">₹ <?php echo $row['product_price'] * 2 ?></span>
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>
                            <span
                                class="stock <?php echo ($row['stock'] > 0) ? "available" : "empty"; ?>"><?php echo ($row['stock'] > 0) ? "In stock" : "out of stock"; ?>
                                : <?php echo $row['stock'] ?></span>
                        </p>
                    </div>
                </div>

                <div style="display: none;" id="quantity">
                    <p class="mb-1">
                        <strong>Quantity</strong>
                    </p>
                    <div class="row">
                        <div class="col-sm-5">
                            <input value="1" class="vertical-spin" type="text"
                                data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary"
                                name="quantity">
                        </div>
                        <div class="col-sm-6"><span class="pt-1 d-inline-block">Pack (<?php echo $row['unit'] ?>)</span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <form method="post">
                        <a class="mt-5 btn btn-primary btn-lg text-white" id="add1" onclick="addToCart();">
                            <i class="fa fa-shopping-basket"></i> Add to Cart
                        </a>
                        <a class="mt-5 btn btn-primary btn-lg text-white" id="add2" style="display: none;"
                            onclick="addToCart();" href="cart.php?id=<?php echo $row['product_id'] ?>">
                            <i class="fa fa-shopping-basket"></i> Go to Cart
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<section id="related-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">Related Products</h2>
                <div class="product-carousel owl-carousel">
                    <?php while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                    <div class="item">
                        <a href="product.php?id=<?php echo $row1['product_id'] ?>">
                            <div class="card card-product">

                                <img src="<?php echo BASE_URL . "/" . $row1['image'] ?>" alt="Card image 2"
                                    class="card-img-top" style="height: 250px; padding:25px">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a
                                            href="product.php?id=<?php echo $row1['product_id'] ?>"><?php echo $row1['product_name'] ?></a>
                                    </h4>
                                    <div class="card-price">
                                        <span class="discount">₹ <?php echo $row1['product_price'] * 5 ?></span>
                                        <span class="reguler">₹ <?php echo $row1['product_price'] ?></span>
                                    </div>
                                    <a href="product.php?id=<?php echo $row1['product_id'] ?>"
                                        class="btn btn-block btn-primary">
                                        Add to Cart
                                    </a>

                                </div>

                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card container p-5 mt-5">
        <div class="row justify-content-between">
            <h2>Ratings & Reviews</h2>
            <div style="margin-left: 300px;">
                <a href="review.php?id=<?php echo $row['product_id']; ?>"
                    class="btn btn-outline-dark btn-lg text-uppercase">Rate Product</a>
            </div>
        </div>
        <p>4.1 average based on <?php echo $total_review ? $total_review : '';
                                ?> reviews.</p>
        <hr style="border:3px solid #f1f1f1">

        <div class="row">
            <div class="side">
                <div>5 star</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-5" style="width: <?php echo $star5; ?>;"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo isset($total_5star)?$total_5star:"0"?></div>
            </div>
            <div class="side">
                <div>4 star</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-4" style="width: <?php echo $star4; ?>;"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo isset($total_4star)?$total_4star:"0"?></div>
            </div>
            <div class="side">
                <div>3 star</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-3" style="width: <?php echo $star3; ?>;"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo isset($total_3star)?$total_3star:"0"?></div>
            </div>
            <div class="side">
                <div>2 star</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-2" style="width: <?php echo $star2; ?>;"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo isset($total_2star)?$total_2star:"0"?></div>
            </div>
            <div class="side">
                <div>1 star</div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-1" style="width: <?php echo $star1; ?>;"></div>
                </div>
            </div>
            <div class="side right">
                <div><?php echo isset($total_1star)?$total_1star:"0"?></div>
            </div>
        </div>

    </div>
    <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
    <div class="card p-3 container">

        <div style="display: inline-block;">
            <span
                class="fa fa-star <?php echo (isset($row2['rating']) && ($row2['rating'] >= 1)) ? 'checked' : "" ?>"></span>
            <span
                class="fa fa-star <?php echo isset($row2['rating']) && ($row2['rating'] >= 2) ? 'checked' : "" ?>"></span>
            <span
                class="fa fa-star <?php echo isset($row2['rating']) && ($row2['rating'] >= 3) ? 'checked' : "" ?>"></span>
            <span
                class="fa fa-star <?php echo isset($row2['rating']) && ($row2['rating'] >= 4) ? 'checked' : "" ?>"></span>
            <span
                class="fa fa-star <?php echo isset($row2['rating']) && ($row2['rating'] >= 5) ? 'checked' : "" ?>"></span>
        </div>
        <div class="pt-4">
            <strong><?php echo $row2['name'] ?></strong>
        </div>
        <div class="pt-4">
            <span><?php echo $row2['message'] ?></span>
        </div>

    </div>
    <?php } ?>
</section>

<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>

<script>
function addToCart() {

    quantity = $('[name="quantity"]').val()
    if (<?php echo $stock ?> < quantity) {
        alert('Stock not available');
    }
    if (quantity == 0) {
        alert('Minimum 1 Product Select');
    } else {
        $.ajax({
            url: 'add_cart.php',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: "<?php echo $product_id ?>",
                quantity: quantity,
            },
            success: function(response) {

                $("#quantity").show();
                $("#add1").hide();
                $("#add2").show();
            },
            error: function(response) {
                window.location.href = "login.php";
            }
        });
    }
}
</script>