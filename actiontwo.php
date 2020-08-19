<?php
include('config.php');
$input = filter_input_array(INPUT_POST);

$newprice = mysqli_real_escape_string($mysqli, $input["price"]);
$newqty = mysqli_real_escape_string($mysqli, $input["qty"]);
$newtotal = mysqli_real_escape_string($mysqli, $input["total"]);


if ($input["action"] === 'delete') {
    $query = "
 DELETE FROM bill_info 
 WHERE s_no = '" . $input["s_no"] . "'
 ";
    mysqli_query($mysqli, $query);
}

echo json_encode($input);
