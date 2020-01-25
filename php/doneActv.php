<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    // arahkan user balik ke login
    header('Location: login.php');
    exit;
}

require "functions.php";

$id = $_GET["id"];

markActv($id);

header('Location: ../index.php');

exit;




?>