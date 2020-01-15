<?php

require "functions.php";

$id = $_GET["id"];

markActv($id);

header('Location: ../index.php');

exit;




?>