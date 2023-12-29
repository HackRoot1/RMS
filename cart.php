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
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $cart_query = "SELECT * FROM menu WHERE id = '{$id}'";
        $cart_query_run = mysqli_query($conn, $cart_query);

        $cart_buy_data = mysqli_fetch_assoc($cart_query_run);
        
    }
        
    
    // getting cart info 
    $query = "SELECT * FROM `cart` WHERE userId = {$user_info_data['id']}";
    $fetch_users_cart_details = mysqli_query($conn, $query);

    // $data = mysqli_fetch_all($fetch_users_cart_details);
    


    
?>

        
        <section id="cart">
            <div class="cart-title">Shopping Cart</div>


            <?php 
                if(isset($_GET['id'])){
            ?>

            <div class="cart-items" id = "buying-item">
                <div class="img">
                    <img src="./assets/images/<?php echo $cart_buy_data['image']; ?>" alt="">
                </div>
                <div class="info">
                    <div class="name"><?php echo $cart_buy_data['name']; ?></div>
                    <div class="description">
                        <?php echo $cart_buy_data['description']; ?>
                    </div>
                </div>

                <div class="price">
                    <span>
                        <?php echo $cart_buy_data['price']; ?>
                    </span>
                    Rs.
                </div>

                <div class="quantity">
                    <button class="increment">+</button>
                    <div class = "itemsCount">1</div>
                    <button class = "decrement">-</button>
                </div>

                <div class="action">
                    <button id = "disableItem">X</button>
                </div>

            </div>
            
            <?php 
                }
            ?>



            <?php 
                if(mysqli_num_rows($fetch_users_cart_details) > 0){
                    while($data = mysqli_fetch_assoc($fetch_users_cart_details)){

                        $query = "SELECT * FROM menu WHERE id = '{$data['foodId']}'";
                        $run = mysqli_query($conn, $query);

                        while($cart_buy_data = mysqli_fetch_assoc($run)){

            ?>

            <div class="cart-items">
                <div class="img">
                    <img src="./assets/images/<?php echo $cart_buy_data['image']; ?>" alt="">
                </div>
                <div class="info">
                    <div class="name"><?php echo $cart_buy_data['name']; ?></div>
                    <div class="description">
                        <?php echo $cart_buy_data['description']; ?>
                    </div>
                </div>

                <div class="price">
                    <span>
                        <?php echo $cart_buy_data['price']; ?>
                    </span>
                    Rs.
                </div>

                <div class="quantity">
                    <button class="increment">+</button>
                    <div class = "itemsCount">1</div>
                    <button class = "decrement">-</button>
                </div>

                <div class="action">
                    <button class = "delete" data-deleteid="<?php echo $cart_buy_data['id']; ?>">X</button>
                </div>

            </div>

            
            <?php 
                        }
                    }
                }else if(!isset($_GET['id'])){
                    echo "<div class='cart-items'>
                            Your Cart Is Empty...
                            </div>";

                }
            ?>

            <hr style = "border: 2px solid black;">
            <div class="total">
                <div class="title">
                    SUBTOTAL
                </div>
                <div class="total-value title">
                    <span id = "total-value">
                        199 Rs.
                    </span>
                    Rs.
                </div>
            </div>

            <div class="total">
                <div></div>
                <div>
                    <button id = "checkout">
                        CHECKOUT ->
                    </button>
                </div>
            </div>

        </section>



        <section id="model">
                <div id="box">
                    <div class="cancel">X</div>

                    <div class = "checkout-order">
                        <a href="">
                            Order
                        </a>
                    </div>
                </div>
        </section>

    </main>

    <script>

        $(document).ready(function(){   
            
            // calculate total price
            function calculateTotal() {
                var sum = 0;
                $("#cart .cart-items .price").each(function (index, element) {
                    var price = parseInt($(element).text());
                    var quantity = parseInt($(element).closest(".cart-items").find(".quantity .itemsCount").text());
                    console.log(quantity);
                    sum += price * quantity;
                });
                $("#total-value").text(sum);
            }

            calculateTotal();


            // delete item from cart or disable selected item from cart.
            $(document).on("click", ".delete", function(){
                var id = $(this).data("deleteid");
                alert(id);
                $.ajax({
                    url : "deletecartitem.php",
                    method : "POST",
                    data : {itemId : id},
                    success : function(data){
                        if(data == 1){
                            alert("Removed Item from cart");
                            location.reload();
                        }else{
                            alert("Item not removed from cart");
                        }
                    }
                });
            });


            // if we click on item that is going to buy that will disable
            $("#disableItem").on("click", function(){
                $("#buying-item").remove();
                calculateTotal();
            });


            // incrementing and decrementing items
            $(document).on("click", ".increment", function(){
                var itemCount = parseInt($(this).siblings(".itemsCount").text());
                itemCount += 1;
                $(this).siblings(".itemsCount").text(itemCount);
                calculateTotal();
            })
   
   
            // incrementing and decrementing items
            $(document).on("click", ".decrement", function(){
                var itemCount = parseInt($(this).siblings(".itemsCount").text());
                if(itemCount > 1){
                    itemCount -= 1;
                }
                $(this).siblings(".itemsCount").text(itemCount);
                calculateTotal();

            });
            $("#model").hide();
            
            $(document).on("click", "#checkout", function(){
                $("#model").show();
                
            })
            
            $(document).on("click", "#box .cancel", function(){
                $("#model").hide();
            });
        });

    </script>
</body>
</html>