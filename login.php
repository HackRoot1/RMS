<?php 

    include("config.php");

    if(isset($_POST['login'])){
        
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);



        $query = "SELECT * FROM `users_data` WHERE (email = '{$user}' OR username = '{$user}') AND password = '{$password}'";
        // $result = mysqli_query($conn, $query) or die("Query Failed");
        if(mysqli_query($conn, $query)){
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) === 1){
                
                session_start();
                session_unset();
                $data = mysqli_fetch_assoc($result);
                $_SESSION['user'] = $user;
                header("Location: ./index.php");
                exit();
            }else{
                
                echo "User Not Found!";
            }
        }else{
            echo "Query Failed";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
        <div>
            <label for="uname">Username</label>
            <input type="text" id = "uname" name = "user">
        </div>

        <div>
            <label for="pass">Password</label>
            <input type="text" id = "pass" name = "password">
        </div>

        <div>
            <input type="reset" value="Reset">
            <input type="submit" value="Submit" name = "login">
        </div>
    </form>
</body>
</html>