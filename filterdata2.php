<?php 


    include("config.php");

    $filter_value = json_decode($_POST["data"], true);

    $menu_items_query = "SELECT * FROM `menu`";

    if (is_array($filter_value) && count($filter_value) > 0) {
        
        $filter_value = " ' " . implode( "', '", $filter_value) . " ' ";
        
        $menu_items_query = "SELECT * FROM menu WHERE category IN ({$filter_value});";   

        echo $menu_items_query;
        exit();
    }
    
    $menu_items =  mysqli_query($conn, $menu_items_query);
    


?>


<div class="boxes">

    <?php 
    if(mysqli_num_rows($menu_items) > 0){

        while($items = mysqli_fetch_assoc($menu_items)){
    ?>
        <div class="box">
            <div class="img">
                <img src="./assets/images/<?php echo $items['image']; ?>" alt="">
            </div>
            <div class = "box-info">
                <div class="name"><?php echo $items['name'] ; ?></div>
                <div class="price"><?php echo $items['price'] ; ?> Rs.</div>
                <div class="buy" >
                    <a href="view_data.php?id=<?php echo $items['id']; ?>">Buy Now</a>
                </div>
            </div>
        </div>

    <?php 
        }
    }else{
    ?>
        <div>No results found</div>
    <?php
    }

    ?>

</div>
