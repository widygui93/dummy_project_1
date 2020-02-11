<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    // arahkan user balik ke login
    header('Location: ../php/login.php');
    exit;
}

require '../php/functions.php';

$new_actv = $_POST["actv"];
$id_actv  = $_POST["idEditActv"];
$user = $_POST["user"];

edit($new_actv, $id_actv);

// konfigurasi pagination
if ( !isset($_GET["halaman"]) ){
    global $user;
    $jumlahDataPerHalaman = 5;
    $totalData = count(query("SELECT * FROM activity WHERE user_name = '$user' "));
    $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    // varible activity merupkan array dalam array
    $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
}


if ( isset($_GET["halaman"]) ) {
    global $user;

    

    // konfigurasi pagination saat klik cari
    $jumlahDataPerHalaman = 5;
    $totalData = count(query("SELECT * FROM activity WHERE user_name = '$user'"));
    $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);
    $halamanAktif =   ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    // $mobil = query("SELECT * FROM mobil WHERE nama LIKE '%$nama_by_search%' LIMIT $awalData, $jumlahDataPerHalaman");

    $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
    
}

// $activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC");


?>

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
