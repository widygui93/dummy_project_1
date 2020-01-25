<?php 
session_start();
require 'functions.php';


if( isset($_SESSION["login"]) ){
    // arahkan balik ke index.php
    header('Location: ../index.php');
    exit;

}

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

    // cek username ada di db atau tidak
    if( mysqli_num_rows( $result ) === 1 ){

        // cek password sama atau tidak
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ){

            // buat session
            $_SESSION["login"] = true;
            $_SESSION["user"] = $row["username"];

            header('Location: ../index.php');
            exit;
        }

    }

    $error = true;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>

    <!-- CDN bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <style>
    body {
        background-color: #ccc8b6;
    }

    h1 {
        text-align: center;
        color: white;
        font-family: "Times New Roman", Times, serif;
    }

    form {
        margin-top: 14px;
        margin-bottom: 14px;
        margin-right: 14px;
        margin-left: 14px;
    }

    .wrapper {
        border: 10px outset lightblue;
        width: 55%;
        background-color: white;
        margin-top: 25px;
        margin: auto;
    }

    a {
        font-style: italic;
        font-size: 0.875em;
    }

    
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Halaman Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="wrapper">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <a href="register.php" role="button">Dont have an account? Register here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <?php if(isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            Username/password is incorrect
        </div>
    <?php endif; ?>

</body>
</html>