<?php 
require '../php/functions.php';

$new_actv = $_POST["actv"];
$id_actv  = $_POST["idEditActv"];
$user = $_POST["user"];

edit($new_actv, $id_actv);

$activity = query("SELECT * FROM activity WHERE user_name = '$user' ORDER BY id DESC");


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
