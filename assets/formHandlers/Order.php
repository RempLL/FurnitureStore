 <?php
$address = filter_input(INPUT_POST, 'addressdel');
$date = filter_input(INPUT_POST, 'daterange');
$items=json_decode(filter_input(INPUT_POST, 'itemmas'));
require "../package/connect_to_database.php";
session_start();
console_log($items) ;

$sql = "insert into orders values(NULL,'" . $_SESSION["user_id"]. "',CURRENT_TIMESTAMP, '', '". $address ."', '". $date ."')";
$conn->query($sql);
$sql = "SELECT * FROM `orders` ORDER BY order_id DESC";
$result = mysqli_query($conn,$sql);
if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $sql;
    die($message);
}
$row = mysqli_fetch_assoc($result);
for($i=0; $i<count($items);$i++){
    $sql = "insert into items_in_order values(NULL,'" . $row["order_id"]. "', '". $items[$i] ."')";
$conn->query($sql);
    $_SESSION["clear_storage"]=true;
}

header("Location: " . $_SERVER['HTTP_REFERER']);
 ?>
