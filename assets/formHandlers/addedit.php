<?php
session_start();
require "../package/connect_to_database.php";
$type = filter_input(INPUT_POST, 'addeditype');
$item = filter_input(INPUT_POST, 'item');
echo $type;
switch($type){
    case "category":

        $name = filter_input(INPUT_POST, 'categoryname');
        $description = filter_input(INPUT_POST, 'categorydescription');
        $photo_name = mt_rand(0, 10000) . $name;
        $path = "images/categories/". $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6));

        //Добавление
        if ($item == "null"){
            $sql = "INSERT INTO `categories`VALUES ('".$name."', '".$description."', '".$path."')";
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/categories/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        //Редактирование
        else{
            //Без изменения файла
        if ($_FILES['file']['tmp_name']== ""){
            $sql = "UPDATE `categories` SET `category_name` = '".$name."', `description` = '".$description."' WHERE `categories`.`category_name` = '".$item."'";
        }
            //С изменением
        else{
            $sql = "select * from categories where category_name ='".$item."'";
            $result = $conn->query($sql);
            if($res = mysqli_fetch_array($result)){
                unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
            }
            $sql ="UPDATE `categories` SET `category_name` = '".$name."', `description` = '".$description."', `photo_link` = '".$path."' WHERE `categories`.`category_name` = '".$item."'";
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/categories/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        }
        $conn->query($sql);

        break;
    case "subcategory":
        $name = filter_input(INPUT_POST, 'subcategoryname');
        $category = filter_input(INPUT_POST, 'subcategorycatselect');
        $description = filter_input(INPUT_POST, 'subcategorydescription');
        $photo_name = mt_rand(0, 10000) . $name;
        $path = "images/subcategories/". $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6));

        //Добавление
        if ($item == "null"){
            $sql = "INSERT INTO `subcategories`VALUES ('".$name."','".$category."','".$description."', '".$path."')";
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/subcategories/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        //Редактирование
        else{
            //Без изменения файла
        if ($_FILES['file']['tmp_name']== ""){
            $sql = "UPDATE `subcategories` SET `subcategory_name` = '".$name."',`category_name` = '".$category."', `description` = '".$description."' WHERE `subcategories`.`subcategory_name` = '".$item."'";
        }
            //С изменением
        else{
            $sql = "select * from subcategories where subcategory_name ='".$item."'";
            $result = $conn->query($sql);
            if($res = mysqli_fetch_array($result)){
                unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
            }
            $sql ="UPDATE `subcategories` SET `subcategory_name` = '".$name."',`category_name` = '".$category."', `description` = '".$description."', `photo_link` = '".$path."' WHERE `subcategories`.`subcategory_name` = '".$item."'";
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/subcategories/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        }
        $conn->query($sql);
        echo $sql;

        break;
    case "item":
        $name = filter_input(INPUT_POST, 'itemnameadd');
        $subcategory = filter_input(INPUT_POST, 'itemsubselect');
        $description = filter_input(INPUT_POST, 'itemdescription');
        $length = filter_input(INPUT_POST, 'itemlength');
        $width = filter_input(INPUT_POST, 'itemwidth');
        $height = filter_input(INPUT_POST, 'itemheight');
        $colour = filter_input(INPUT_POST, 'itemseleсtcolour');
        $mat = filter_input(INPUT_POST, 'itemseleсtmat');
        $maker = filter_input(INPUT_POST, 'itemseleсtmaker');
        $quantity = filter_input(INPUT_POST, 'itemquantity');
        $cost = filter_input(INPUT_POST, 'additemcost');
        $photo_name = mt_rand(0, 10000) . $name;
        $path = "images/items/". $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6));

        //Добавление
        if ($item == "null"){
            $sql ="INSERT INTO `items` (`item_id`, `subcategory_name`, `item_name`, `description`, `cost`, `quantity`, `photo_link`, `colour`, `material`, `maker`, `length`, `width`, `height`) VALUES (NULL, '".$subcategory."', '".$name."', '".$description."', '".$cost."', '".$quantity."', '".$path."', '".$colour."', '".$mat."', '".$maker."', '".$length."', '".$width."', '".$height."')";
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/items/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        //Редактирование
        else{
            //Без изменения файла
        if ($_FILES['file']['tmp_name']== ""){
            $sql ="UPDATE `items` SET `subcategory_name` = '".$subcategory."', `item_name` = '".$name."', `description` = '".$description."', `cost` = '".$cost."', `quantity` = '".$quantity."', `colour` = '".$colour."', `material` = '".$mat."', `maker` = '".$maker."', `length` = '".$length."', `width` = '".$width."', `height` = '".$height."' WHERE `items`.`item_id` = ".$item;
        }
            //С изменением
        else{
            $sql = "select * from items where item_id ='".$item."'";
            $result = $conn->query($sql);
            if($res = mysqli_fetch_array($result)){
                unlink ($_SERVER['DOCUMENT_ROOT'].'/testproject/'.$res["photo_link"]);
            }
            $sql ="UPDATE `items` SET `subcategory_name` = '".$subcategory."', `item_name` = '".$name."', `description` = '".$description."', `cost` = '".$cost."', `quantity` = '".$quantity."',`photo_link` = '".$path."', `colour` = '".$colour."', `material` = '".$mat."', `maker` = '".$maker."', `length` = '".$length."', `width` = '".$width."', `height` = '".$height."' WHERE `items`.`item_id` = ".$item;
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/testproject/images/items/'. $photo_name.'.'.(mb_substr( $_FILES['file']['type'],6)));
        }
        }
        $conn->query($sql);
        echo $sql;

        break;

}
header("Location: " . $_SERVER['HTTP_REFERER']);

?>
