<?php 


    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }

    include("config.php");
    $user_info_query = "SELECT * FROM users_data WHERE (email = '{$_SESSION['user']}' OR username = '{$_SESSION['user']}')";
    $user_info = mysqli_query($conn, $user_info_query) or die("Query failed");

    $user_info_data = mysqli_fetch_assoc($user_info);


    $id = $_POST['itemId'];
   
    $query = "DELETE FROM cart WHERE foodId = {$id} AND userId = {$user_info_data['id']}";
    
    if(mysqli_query($conn, $query)){
        echo 1;
    }else{
        echo 0;
    }
?>