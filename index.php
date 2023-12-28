<?php 

    // session_start();
    // if(!isset($_SESSION['user'])){
    //     header("Location: login.php");
    // }

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    include("header.php");
    
    // include("config.php");
    // $user_info_query = "SELECT * FROM users_data WHERE (email = '{$_SESSION['user']}' OR username = '{$_SESSION['user']}')";
    // $user_info = mysqli_query($conn, $user_info_query) or die("Query failed");

    // $user_info_data = mysqli_fetch_assoc($user_info);
    // echo "<pre>";
    // print_r($user_info_data);
    // echo "</pre>";


    // fetching all menu items list 
    function get_menu_data($conn, $filter = null){
        $menu_items_query = "SELECT * FROM menu";
        
        if(isset($filter)){

            $count = count($filter);
            if($count > 1 && isset($filter)){
                $filter_data = implode("', '", $filter);
            }else{
                $filter_data = implode("", $filter);
            }
            // echo $filter_data;
            // exit();
            if(isset($filter_data)){
                $menu_items_query .= " where category IN ('{$filter_data}')";
            }
        }
        

        return mysqli_query($conn, $menu_items_query);
    }

    // $arr = ['search_item' => 'meat', 'filter' => 'food'];
    
    $menu_items = get_menu_data($conn);


    // getting all categories list
    $menu_category = "SELECT DISTINCT category FROM `menu`";
    $category_list = mysqli_query($conn, $menu_category);



?>


        <!-- ========== filter section ========= -->
        <section id = "filter-section">
            <?php 
                while($category = mysqli_fetch_assoc($category_list)){
            ?>
                <div class = "category">
                    <span>
                        <i class="uil uil-pizza-slice"></i>
                    </span>
                    <span class = "category-name"><?php echo $category['category']; ?></span>
                </div>
            <?php 
                }
            ?>
        </section>




        <!-- ============ end filters ============= -->



        
        <!-- =============== popular orders ============= -->

        <section id = "popular-orders">
            <div class="title">Popular Orders</div>

            <div class="boxes">

                <?php 
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
                ?>


            </div>
        </section>
        <!-- ============== end popular orders ================ -->

    </main>







    <script>

        $(document).ready(function(){


            // filter section for resulting....
            $(".category").on("click", function(){
                var categoryItem = $(this).toggleClass("active");

                console.log(categoryValue);
            });
        });

    </script>
</body>
</html>