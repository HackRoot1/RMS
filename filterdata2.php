<?php 


include("config.php");

    $jsonData = json_decode($_POST["data"], true);
    

    function select_menu_items($conn, $filter_category = null, $filter_value = null){
        $menu_items_query = "SELECT * FROM `menu`";
    
        if (is_array($filter_value) && count($filter_value) > 0) {
            
            if(count($filter_value) < 2){
                $filter_value = implode("", $filter_value);
                $menu_items_query = "SELECT * FROM menu WHERE category = ('{$filter_value}')";
            }else{
                $filter_value = implode(", ", $filter_value);
                $menu_items_query = "SELECT * FROM menu WHERE category IN ('" . $filter_value . "')";
            }
            
        }
        
        return mysqli_query($conn, $menu_items_query) or die(mysqli_error($conn));
    }
    
    $menu_items = select_menu_items($conn, 'category', $jsonData);


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
