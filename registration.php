<?php 
    include("config.php");
    if(isset($_POST['submit'])){
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $register_query = "INSERT INTO users_data(firstName, lastName, email, username, password) VALUES('{$firstName}','{$lastName}','{$email}','{$username}', '{$password}')";

        if(mysqli_query($conn, $register_query)){
            session_start();
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        }else{
            echo "Please fill inputs correctly";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- jquery cdn link -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            
            background: linear-gradient(to left, rgb(147, 224, 239), rgb(6, 51, 107));
            /* background: linear-gradient(to right, #efa2269f, #c122dda4); */
        }

        #registration-section{
            width: 90vw;
            height: 90vh;
            margin: 5vh 5vw;
            background-color: aliceblue;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
        }

        #registration-decor{
            width: 40%;
            height: 100%;
            background-color: rgb(147, 224, 239);
            border-radius: 10px 0 0 10px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            /* align-items: center; */
        }
        
        #registration-detail{
            width: 60%;
            height: 100%;
            background-color: rgb(255, 255, 255);
            border-radius: 0 10px 10px 0;
            padding: 50px 200px;
        }
       
        #registration-detail div{
            width: 100%;
        }

        #registration-detail .sign-in{
            text-align: end;
        }
        
        #registration-detail .title{
            padding-top: 20px;
            font-size: 25px;
            font-weight: 600;
        }
       
        #registration-detail .sign-in-options{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
        }
        
        #registration-detail .sign-in-options .google{
            width: 60%;
            background-color: blue;
            height: 30px;
            color: white;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-radius: 3px;
        }
        
        #registration-detail .sign-in-options .tw, #registration-detail .sign-in-options .fb{
            width: 15%;
            height: 30px;
            background-color: white;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 3px;
            /* margin: 0 10px; */
        }
        
        #registration-detail .decor{
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            height: 0;
            margin: 20px 0;
        }
        
        #registration-detail .decor hr{
            width: 180px;
        }

        
        #registration-detail form div{
            display: flex;
            flex-direction: row;
            margin: 5px 0;
        }
        
        #registration-detail form label{
            font-weight: 600;
        }
        
        #registration-detail form .term-n-service{
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: start;
            text-align: justify;
            padding-right: 10px;
        }
        
        #registration-detail form .form-details{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        

        #registration-detail form .form-details div{
            display: flex;
            flex-direction: column;
            width: 48%;
        }
        
        #registration-detail form :is(.email-field, .pass-field){
            display: flex;
            flex-direction: column;
        }
        
        #registration-detail form :is(input[type='text'], input[type='password']){
            height: 40px;
            background-color: #f0f0f0;
            padding: 5px 10px;
            /* margin: 0 10px 0 0; */
            border: 0px ;
            border-radius: 5px;
        }

        #registration-detail form .submit-btn input[type='submit']{
            height: 40px;
            width: 250px;
            background-color: #dc23bd;
            border: 0px;
            border-radius: 5px;
        }



    </style>
</head>
<body>
    <section id = "registration-section">
        <div id = "registration-decor">
            <img src="./assets/images/registration.png" alt="">
        </div>
        <div id = "registration-detail">
            <div class = "sign-in">
                Already a Member? <a href="./login.php">Sign in</a>
            </div>
            <div class = "title">Sing up to HMS</div>
            <div class = "sign-in-options">
                <div class = "google">
                    <span>
                        <i class="uil uil-google"></i>
                    </span>
                    <span>
                        Sign up with Google
                    </span>
                    <span></span>
                </div>
                <div class = "fb"><i class="uil uil-google"></i></div>
                <div class = "tw"><i class="uil uil-google"></i></div>
            </div>
            <div class = "decor">
                <hr>
                Or
                <hr>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id = "registration_form">

                <div class = "form-details">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id = "fname"  name = "fname">
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" id = "lname"  name = "lname">
                    </div>
                </div>
                <div class = "email-field">
                        <label for="user">Username</label>
                        <input type="text" id = "user" name = "username">
                </div>
                <div class = "email-field">
                    <label for="email">Email Address</label>
                    <input type="text" id = "email"  name = "email">
                </div>
                <div class = "pass-field">
                    <label for="pass">Password</label>
                    <input type="password" id = "pass" name = "password" placeholder="6+ Characters">
                </div>
                <div class = "term-n-service">
                    <div style = "width: fit-content; padding: 0 10px;">
                        <input type="checkbox" name="" id="terms">
                    </div>
                    <div>
                        <label for="terms">
                            Creating an account means you're okay with our Terms of Services, Privacy Policy, and our default Notification Settings.
                        </label>
                    </div>
                </div>
                <div class = "submit-btn">
                    <input type="submit" name = "submit" value="Create Account">
                </div>
            </form>
        </div>
    </section>


    <script>

        // jquery for checking both passwords fields are equal or not.
        $(document).ready(function (){
            $("#registration_form").on("submit", function(){
                var pass = $("#pass").val();
                var con_pass = $("#con-pass").val();
                if(length(pass) > 6){
                    alert("Password length should be greater than 6 chars");
                    return false;
                }
            });
        });
        // end logic
    </script>
</body>
</html>