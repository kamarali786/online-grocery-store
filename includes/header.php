<?php 
  include_once("admin/includes/common_function.php");
  include_once("includes/config.php");

  if(isset($_SESSION['user']))
  {  
     $sql = "select users.name,user_details.image from users left join user_details on users.user_id = user_details.user_id where users.user_id = '".$_SESSION['user']."'";
     $result = mysqli_query($conn,$sql);
     
     $row = mysqli_fetch_assoc($result);
  }
?>

<nav class="navbar fixed-top navbar-expand-md navbar-dark" id="page-navigation">
            <div class="container">
                <!-- Navbar Brand -->
                <a href="index.php" class="navbar-brand">
                    <img src="<?php echo setting('logo');?>" alt="">
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarcollapse">
                    <!-- Navbar Menu -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link"><i class ="fa fa-home"></i> Home</a>
                        </li>
                        <?php if(!isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link"><i class ="fa fa-registered"></i> Register</a>
                        </li>
                        <?php } ?>   
                        <?php if(!isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a href="login.php" class="nav-link"><i class="fa fa-user"></i> Login</a>
                        </li>
                        <?php } ?>        
                        <?php if(!empty($_SESSION['user'])) {?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar-header"><img src=<?php echo isset($row['image'])?BASE_URL."/".$row['image']:""?>></div> <?php echo isset($row['name'])?$row['name']:""?>
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="Profile.php"> Profile</a>
                                <a class="dropdown-item" href="transaction.php">My Order</a>
                                <a class="dropdown-item" href="logout.php">Log out</a>
                                
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="feedback.php" class="nav-link"><i class="fa fa-comment"></i> FeedBack</a>
                        </li>
                        <?php } ?>
                      
                        <li class="nav-item dropdown">
                            <a href="cart.php" class="nav-link">
                                <i class="fa fa-shopping-basket"></i> Cart
                            </a>
                            
                        </li>
                    </ul>
                </div>

            </div>
        </nav>