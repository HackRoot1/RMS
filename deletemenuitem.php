<?php 

    include("config.php");

    $menu_item_id = $_POST['menuItem'];

    $query = "DELETE FROM menu WHERE id = {$menu_item_id}";
    
    if(mysqli_query($conn, $query)){
        echo 1;
    }else{
        echo 0;
    }

?>