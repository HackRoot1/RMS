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


    include("config.php");
    $id = $_GET['id'];
    // echo $id;

    $query = "SELECT * FROM menu WHERE id = '{$id}'";
    $data = mysqli_query($conn, $query);

    $info = mysqli_fetch_assoc($data);


    include("config.php");
    $user_info_query = "SELECT * FROM users_data WHERE (email = '{$_SESSION['user']}' OR username = '{$_SESSION['user']}')";
    $user_info = mysqli_query($conn, $user_info_query) or die("Query failed");

    $user_info_data = mysqli_fetch_assoc($user_info);


?>


        <section id="food">
            <section id = "food-info">
                <div class="img">
                    <img src="assets/images/<?php echo $info['image']; ?>" alt="Food Image">
                </div>

                <div class = "food-details">
                    <div class="title">
                        <?php echo $info['name']; ?>
                    </div>
                    <div class="info">
                        <?php echo $info['description']; ?>
                    </div>
                    <div class="price-details">
                        <div>
                            <div class="price">
                                <?php echo $info['price']; ?> Rs.
                            </div>
                            <div class="discount">
                                20% Discount
                            </div>
                        </div>
                        <div>
                            <div class="buy">
                                <button id="add-to-cart" data-addcartid="<?php echo $info['id']; ?>">Add to Cart</button>
                                <a href="cart.php?id=<?php echo $info['id']; ?>">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
            
            <section id = "similar-items">
                <div class="title">Similar Items</div>
                
                <?php 
                    $similar_items_query = "SELECT * FROM menu WHERE category = '{$info['category']}'";
                    $similar_items_run = mysqli_query($conn, $similar_items_query);

                    while($data = mysqli_fetch_assoc($similar_items_run)){
                ?>

                
                <div class = "results">
                    <div>
                        <img src="./assets/images/<?php echo $data['image']; ?>" alt="" />
                    </div>

                    <div class = "info">
                        <div class="name"><?php echo $data['name']; ?></div>
                        <div class="data">
                            <?php echo $data['description']; ?>
                        <!-- Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, quae. -->
                        </div>
                        <div class="price">
                            <div>
                                <?php echo $data['price']; ?> Rs.
                            </div>

                            <div class = "view-btn">
                                <a href="view_data.php?id=<?php echo $data['id']; ?>">
                                    View
                                </a>
                            </div>
                        <!-- 199 Rs. -->
                        </div>
                    </div>
                </div>

                <?php 
                    }
                ?>


            </section>
        </section>


    </main>


    <script>
        $(document).ready(function(){
            $("#add-to-cart").on("click", function(){
                var foodId = $(this).data("addcartid");
                var userId = <?php echo $user_info_data['id']; ?>;
                // alert(userId);

                $.ajax({
                    url : "addtocart.php",
                    method : "POST",
                    data : { foodId : foodId, userId : userId},
                    success : function(data){
                        if(data == 1){
                            alert("Item added to cart");
                        }else{
                            alert("Data not added. Please try again...");
                        }
                    }
                });
            }); 
        });
    </script>
</body>
</html>

