<?php 

require 'functions.php';

if( isset($_POST["register"]) ) {

    if( registrasi($_POST) > 0 ){
        echo "
            <script>
                alert('user baru sukses ditambah');
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Registrasi</title>

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
    }
    .form-control, .alert {
        width: 200px;
    }

    form {
        /* margin-left: 10px; */
        border: 1px solid black;
        margin-top: 100px;
        /* margin-bottom: 100px; */
        /* margin-right: 140px; */
        /* margin-left: 140px; */
        /* background-color: lightblue; */
        width: 50%;
        /* padding-left: 10px; */
    }
    
    </style>
</head>
<body>
    
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" class="form-control" id="password2" placeholder="Enter Confirm password" name="password2" required>
        </div>
        <button type="submit" class="btn btn-primary" name="register">Daftar</button>
    </form>

    <script src="../js/jquery-3.4.1.min.js"></script>
</body>
</html>