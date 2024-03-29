<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include("config.php");
$user_info_query = "SELECT * FROM users_data WHERE (email = '{$_SESSION['user']}' OR username = '{$_SESSION['user']}')";
$user_info = mysqli_query($conn, $user_info_query) or die("Query failed");

$user_info_data = mysqli_fetch_assoc($user_info);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- ========= icons link ========== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- =========== css link ========== -->
    <link rel="stylesheet" href="./assets/css/form.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/view_data.css">
    <link rel="stylesheet" href="./assets/css/menuedit.css">
    <link rel="stylesheet" href="./assets/css/checkout.css">


    <!-- =========== google fonts ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,500&display=swap" rel="stylesheet">

    
    <!-- ============ jquery cdn link ============ -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


  
</head>
<body>
        <!--  =============== sidebar =============  -->
    <section id = "sidebar">    
        <div>
            <div class = "title">
                Bistro
            </div>

            <div class = "links">
                <a href="index.php">
                    <i class = "uil uil-home"></i>
                    <span>Home</span>
                </a>
                <a href="addMenu.php">
                    <i class = "uil uil-file-blank"></i>
                    <span>View Menu</span>
                </a>
                <!-- <a href="#">
                    <i class = "uil uil-puzzle-piece"></i>
                    <span>Overview</span>
                </a> -->
                <a href="customers.php">
                    <i class = "uil uil-users-alt"></i>
                    <span>Customer</span>
                </a>
                <a href="cart.php">
                    <i class = "uil uil-shopping-cart-alt"></i>
                    <span>Cart</span>
                </a>
                <a href="orders.php">
                    <i class = "uil uil-usd-square"></i>
                    <span>Orders</span>
                </a>
            </div>
        </div>


        <div class = "signout">
            <a href="">
                <form action="" method="post">
                    <i class="uil uil-signout"></i>
                    <span id = "logout-btn">
                        <input type="submit" value="Logout" name = "logout">
                        <!-- Logout -->
                    </span>
                </form>
            </a>
            <a href="./settings.php">
                <i class = "uil uil-setting"></i>
                <span>Settings</span>
            </a>
        </div>
    </section>


    <!-- =============== main container =============== -->
    <main id = "main-container">
        <nav>
            <div class="title">Good Morning <?php echo $user_info_data['username']; ?></div>
            <div class="search">
                <input type="search" placeholder="Search">
            </div>
        </nav>
