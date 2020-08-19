<?php
include('config.php');

$price = $_REQUEST['price'];
$sql = mysqli_query($link, "SELECT price FROM product_info WHERE price = '" . $price . "' ");
$row = mysqli_fetch_array($sql);

json_encode($row);
die;
