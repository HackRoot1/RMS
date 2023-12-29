<?php 



    include("header.php");

    include("config.php");

    if(isset($_POST['submit'])){

        
        $name = $_POST['food_name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // for adding file in folder
        $file_path = "./assets/images/";
        $file = $_FILES['food_image']['name'];
        $temp_file = $_FILES['food_image']['tmp_name'];
        move_uploaded_file($temp_file, $file_path . $file);


        $query = "  INSERT INTO 
                        menu (name, description, category, price, quantity, image) 
                    VALUES
                        ('{$name}', '{$description}', '{$category}', '{$price}', '{$quantity}', '{$file}' )";

        $query_run = mysqli_query($conn, $query) or die("Query failed");
    }

?>

    <section id = "add-menu">
        <div class="menu">
            <form action="" method = "POST" enctype="multipart/form-data">
                <div>
                    <label for="">Image</label>
                    <input type="file" name = "food_image">
                </div>
                <div>
                    <label for="">Item Name</label>
                    <input type="text" name = "food_name">
                </div>
                <div>
                    <label for="">Description</label>
                    <input type="text" name = "description">
                </div>
                <div>
                    <label for="">Category</label>
                    <input type="text" name = "category">
                </div>
                <div>
                    <label for="">Price</label>
                    <input type="text" name = "price">
                </div>
                <div>
                    <label for="">Quantity</label>
                    <input type="text" name = "quantity">
                </div>
                <div>
                    <input type="submit" name = "submit" value="Submit">
                </div>
            </form>
        </div>
    </section>


</body>
</html>