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
        color: white;
        /* text-shadow: 3px 2px blue; */
        font-family: "Times New Roman", Times, serif;
        /* width: 50%; */
        /* border: 1px solid black; */
        /* border-left-style: 5px solid blue; */
    }
    .form-control, .alert {
        /* width: 200px; */
    }

    form {
        /* background-color: #ccc8b6; */
        /* margin-left: 10px; */
        /* border: 1px solid black; */
        margin-top: 14px;
        margin-bottom: 14px;
        margin-right: 14px;
        margin-left: 14px;
        /* background-color: lightblue; */
        /* width: 25%; */
        /* padding-left: 10px; */
    }

    .wrapper {
        border: 10px outset lightblue;
        /* border-radius: 5px; */
        width: 55%;
        background-color: white;
        /* padding: 25px; */

        margin-top: 25px;
        /* margin-left: 25px; */
        /* margin-right: 25px; */
        /* margin: 25px; */
        margin: auto;
    }

    label {
        font-weight: bold;
        text-decoration: underline;
    }

    
    </style>
</head>
<body>

    <di class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Halaman Registrasi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="wrapper">
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
                </div>
            </div>
        </div>
    </div>
    
    

    

    <script src="../js/jquery-3.4.1.min.js"></script>
</body>
</html>