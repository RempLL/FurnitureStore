<?php
session_start();
require "../package/connect_to_database.php";
$login = filter_input(INPUT_POST, 'login_registration');
$phone_number = filter_input(INPUT_POST, 'phone_number');
$name = filter_input(INPUT_POST, 'name');
$surname = filter_input(INPUT_POST, 'surname');
$password_registration = filter_input(INPUT_POST, 'password_registration');


if ($_SESSION["check_login"]==0) {
    $sql = "insert into users values(NULL, '" . $name . " " . $surname . "', '" . $login . "', '" . $phone_number . "', '" . $password_registration . "','К ')";
    echo $sql;
    $conn->query($sql);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
?>
