<?php
$address = filter_input(INPUT_POST, 'editaddress');
$date = filter_input(INPUT_POST, 'dateedit');
$id = filter_input(INPUT_POST, 'orderidcur');
$items=json_decode(filter_input(INPUT_POST, 'mas'));
require "../package/connect_to_database.php";
session_start();

$sql = "UPDATE `orders` SET `delivery address` = '".$address."',`delivery_date` = '".$date."' WHERE `orders`.`order_id` = ".$id.";";
$conn->query($sql);
$sql="delete from items_in_order where order_id ='".$id."'";
$conn->query($sql);
for($i=0; $i<count($items);$i++){
    for($k=0;$k<$items[$i][2];$k++){
        echo $k."<br>";
    $sql = "insert into items_in_order values(NULL," . $id. ", ". $items[$i][1] .")";
        echo $sql;
        $conn->query($sql);

    }
}
header("Location: " . $_SERVER['HTTP_REFERER']);

?>
