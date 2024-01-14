<?php 



    include("header.php");

    include("config.php");


    $orders_query = "SELECT * FROM orders";
    $run_orders_query = mysqli_query($conn, $orders_query) or die("Query Failed");


    // function select_menu_items($conn, $filter_category = null, $filter_value = null){
    //     $menu_items_query = "SELECT * FROM menu";

    //     if(is_array($filter_value)){
            
    //         $filter_value = implode("', '", $filter_value);
    //         // return print_r($filter_value);
    //         $menu_items_query .= " WHERE {$filter_category} IN ('{$filter_value}')";
    //     }
    //     return mysqli_query($conn, $menu_items_query);
    // }

    // $menu_items = select_menu_items($conn);


    // $category_query = "SELECT DISTINCT category FROM menu";
    // $category_query_data = mysqli_query($conn, $category_query);

?>

    <section id = "add-menu">
        <div class="menu">


            <!-- ========== filter section =========== -->
            <div class = "title">
                <div>
                    <a href=""> 
                        <i class="uil uil-list-ul"></i>
                        <span>
                            Orders List
                        </span>
                    </a>
                </div>

                <div>

                </div>
                <div id = "filter-lists">
                    <!-- 
                    <div class="applied-filter">
                        <span>
                            Category
                        </span>
                        <i id ="cancel-filter" class = "uil uil-times"></i>
                    </div> 
                -->
                </div>

                
                <div id = "filter-category" class = "filters">
                        <i class="uil uil-filter"></i>
                        <span>
                            Filters
                        </span>

                        <div class="filter-box">
                            <div class="options">
                                <?php 
                                    while($categories = mysqli_fetch_assoc($category_query_data)){
                                ?>
                                    <div data-categoryitem="<?php echo $categories['category']; ?>" class = "item"><?php echo $categories['category']; ?></div>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                </div>

            </div>
            <!-- ============== filter section end ============= -->


            <!-- ============= table view ============ -->
            <div class = "menu-table">
                <table cellspacing = "0">
                    <thead>
                        <tr>
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            if(mysqli_num_rows($run_orders_query) > 0){
                                while($data = mysqli_fetch_assoc($run_orders_query)){
                                    
                                    // getting users data 
                                    $user_query = "SELECT * FROM users_data WHERE id = {$data['userId']}";
                                    $run_user_query = mysqli_query($conn, $user_query) or die("Users data could not be fetched");
                                    $fetch_users_data = mysqli_fetch_assoc($run_user_query);
                                    
                                    // getting food data 
                                    $food_query = "SELECT * FROM menu WHERE id = {$data['foodId']}";
                                    $run_food_query = mysqli_query($conn, $food_query) or die("Food data could not be fetched");
                                    $fetch_food_data = mysqli_fetch_assoc($run_food_query);


                        ?>

                        <tr>
                            <td>
                                <img src="./assets/images/<?php echo $fetch_food_data['image']; ?>" alt="">
                            </td>
                            <td>
                                <?php echo $fetch_food_data['name']; ?>
                            </td>
                            <td>
                                <?php echo $fetch_users_data['firstName'] . " " . $fetch_users_data['lastName']; ?>
                            </td>
                            <td>
                                <?php echo $fetch_users_data['address']; ?>
                            </td>
                            <td>
                                <?php echo ($fetch_food_data['price'] * $data['quantity']) ?>
                            </td>
                            <td>
                                <?php echo $data['quantity']; ?>
                            </td>
                            <td>
                                <?php echo $data['status']; ?>
                            </td>
                            <td>
                                <a href="add_item.php?id=<?php echo $data['id']; ?>" id = "editItem">
                                    <i class="uil uil-edit"></i>
                                </a>
                                <button id = "deleteItem" data-deleteitem="<?php echo $data['id']; ?>">
                                    <i class="uil uil-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- ============== table view end =============== -->
        </div>
    </section>



    <script>
        $(document).ready(function(){
            
            
            
            
            // for deleting item from database
            $(document).on("click","#deleteItem", function(){
                var id = $(this).data("deleteitem");

                if(confirm("Are you sure? You want to delete item")){
                    $.ajax({
                        url : "deletemenuitem.php",
                        method : "POST",
                        data : { menuItem : id },
                        success : function(data){
                            if(data == 1){
                                alert("Item deleted from database");
                                location.reload();
                            }else{
                                alert("Item could not deleted.");
                            }

                        }
                    });
                }

            });


            // hiding filter box
            $(".filter-box").hide();

            // showing filter box
            $(document).on("click", "#filter-category", function(){
                $(".filter-box").toggle();
            });


            // function for getting result of filtered data
            function get_filtered_data(){
                $("#filter-lists").empty();
                var valueObj = {};  
                $(".filter-box .options .item.active").each(function (index, element) {
                    var value = $(element).text();
                    valueObj[value] = value; // Assuming you want to store the text content
                    
                    $("#filter-lists").append(`
                                            <div class="applied-filter">
                                                <span>
                                                    `+ value +`
                                                </span>
                                                <i id ="cancel-filter" class = "uil uil-times"></i>
                                            </div> 
                                            `);
                });

                $.ajax({
                    url : "filterdata.php",
                    method : "POST",
                    data : { data : JSON.stringify(valueObj)},
                    success : function(data){
                        if(data){
                            $(".menu-table").html(data);
                            
                        }else{
                            alert("error");
                        }
                    }
                });
            }

            
            $(document).on("click", ".filter-box .options .item", function(){
                $(this).toggleClass("active");
                var id = $(this).data("categoryitem");
                
                get_filtered_data();
                

            });


            $(document).on("click","#cancel-filter", function(){
                var filterValue = $(this).siblings(".applied-filter span").text();
                $(this).parent().remove();
                
                // $(".filter-box .options .item").removeClass("active");
                $(".filter-box .options .item.active").each(function (index, element) {
                    if(filterValue.trim() == $(element).text()){
                        var value = $(element).removeClass("active");
                    }
                });
                get_filtered_data();

            });
        });
    </script>
</body>
</html>