<?php 


    include("header.php");

    include("config.php");

    $data = $user_info_data;

    if(isset($_POST['submit'])){

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $address = $_POST['address'];


        // for adding file in folder
        $query = "  UPDATE  
                        users_data 
                    SET
                        firstName = '{$firstName}', 
                        lastName = '{$lastName}', 
                        email = '{$email}',
                        contact_no = '{$contact_no}' ,
                        address = '{$address}' ";

        if(isset($_FILES['profile_pic']['name']) and $_FILES['profile_pic']['name'] != ""){
                    
            $file_path = "./assets/images/";
            $file = $_FILES['profile_pic']['name'];
            $temp_file = $_FILES['profile_pic']['tmp_name'];
            move_uploaded_file($temp_file, $file_path . $file);
            $query .= ", profile_pic = '{$file}'";
        }

        $query .= " WHERE 
                        id = {$data['id']}
                    ";

        if(mysqli_query($conn, $query)){
            header("Location: ./settings.php");
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
                            if(isset($data['profile_pic'])){
                        ?>
                            <img src="./assets/images/<?php echo $data['profile_pic'] ?>" alt="<?php echo $data['profile_pic'] ?>" width="100px" height="100px">
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
                            if(isset($data['profile_pic'])){
                        ?>
                            <input type="hidden" name="imageChecker" value = "true">
                            <img src = "./assets/images/<?php echo $data['profile_pic']; ?>" width="50px" height="50px" />
                            <input type="file" id = "image" name = "profile_pic">
                        <?php 
                            }else{
                        ?>
                            <input type="file" id = "image" name = "profile_pic" >
                        <?php
                            }
                        ?>
                    </div>

                    <div>
                        <label for="">First Name</label>
                        <input type="text" name = "firstName" value="<?php echo isset($data['firstName']) ? $data['firstName'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Last Name</label>
                        <input type="text" name = "lastName" value="<?php echo isset($data['lastName']) ? $data['lastName'] : "" ?>">
                    </div>
                    <div>
                        <label for="">E-mail</label>
                        <input type="text" name = "email" value="<?php echo isset($data['email']) ? $data['email'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Contact No.:</label>
                        <input type="text" name = "contact_no" value="<?php echo isset($data['contact_no']) ? $data['contact_no'] : "" ?>">
                    </div>
                    <div>
                        <label for="">Address</label>
                        <input type="text" name = "address" value="<?php echo isset($data['address']) ? $data['address'] : "" ?>">
                    </div>
                    <div>
                        <label for="">
                            <input type="reset" value="Reset">
                        </label>
                        <input type="submit" name = "submit" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </section>


</body>
</html>