<?php
include_once("includes/config.php");
include_once("includes/top.php");
$sql="select * from banners where active=1";
$result=mysqli_query($conn,$sql);
$sql="select * from categories where active=1";
$result1=mysqli_query($conn,$sql);

?>

<div id="slider-container">
    <div id="slider" class="jumbotron-rg">
        <?php while ($row =mysqli_fetch_assoc($result)){?>
        <div class="slide"><img src="<?php echo BASE_URL." /".$row['image'];?>"alt="slide 1"></div>
        <!-- ADD more slides as needed-->
        <?php } ?>
    </div>
    <div id="prev" onclick="prevSlide()">&#10094;</div>
    <div id="next" onclick="nextSlide()">&#10095;</div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">categories</h2>
                <div class="product-carousel owl-carousel">
                    <?php while($row1=mysqli_fetch_assoc($result1)){?>
                    <div class="item">
                        <div class="card card-product">
                            <div class="card-badge" style="height:200px;">
                                <a href="category.php?id=<?php echo $row1['category_id'];?>">
                                    <img src="<?php echo BASE_URL.'/'.$row1['image']?>" alt="category images"
                                        class="card-img-top" style="height:200px;">
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="category.php?id=<?php echo $row1['category_id'];?>"
                                    class="btn btn-block btn-primary">
                                    <?php echo $row1['category_name']?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php
include_once("includes/footer.php");
include_once("includes/bottom.php");
?>