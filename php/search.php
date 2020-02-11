<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    // arahkan user balik ke login
    header('Location: login.php');
    exit;
}


require "functions.php";



$user = $_SESSION["user"];

$waktu = tentukan_waktu();

$keyword_pencarian = null;


// $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC");


// konfigurasi pagination
// if ( !isset($_GET["halaman"]) && !isset($_POST["submit"]) ){
//     global $user;
//     $jumlahDataPerHalaman = 5;
//     $totalData = count(query("SELECT * FROM activity WHERE user_name = '$user' "));
//     $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
//     $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
//     $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//     // varible activity merupkan array dalam array
//     $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
// }

if( !isset($_POST["submit"]) ){

    if ( isset($_GET["halaman"]) && isset($_GET["q"]) ) {
        // global $mobil;
        global $user;
        $actv_by_search = $_GET["q"];
        

        // konfigurasi pagination saat klik cari
        $jumlahDataPerHalaman = 5;
        $totalData = count(query("SELECT * FROM activity WHERE activity_name LIKE '%$actv_by_search%' AND user_name = '$user'"));
        $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
        $halamanAktif =   ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

        // $mobil = query("SELECT * FROM mobil WHERE nama LIKE '%$nama_by_search%' LIMIT $awalData, $jumlahDataPerHalaman");

        $activity = query("SELECT * FROM activity WHERE activity_name LIKE '%$actv_by_search%' AND user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
        $keyword_pencarian = $actv_by_search;

    }
}

if( isset($_POST["submit"]) ){
    global $user;
    $actv_by_search = $_POST["activity_name"];

    $jumlahDataPerHalaman = 5;
    $totalData = count(query("SELECT * FROM activity WHERE activity_name LIKE '%$actv_by_search%' AND user_name = '$user' "));
    $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
    // $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $halamanAktif = 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    // varible activity merupkan array dalam array
    $activity = query("SELECT * FROM activity WHERE activity_name LIKE '%$actv_by_search%' AND user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman ");
    // $_SESSION["cari"] = $actv_by_search;
    $keyword_pencarian = $actv_by_search;
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
        /* .container, .row, .col-sm {
            border: black 2px solid;
        } */
        h1 {
            text-align: center;
        }
        table{
            width: 100%;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        /* button {
            margin-top: 5px;
        } */
        .done {
            background-color: greenyellow;
        }
        .disableLink {
            pointer-events: none;
            text-decoration: line-through;
            text-decoration-color: red;
        }
        input, button {
            margin-left: 5px;
            /* margin-right: 5px; */
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
                <p> Good <?= $waktu; ?>, <strong><?= $user; ?></strong></p> 
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <!-- <div>
                    <p>Add Activity</p>
                    <input type="text" class="form-control" id="add" placeholder="Enter activity" name="activity_name" autofocus autocomplete="off">
                    <button class="btn btn-outline-primary" id="tambah">Add</button>
                </div> -->
                <a href="../index.php">Go Back</a>
                <form action="" method="post" class="form-inline">
                    <div class="form-group">
                        <label for="search">Search Activity</label>
                        <input type="text" class="form-control" id="search" placeholder="Search activity" name="activity_name" autofocus autocomplete="off" required>
                        <button type="submit" class="btn btn-primary" name="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="container-act-list">
                    <?php if( $keyword_pencarian != null ) : ?>
                        <p>You are searching for <span class="badge badge-success"><?= $keyword_pencarian; ?></span></p>
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
                                        <a href="#" class="badge badge-primary <?= checkDisableLink($act["id"], $act["user_name"]); ?> " id="edit_at_search">Edit</a>
                                        <a href="hapus.php?id=<?= $act["id"]; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this?');">Delete</a>
                                        <a href="doneActv.php?id=<?= $act["id"]; ?>" class="badge badge-success <?= checkDisableLink($act["id"], $act["user_name"]); ?> ">Done</a>
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
                                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>&q=<?= $keyword_pencarian ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for( $i = 1; $i <= $totalHalaman; $i++ ) : ?>
                                    <?php if( $i == $halamanAktif ) : ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="?halaman=<?= $i; ?>&q=<?= $keyword_pencarian ?>"><?= $i; ?></a>
                                        </li>
                                    <?php else : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?halaman=<?= $i; ?>&q=<?= $keyword_pencarian ?>"><?= $i; ?></a>
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
                                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>&q=<?= $keyword_pencarian ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>     
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/script.js?v=1"></script>
</body>
</html>