<?php
require "php/functions.php";

$user = "user123";

$waktu = tentukan_waktu();

$activity = query("SELECT * FROM activity ORDER BY id DESC");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- CDN bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body{
            background-color: #ccc8b6;
        }
        /* .container, .row, .col-sm {
            border: black 2px solid;
        } */
        h1 {
            text-align: center;
        }
        table{
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            margin-top: 5px;
        }
        .done {
            background-color: greenyellow;
        }
        .disableLink {
            pointer-events: none;
            text-decoration: line-through;
            text-decoration-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Daily Reminder</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <a href="" class="badge badge-warning">Logout</a>
                <p> Good <?= $waktu; ?>, <strong><?= $user; ?></strong></p> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div>
                    <p>Add Activity</p>
                    <input type="text" class="form-control" id="add" placeholder="Enter activity" name="activity_name" autofocus autocomplete="off">
                    <button class="btn btn-outline-primary" id="tambah">Add</button>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="search">Search Activity </label>
                        <input type="text" class="form-control" id="search" placeholder="Search activity" name="activity_name" autofocus autocomplete="off" required>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="container-act-list">
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>No</th>
                            <th>Activity</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1; ?>
                        <?php foreach( $activity as $act ) : ?>
                            <tr>
                                <td <?= checkActv($act["id"]); ?> ><?= $no; ?></td>
                                <td <?= checkActv($act["id"]); ?> ><?= $act["activity_name"]; ?></td>
                                <td>
                                    <a href="#" class="badge badge-primary <?= checkDisableLink($act["id"]); ?> ">Edit</a>
                                    <a href="php/hapus.php?id=<?= $act["id"]; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this?');">Delete</a>
                                    <a href="php/doneActv.php?id=<?= $act["id"]; ?>" class="badge badge-success <?= checkDisableLink($act["id"]); ?> ">Done</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js?v=1"></script>
</body>
</html>