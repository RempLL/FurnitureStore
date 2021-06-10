<?php
session_start();
require "../package/connect_to_database.php";
$name = filter_input(INPUT_POST, 'name');
$type = filter_input(INPUT_POST, 'type');

switch($type){
    case "category":
        $sql = "select * from categories where category_name ='".$name."'";
        $result = $conn->query($sql);
        if($res = mysqli_fetch_array($result)){
            unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
        }
        $sql = "delete from categories where category_name ='".$name."'";
    echo $sql;
        break;
     case "subcategory":
        $sql = "select * from subcategories where subcategory_name ='".$name."'";
        $result = $conn->query($sql);
        if($res = mysqli_fetch_array($result)){
            unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
        }
        $sql = "delete from subcategories where subcategory_name ='".$name."'";
        echo $sql;
        break;
     case "item":
        $sql = "select * from items where item_id ='".$name."'";
        $result = $conn->query($sql);
        if($res = mysqli_fetch_array($result)){
            echo $res["photo_link"];
            unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
        }
        $sql = "delete from items where item_id ='".$name."'";
        echo $sql;
        break;

}
    $conn->query($sql);

header("Location: " . $_SERVER['HTTP_REFERER']);

?>
