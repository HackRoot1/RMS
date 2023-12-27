<?php 

    include("config.php");


    $userId = $_POST['userId'];
    $foodId = $_POST['foodId'];

    $query = "INSERT INTO cart(foodId, userId) VALUES('{$foodId}', '{$userId}')";
    // $run_query = mysqli_query($conn, $query);

    if(mysqli_query($conn, $query)){
        echo 1;
    }else{
        echo 0;
    }
    
?>