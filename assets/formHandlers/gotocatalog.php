<?php
session_start();
$id = filter_input(INPUT_POST, 'id');
$_SESSION["catalogtype"]=$id;
header ('Location: /testproject/catalog.php');
?>
