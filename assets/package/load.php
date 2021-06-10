<script type="text/javascript">
    var categoriesarr = [];
    var subcategoriesarr = [];
    var itemsarr = [];
    var ordersarr = [];
    var itemsinordersarr = [];
    var usersarr = [];
    <?php
    $sql = "select * FROM categories";
    $results= $conn->query($sql);
    while ($result = mysqli_fetch_array($results)) {?>
    categoriesarr.push(<?php echo  json_encode($result, JSON_HEX_TAG) ?>);
    <?php

    }

    $sql = "select * FROM subcategories";
    $results= $conn->query($sql);
    while ($result = mysqli_fetch_array($results)) {?>
    subcategoriesarr.push(<?php echo  json_encode($result, JSON_HEX_TAG) ?>);
    <?php
    }

    $sql = "select * FROM items";
    $results= $conn->query($sql);
    while ($result = mysqli_fetch_array($results)) {?>
    itemsarr.push(<?php echo  json_encode($result, JSON_HEX_TAG) ?>);

    <?php
    }
    if($_SESSION["user_id"]){
        if($_SESSION["admin"]){
                $sql = "select * FROM orders";

        }
        else{
                $sql = "select * FROM orders where user_id = ".$_SESSION["user_id"];
        }
    $results= $conn->query($sql);
    while ($result = mysqli_fetch_array($results)) {?>
    ordersarr.push(<?php echo  json_encode($result, JSON_HEX_TAG) ?>);

    <?php
        }
    $results= $conn->query($sql);
   while ($result = mysqli_fetch_array($results)) {
    $sql = "select * FROM items_in_order where order_id = ".$result["order_id"];
    $items= $conn->query($sql);
    while ($item = mysqli_fetch_array($items)) {
    ?>
    itemsinordersarr.push(<?php echo  json_encode($item, JSON_HEX_TAG) ?>);
    <?php
        }
    }
    }
    if($_SESSION["admin"]){
    $sql = "select * FROM users";
    $results= $conn->query($sql);
    while ($result = mysqli_fetch_array($results)) {?>
    usersarr.push(<?php echo  json_encode($result, JSON_HEX_TAG) ?>);
    <?php

    }
    }
?>

</script>
