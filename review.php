<?php
ob_start();
include("includes/config.php");
include("includes/top.php");


if (isset($_GET['id']) && isset($_SESSION['user'])) {


    $product_id = $_GET['id'];
    $sql1 = "select count(*) as total_review from product_reviews where user_id = '" . $_SESSION['user'] . "' and product_id = '" . $product_id . "'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $sql2 = "select count(*) as total_purchase from order_details left join orders on order_details.order_id = orders.order_id  where orders.user_id = '" . $_SESSION['user'] . "' and order_details.product_id = '" . $product_id . "' and orders.status = 'Delivered'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    
    if (isset($row2['total_purchase']) && isset($row1['total_review']) && ($row2['total_purchase'] <= $row1['total_review'])) {
        $sql = "select * from product_reviews where user_id = '" . $_SESSION['user'] . "' and product_id = '" . $product_id . "'";
        $result = mysqli_query($conn, $sql);
        $data1 = [];
        $row = $result->fetch_assoc();
        if (isset($row['status']) && ($row['status'] != 1)) {
            $data1[] = $row;
            $id = $row["review_id"];
        } else {
            $id = isset($row["review_id"]) ? $row["review_id"] : "";
        }
    }
}
if (isset($_POST['submit']) && isset($product_id)) {
    $id = null;
    $rating = isset($_POST['rating']) ? $_POST['rating'] : "";
    $review = $_POST['message'];
    if ($rating == "" || $review == "") {
        $error = "Rating and review are required fields.";
    } else {
        $review_check = preg_match("/^[a-zA-Z0-9\s].+$/", $review);
        if (empty($review_check)) {
            $error = "Message should contain only alphabetic characters";
        }
    }
    if (!empty($review_check)) {
        $sql1 = "insert into product_reviews(user_id,product_id,rating,message,status)values('" . $_SESSION['user'] . "','" . $product_id . "','" . $rating . "','" . $review . "', '0')";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            $message = "Thanks for sharing your rating with us ";
            header('Location:' . BASE_URL . "/review.php?id=$product_id");
            exit;
        }
    }
}



?>
<?php if (isset($row2['total_purchase']) && isset($row1['total_review']) && ($row2['total_purchase'] > $row1['total_review'])) {  ?>


    <div class="container review-card p-5">
        <form action="" method="post">
            <div class="page-content card p-3 mb-4">
                
                <h2>Rate this Product:</h2>

                <div class="rating">
                    <input type="radio" id="star5" class="rating" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" id="star4" class="rating" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" id="star3" class="rating" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" id="star2" class="rating" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" id="star1" class="rating" name="rating" value="1">
                    <label for="star1"></label>

                </div>
            </div>
            <div class="card mt-5 p-3">
                <h2 class="mb-3">Review this Product:</h2>
                <textarea class="p-3" name="message" id="message" cols="30" rows="10" placeholder="Description.."></textarea>
            </div>
            <div class=" row justify-content-end mt-3">
                <button class="btn btn-warning mr-3" name="submit" onclick=" return validateForm()">Review Submit</button>
            </div>
            <span class="mt-3 text-danger lead"><?php echo isset($error) ? "Note : " . $error : "" ?></span>
        </form>
    </div>
<?php } else { ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <span>
                 
                <?php echo isset($message) ? $message : "" ?>
            </span>
            <h1 class="text-danger">Haven't purchased this product? </h1>
            <strong>Sorry! You are not allowed to review this product since you haven't bought it on Store.</strong>
        </div>
    </div>
<?php } ?>


</body>

</html>
<script>
    function validateForm() {
        var rating = document.getElementsByClassName(".rating").value;
        var review = document.getElementById("message").value;
        var id = "<?php echo $id ?>"
        // Check if rating and review fields are empty        
        if (review == "" || rating == "") {
            alert("rating and review are required fields.");
            return false;
        }
        if (id != "") {
            alert("Review Submited Already 🙄🙄");
            return false;
        } else {
            var regex = /^[a-zA-Z0-9\s]+$/;
            if (!regex.test(review)) {
                alert("Message should contain only alphabetic characters");
                return false;
            }
        }
    }
</script>