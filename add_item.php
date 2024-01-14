<?php 



    include("header.php");

    include("config.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "SELECT * FROM menu WHERE id = '{$id}'";
        $query_run = mysqli_query($conn, $query); 
        $data = mysqli_fetch_assoc($query_run);
    }

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
    }else if(isset($_POST['update'])){
        $name = $_POST['food_name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // for adding file in folder
        $query = "  UPDATE  
                        menu 
                    SET
                        name = '{$name}', 
                        description = '{$description}', 
                        category = '{$category}',
                        price = '{$price}' ,
                        quantity = '{$quantity}' ";


        // print_r(!isset($_FILES['food_image']['name']));
        // exit();

        if(isset($_FILES['food_image']['name']) and $_FILES['food_image']['name'] != ""){
            
            $file_path = "./assets/images/";
            $file = $_FILES['food_image']['name'];
            $temp_file = $_FILES['food_image']['tmp_name'];
            move_uploaded_file($temp_file, $file_path . $file);
            $query .= ", image = '{$file}'";
        }

        $query .= " WHERE 
                        id = {$id}
                    ";

        if(mysqli_query($conn, $query)){
            header("Location: ./addMenu.php");
            exit();
        }
    }

?>

    <section id = "add-menu">
        <div class="menu">
            <div class="edit-form">

                <form action="" method = "POST" enctype="multipart/form-data">
                    <div class = "preview">
                        <label for="preview">Preview</label>
                        <?php 
                            if(isset($data['image'])){
                        ?>
                            <img src="./assets/images/<?php echo $data['image'] ?>" alt="<?php echo $data['image'] ?>" width="100px" height="100px">
                        <?php 
                            }else{
                        ?>
                            No Preview Available
                        <?php 
                            }
                        ?>
                    </div>

                    <div class = "preview">
                        <label for="image">Image</label>
                        <?php 
                            if(isset($data['image'])){
                        ?>
                            <input type="hidden" name="imageChecker" value = "true">
                            <img src = "./assets/images/<?php echo $data['image']; ?>" width="50px" height="50px" />
                            <input type="file" id = "image" name = "food_image">
                        <?php 
                            }else{
                        ?>
                            <input type="file" id = "image" name = "food_image" >
                        <?php
                            }
                        ?>
                    </div>
                    <div>
                        <label for="">Item Name</label>
                        <input type="text" name = "food_name" value="<?php echo isset($data['name']) ? $data['name'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Description</label>
                        <input type="text" name = "description" value="<?php echo isset($data['description']) ? $data['description'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Category</label>
                        <input type="text" name = "category" value="<?php echo isset($data['category']) ? $data['category'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Price</label>
                        <input type="text" name = "price" value="<?php echo isset($data['price']) ? $data['price'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Quantity</label>
                        <input type="text" name = "quantity" value="<?php echo isset($data['quantity']) ? $data['quantity'] : "" ?>">
                    </div>
                    <div>
                        <label for="">
                            <input type="reset" value="Reset">
                        </label>
                        <input type="submit" name = "<?php echo isset($data['quantity']) ? "update"  : "submit" ?>" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </section>


</body>
</html>