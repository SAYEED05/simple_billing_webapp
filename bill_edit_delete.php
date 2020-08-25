<?php
include('config.php');
$input = filter_input_array(INPUT_POST);

$newprice = mysqli_real_escape_string($mysqli, $input["price"]);
$newqty = mysqli_real_escape_string($mysqli, $input["qty"]);
$newtotal = mysqli_real_escape_string($mysqli, $input["total"]);

//DELETE SEPECIFIC
if ($input["action"] === 'delete') {
    $query = "
 DELETE FROM bill_info 
 WHERE s_no = '" . $input["s_no"] . "'
 ";
    mysqli_query($mysqli, $query);
}

echo json_encode($input);

//DELETE ALL IN BILL
if (isset($_POST['act'])) {
    $quer = "
    TRUNCATE TABLE bill_info

 ";
    mysqli_query($mysqli, $quer);
}

//DELETE CUSTOMER INFO
if (isset($_POST['act'])) {
    $quer = "
    TRUNCATE TABLE bill_header

 ";
    mysqli_query($mysqli, $quer);
}

echo json_encode($input);
