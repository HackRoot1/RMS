<?php 

    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    
    include("config.php");
    $user_info_query = "SELECT * FROM users_data WHERE (email = '{$_SESSION['user']}' OR username = '{$_SESSION['user']}')";
    $user_info = mysqli_query($conn, $user_info_query) or die("Query failed");

    $user_info_data = mysqli_fetch_assoc($user_info);
    echo "<pre>";
    print_r($user_info_data);
    echo "</pre>";



    // getting cart info 
    $query = "SELECT * FROM `cart` WHERE userId = {$user_info_data['id']}";
    $fetch_users_cart_details = mysqli_query($conn, $query);

    while($user_cart_details = mysqli_fetch_assoc($fetch_users_cart_details)){

        echo "<pre>";
        print_r($user_cart_details);
        echo "</pre>";


        // getting food info 
        $fetch_food_items_query = "SELECT * FROM menu WHERE id = {$user_cart_details['foodId']}";
        $fetch_food_items = mysqli_query($conn, $fetch_food_items_query);
        
        $fetch_items = mysqli_fetch_all($fetch_food_items);
        
        echo "<pre>";
        print_r($fetch_items);
        echo "</pre>";
    }


