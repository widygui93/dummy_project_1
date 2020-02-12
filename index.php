<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    // arahkan user balik ke login
    header('Location: php/login.php');
    exit;
}


require "php/functions.php";



$user = $_SESSION["user"];

$waktu = tentukan_waktu();

// konfigurasi pagination
if ( !isset($_GET["halaman"]) ){
    global $user;
    $jumlahDataPerHalaman = 5;
    $totalData = count(query("SELECT * FROM activity WHERE user_name = '$user' "));
    $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
}


if ( isset($_GET["halaman"]) ) {

    // konfigurasi pagination saat klik cari
    $jumlahDataPerHalaman = 5;
    $totalData = count(query("SELECT * FROM activity WHERE user_name = '$user'"));
    $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
    $halamanAktif =   ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
    
}


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
                <a href="php/logout.php" class="badge badge-warning">Logout</a>
                <p> Good <?= $waktu; ?>, <strong><?= $user; ?></strong></p> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div>
                    <label>Add Activity</label>
                    <input type="text" class="form-control" id="add" placeholder="Enter activity" name="activity_name" autofocus autocomplete="off">
                    <button class="btn btn-outline-primary" id="tambah">Add</button>
                </div>
                <a href="php/search.php">search activity</a>
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
                                <td <?= checkActv($act["id"], $act["user_name"]); ?> ><?= $no; ?></td>
                                <td <?= checkActv($act["id"], $act["user_name"]); ?> ><?= $act["activity_name"]; ?></td>
                                <td>
                                    <a href="#" class="badge badge-primary <?= checkDisableLink($act["id"], $act["user_name"]); ?> " id="edit_at_index">Edit</a>
                                    <a href="php/hapus.php?id=<?= $act["id"]; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this?');">Delete</a>
                                    <a href="php/doneActv.php?id=<?= $act["id"]; ?>" class="badge badge-success <?= checkDisableLink($act["id"], $act["user_name"]); ?> ">Done</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if( $halamanAktif == 1 ) : ?>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for( $i = 1; $i <= $totalHalaman; $i++ ) : ?>
                                <?php if( $i == $halamanAktif ) : ?>
                                    <li class="page-item active">
                                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php else : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if( $halamanAktif == $totalHalaman ) :  ?>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>     
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js?v=1"></script>
</body>
</html>