<?php
include('config.php');
include('header.php');
?>


<!-- BILL HEADER -->

<form class="form-inline" action="" method="POST">
    <div class="form-group">
        <!-- bill.no <input class="form-group" type="text" name="bill_no"> -->
        date <input class="form-control form-control-sm" type="date" name="bill_date">
        customer name <input class="form-control form-control-sm" type="text" name="customer_name">
        mobile no <input class="form-control form-control-sm" type="tel" name="mobile_no">
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
        </tr>
    </thead>
    <?php
    if (isset($_POST['submit'])) {
        /* $bill_no = $_POST['bill_no']; */
        $date = $_POST['bill_date'];
        $customer_name = $_POST['customer_name'];
        $mobile_no = $_POST['mobile_no'];

        $new = mysqli_query($mysqli, "INSERT into bill_header values('','$date','$customer_name','$mobile_no')");
        if ($new) {
            header("Location: billheader.php");
            echo "success";
        } else {
            echo "failed";
            echo "ERROR: Could not able to execute $new." . mysqli_error($mysqli);
        }
    }

    //DISPLAY BILL HEADER IN DATABASE INSIDE TABLE
    $display = mysqli_query($mysqli, "SELECT* from bill_header ORDER by bill_no ASC");
    while ($new = mysqli_fetch_array($display)) {
        echo '<tr>';
        echo '<td>' . $new['bill_no'] . '</td>';
        echo '<td>' . $new['bill_date'] . '</td>';
        echo '<td>' . $new['customer_name'] . '</td>';
        echo '<td>' . $new['mobile_no'] . '</td>';
        echo '</tr>';
    }

    ?>
</table>
<?php
include('footer.php');
?>