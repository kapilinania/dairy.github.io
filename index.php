<?php
session_start();
include 'connection.php';
if(isset($_REQUEST['submit']))
{
    $user=$_REQUEST["userName"];
    $pass=$_REQUEST["password"];

    $sql = "select * from userLogin where mobile_num='$user' && password='$pass'"; 

   $query = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($query);
    if($rowcount == true)
    {
        $_SESSION["mobile"]=$user;
        header('location:search.php');
    }
    else{
        echo "password is wrong";
    }
}
 


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
</head>

<body>

    <div class="container">

        <div class="img">
            <img src="img/BG.png" alt="BG">
        </div>

        <div class="login-content">

            <form action="#" method="post">

                <div class="title-container">
                    <h1>Login</h1>
                    <h2>Hello, Friends!</h2>
                    <p>Enter your personal detail and start journey with us.</p>
                </div>


                <div class="login-inner-content">


                    <div class="input-div one">
                        <div class="i">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <div class="div">
                            <h5>User id</h5>
                            <input type="text" class="input" name="userName">
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-eye" onclick="show()"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input id="pswrd" type="password" class="input" name="password">
                        </div>
                    </div>

                    <a href="#">Forgot password / Username</a>

                </div>

                <input type="submit" class="btn" value="Login" name="submit">

                <h5>Not a member ? <a href="#">Create Account</a></h5>

            </form>
        </div>
    </div>





    <script src="script.js"></script>

</body>

</html>