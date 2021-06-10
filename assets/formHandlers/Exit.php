<?php
session_start();
require "../package/connect_to_database.php";
$_SESSION["admin"]=false;
$_SESSION["user_id"]=false;
header("Location: " . $_SERVER['HTTP_REFERER']);


?>
