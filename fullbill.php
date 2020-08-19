<?php
include('config.php');
include('header.php');
$sql = "SELECT * FROM bill_header h INNER JOIN bill_info i ON h.bill_no = i.bill_no";
$result = mysqli_query($mysqli, $sql);
?>

<form class="form-inline" action="" method="POST">
    <div class="form-group">
        <!-- bill.no <input class="form-group" type="text" name="bill_no"> -->
        date <input class="form-control form-control-sm" type="date" name="bill_date">
        customer name <input class="form-control form-control-sm" type="text" name="customer_name">
        mobile no <input class="form-control form-control-sm" type="tel" name="mobile_no">
        <?php

        echo "PROD_NAME <select id='prodname' class='form-control form-control-sm' name='prod_name'>
            <option value=''></option>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option  value=" . $row['prod_name'] . " data-value=" . $row['price'] . ">" . $row['prod_name'] . "</option>";
        }
        echo "</select>";
        ?>
        PRICE <input class="form-control form-control-sm" type="text" value="" name="price" id="price">
        QTY <input class="form-control form-control-sm" type="text" name="qty">
        <!-- TOTAL <input type="text" name="total"> -->
        <input class="btn btn-primary" type="submit" class="form-group " name="submit" value="submit">
    </div>
</form>
<table id="" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>bill.no</th>
            <th>date</th>
            <th>customer name</th>
            <th>mobile no</th>
            <th>s.no</th>
            <th>price</th>
            <th>qty</th>
            <th>total</th>
        </tr>
    </thead>
    <?php
    if (isset($_POST['submit'])) {
        //$s_no = $_POST['s_no'];

        $prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $_POST['price'] * $_POST['qty'];
        /* $bill_no = $_POST['bill_no']; */
        $date = $_POST['bill_date'];
        $customer_name = $_POST['customer_name'];
        $mobile_no = $_POST['mobile_no'];
        $billDet = mysqli_query($mysqli, "INSERT into bill_info values('','','','$prod_name','$price','$qty','$total')");
        $new = mysqli_query($mysqli, "INSERT into bill_header values('','$date','$customer_name','$mobile_no')");
        if ($billDet && $new) {
            exit(header("Location:fullbill.php"));
            echo "success";
        } else {
            echo "failed";
            echo "ERROR: Could not able to execute $billDet." . mysqli_error($mysqli);
            echo "ERROR: Could not able to execute $new." . mysqli_error($mysqli);
        }
    }
    while ($new = mysqli_fetch_array($result) && $billDet = mysqli_fetch_array($display)) {
        echo '<tr>';
        echo '<td>' . $new['bill_no'] . '</td>';
        echo '<td>' . $new['bill_date'] . '</td>';
        echo '<td>' . $new['customer_name'] . '</td>';
        echo '<td>' . $new['mobile_no'] . '</td>';
        echo '<td>' . $new['s_no'] . '</td>';
        echo '<td>' . $new['prod_id'] . '</td>';
        echo '<td>' . $new['price'] . '</td>';
        echo '<td>' . $new['qty'] . '</td>';
        echo '<td>' . $new['total'] . '</td>';
        echo '</tr>';
    }
    ?>

</table>
<?php include('footer.php'); ?>