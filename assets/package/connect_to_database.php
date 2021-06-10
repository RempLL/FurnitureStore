<?php
$conn = new mysqli("localhost","root", "","furniture_store");
         	if (mysqli_connect_error()) {
         		die('Connect Error ('. mysqli_connect_errno() . ') ' .mysqli_connect_error());
         	}
         	else{ 
         			$sql= "SET NAMES utf8";
         			$result= $conn->query($sql);
         }
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>