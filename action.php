<?php
include('config.php');
$input = filter_input_array(INPUT_POST);

$product_name = mysqli_real_escape_string($mysqli, $input["prod_name"]);
$newprice = mysqli_real_escape_string($mysqli, $input["price"]);

if ($input["action"] === 'edit') {
    $query = "
 UPDATE product_info 
 SET prod_name = '" . $product_name . "', 
 price = '" . $newprice . "' 
 WHERE prod_id = '" . $input["prod_id"] . "'
 ";

    mysqli_query($mysqli, $query);
}
if ($input["action"] === 'delete') {
    $query = "
 DELETE FROM product_info 
 WHERE prod_id = '" . $input["prod_id"] . "'
 ";
    mysqli_query($mysqli, $query);
}

echo json_encode($input);
