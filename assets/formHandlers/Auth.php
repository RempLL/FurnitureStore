<?php
session_start();
require "../package/connect_to_database.php";
$login_login = filter_input(INPUT_POST, 'login_login');
$login_password = filter_input(INPUT_POST, 'login_password');


$sql = "select * from users where `e-mail` = '" . $login_login ."' and `password` = '".$login_password."'";
$users = $conn->query($sql);
if ($user = mysqli_fetch_array($users))
{
  $_SESSION["user_id"]=$user["user_id"];
     if ($user["type"]=="А") {
         $_SESSION["admin"]=true;
    }
}
else{
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
