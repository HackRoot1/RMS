<?php 



function select_menu_items($conn){
    $menu_items_query = "SELECT * FROM menu";
    return mysqli_query($conn, $menu_items_query);
}

$menu_items = select_menu_items($conn);
