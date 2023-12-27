<?php 

    // fetching all menu items list 
    function get_menu_data($conn, $filter = null){
        $menu_items_query = "SELECT * FROM menu";
        
        $count = count($filter);
        if($count > 1){
            $filter_data = implode("', '", $filter);
        }else{
            $filter_data = implode("", $filter);
        }
        
        // echo $filter_data;
        // exit();
        if(isset($filter_data)){
            $menu_items_query .= " where category IN ('{$filter_data}')";
        }

        return mysqli_query($conn, $menu_items_query);
    }

    // $arr = ['search_item' => 'meat', 'filter' => 'food'];
    
    // $menu_items = get_menu_data($conn, $arr);

?>