<?php include_once("admin/includes/common_function.php")?>
<footer>
        <div class="container">
            <div class="row justify-content-between">
            
                <div class="col-md-5">
                    <h5>About</h5>
                    <p>A grocery Store is a retail establishment 
                        that primarilly sells food and other
                        house hold product for daily consumption.
                        These stores offer a wide vatiety of items, 
                        including fresh  produce,dairy products,
                        cannod goods, packaged good, and house hold 
                        essentials customers can find a diverse range 
                        of brands and products, making grocery stores
                        essential hubs for meeting everyday nutritial
                        needs. many grocery stores also provide non food
                        items such as cleaning supplies and personal
                        case products


                    </p>
                </div>
                <div class="col-md-3">
                    <h5>Links</h5>
                    <ul>
                        <li>
                            <a href="about.php">About Us</a>
                        </li>
                        <li>
                            <a href="contact.php">Contact Us</a>
                        </li>

                      
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul>
                        <li>
                            <a href="tel://<?php echo setting ('phone_number');?>"><i class="fa fa-phone"></i> <?php echo setting('phone_number'); ?></a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo setting ('email');?>"><i class="fa fa-envelope"></i> <?php echo setting ('email');?></a>
                        </li>
                    </ul>

                    <h5>Follow Us</h5>
                    <ul class="social">
                        <li>
                            <a href="<?php echo setting('fb_url');?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="<?php echo setting('insta_url');?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="<?php echo setting('yt_url');?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="<?php echo setting('x_url');?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        <p class="copyright">&copy; 2018 Freshcery | Groceries Organic Store. All rights reserved.</p>
    </footer>
    </div>