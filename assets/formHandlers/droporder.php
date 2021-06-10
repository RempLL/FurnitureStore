<?php
session_start();
require "../package/connect_to_database.php";
$order = filter_input(INPUT_POST, 'order');

        $sql = "delete from orders where order_id =".$order;


    $conn->query($sql);

header("Location: " . $_SERVER['HTTP_REFERER']);

?>
