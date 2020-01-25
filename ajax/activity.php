<?php 

session_start();

if ( !isset($_SESSION["login"]) ) {
    // arahkan user balik ke login
    header('Location: ../php/login.php');
    exit;
}

require '../php/functions.php';

$nama_actv = $_POST["actv"];
$nama_user = $_POST["usr"];


tambah($nama_actv, $nama_user);

$activity = query("SELECT * FROM activity WHERE user_name = '$nama_user' ORDER BY id DESC");


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
                <a href="#" class="badge badge-primary <?= checkDisableLink($act["id"], $act["user_name"]); ?> ">Edit</a>
                <a href="php/hapus.php?id=<?= $act["id"]; ?>" class="badge badge-danger" onclick="return confirm('Do you want to delete this?');">Delete</a>
                <a href="php/doneActv.php?id=<?= $act["id"]; ?>" class="badge badge-success <?= checkDisableLink($act["id"], $act["user_name"]); ?> ">Done</a>
            </td>
        </tr>
        <?php $no++; ?>
    <?php endforeach; ?>
</table>




