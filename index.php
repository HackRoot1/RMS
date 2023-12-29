<?php 

    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    include("header.php");


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




        <section id = "filter-sort-section">
            <div class="title">
                Filters
            </div>
            <div class="filters"></div>

            <div class="buttons">
                <div id = "sort-btn">
                    <i class="uil uil-sort"></i>
                    <span>
                        Sorts
                    </span>
                </div>
                <div id = "filter-btn">
                    <i class="uil uil-filter"></i>
                    <span>
                        Filters
                    </span>
                </div>
            </div>

        </section>
        <section id = "filter-sort-section" class = "filter-list">
                <div></div>
                <div class = "sorting-lists">
                    <?php 
                        while($category = mysqli_fetch_assoc($category_list)){
                    ?>
                        <div class = "items">
                            <?php echo $category['category']; ?>
                        </div>
                    <?php 
                        }
                    ?>
                </div>
        </section>


        <hr>

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



            $("#filter-sort-section.filter-list").hide();
            
            $("#filter-btn").on("click", function(){
                $("#filter-sort-section.filter-list").toggle();
            });

            // filter section for resulting....
            $(".category").on("click", function(){
                var categoryItem = $(this).toggleClass("active");
                // console.log(categoryValue);
            });


            
            function get_filtered_data(){
                $("#filter-sort-section .filters").empty();
                var valueObj = {};  
                $(".filter-list .sorting-lists .items.active").each(function (index, element) {
                    var value = $(element).text();
                    valueObj[value] = value; // Assuming you want to store the text content
                    
                    $("#filter-sort-section .filters").append(`
                                            <div class="applied-filter">
                                                <span>
                                                    `+ value +`
                                                </span>
                                                <i id ="cancel-filter" class = "uil uil-times"></i>
                                            </div> 
                                            `);
                });

                $.ajax({
                    url : "filterdata2.php",
                    method : "POST",
                    data : { data : JSON.stringify(valueObj)},
                    success : function(data){
                        if(data){
                            $(".boxes").html(data);
                        }else{
                            alert("error");
                        }
                    }
                });
            }

            // get_filtered_data();


            $(document).on("click", "#filter-sort-section .sorting-lists .items", function(){
                $(this).toggleClass("active");
                var id = $(this).data("categoryitem");
                
                get_filtered_data();
                
            });

            // $(document).on("click","#cancel-filter", function(){
            //     var filterValue = $(this).siblings(".applied-filter span").text();
            //     $(this).parent().remove();
                
            //     // $(".filter-box .options .item").removeClass("active");
            //     $(".filter-box .options .item.active").each(function (index, element) {
            //         if(filterValue.trim() == $(element).text()){
            //             var value = $(element).removeClass("active");
            //         }
            //     });
            //     get_filtered_data();

            // });
        });

    </script>
</body>
</html>