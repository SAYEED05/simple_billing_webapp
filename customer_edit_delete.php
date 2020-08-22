<?php
include('config.php');
$input = filter_input_array(INPUT_POST);

$newname = mysqli_real_escape_string($mysqli, $input["customer_name"]);
$newmobileno = mysqli_real_escape_string($mysqli, $input["mobile_no"]);
$newemail = mysqli_real_escape_string($mysqli, $input["email_id"]);

/* if ($input["action"] === 'edit') {
    $query = "
 UPDATE bill_header 
 SET customer_name = '" . $newname . "', 
 mobile_no = '" . $newmobileno . "',
 email_id = '" . $newemail . "' ,
 WHERE id = '" . $input["id"] . "'
 ";

    mysqli_query($mysqli, $query);
} */


if ($input["action"] === 'delete') {
    $query = "
 DELETE FROM bill_header 
 WHERE id = '" . $input["id"] . "'
 ";
    mysqli_query($mysqli, $query);
}

echo json_encode($input);
