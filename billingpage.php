<?php
include('config.php');
include('header.php');
$sql = "SELECT * FROM product_info ";
$result = mysqli_query($mysqli, $sql);
?>

<!-- CUSTOMER SECTION STARTS -->

<!-- CUSTOMER DETAILS -->
<div class="container">
    <h2>CUSTOMER DETAILS</h2>
</div>
<form class="form-inline" id="forma" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="table-responsive">
        <table id="custform" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>CUSTOMER NAME</th>
                    <th>PHONE NUMBER</th>
                    <th>EMAIL ID</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <div class="form-group">
                        <td><input class="form-control form-control-sm" name="custname" type="text"></td>
                        <td><input class="form-control form-control-sm" name="phno" type="text"></td>
                        <td><input class="form-control form-control-sm" name="emailid" type="text"></td>
                        <td><button type="submit" name="custsubmit" class="form-control btn btn-primary" id="addbtn">ADD CUSTOMER</button></td>

                    </div>
                </tr>
            </tbody>
        </table>
    </div>
</form>
<div class="table-responsive">
    <table id="custdet" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th class="cust_id">ID</th>
                <th>CUSTOMER NAME</th>
                <th>PHONE NUMBER</th>
                <th>EMAIL ID</th>
            </tr>
        </thead>
        <tbody>
            <?php

            //POST CUSTOMER DETAILS TO DATABASE
            if (isset($_POST['custsubmit'])) {
                $custname = $_POST['custname'];
                $custphone = $_POST['phno'];
                $custemail = $_POST['emailid'];
                $custDet = mysqli_query($mysqli, "INSERT into bill_header values(0,'$custname','$custphone','$custemail')");
                if ($custDet) {
                    exit(header("Location:billingpage.php"));
                    echo "success";
                } else {
                    echo "failed";
                    echo "ERROR: Could not able to execute $custDet." . mysqli_error($mysqli);
                }
            }
            //DISPLAY CUSTOMER INFORMATION 
            $dis = mysqli_query($mysqli, "SELECT* from bill_header");
            while ($custDet = mysqli_fetch_array($dis)) {
                echo '<tr>';
                echo '<td class="cust_id">' . $custDet['id'] . '</td>';
                echo '<td>' . $custDet['customer_name'] . '</td>';
                echo '<td>' . $custDet['mobile_no'] . '</td>';
                echo '<td>' . $custDet['email_id'] . '</td>';
                echo '</tr>';
            }

            ?>
        </tbody>
    </table>
</div>
<!-- CUSTOMER SECTION ENDS -->
<!-- BILL PRODUCT SECTION STARTS -->

<!-- BILL DETAILS -->
<div class="container">
    <h2>ADD PRODUCT TO LIST</h2>
</div>
<form class="form-inline" id="formb" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="table-responsive">
        <table id="billdet" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>prod name</th>
                    <th>price</th>
                    <th>qty</th>
                    <th>action</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tr>
                <div class="form-group">
                    <!-- S_NO <input type="text" name="s_no"> -->
                    <td>
                        <?php

                        echo " <select id='prodname' class='chosen-select form-control form-control-sm' name='prod_name'>
            <option value=''></option>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option  value=" . $row['prod_name'] . " data-value=" . $row['price'] . ">" . $row['prod_name'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </td>
                    <td> <input class="form-control form-control-sm" type="text" value="" name="price" id="price" readonly></td>
                    <td> <input class="form-control form-control-sm" type="text" name="qty"></td>
                    <!-- TOTAL <input type="text" name="total"> -->
                    <!--  <td><input type="button" class="btn btn-danger" id="delPOIbutton" value="Delete" onclick="deleteRow(this)" />
                        <input class="btn btn-primary" type="button" id="addmorePOIbutton" value="Add Another Item" onclick="insRow()" />
                    </td> -->

                    <td><input class="btn btn-primary" type="submit" name="submit" value="submit"></td>
                </div>
            </tr>


        </table>
    </div>
</form>
<div class="container">
    <h2>ADDED PRODUCTS</h2>
</div>
<div class="table-responsive">
    <table id="billtable" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>S.NO</th>
                <!-- <th>PROD_ID</th> -->
                <th>PROD_NAME</th>
                <th>PRICE</th>
                <th>QTY</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (isset($_POST['submit'])) {

                //$s_no = $_POST['s_no'];

                //$prod_id = $_POST['prod_id'];
                $prod_name = $_POST['prod_name'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $_POST['price'] * $_POST['qty'];

                $billDet = mysqli_query($mysqli, "INSERT into bill_info values(0,0,0,'$prod_name','$price','$qty','$total')");
                if ($billDet) {
                    exit(header("Location:billingpage.php"));
                    echo "success";
                } else {
                    echo "failed";
                    echo "ERROR: Could not able to execute $billDet." . mysqli_error($mysqli);
                }
            }

            //DISPLAY PRODUCTS IN DATABASE INSIDE TABLE
            $display = mysqli_query($mysqli, "SELECT* from bill_info ORDER by s_no ASC");
            while ($billDet = mysqli_fetch_array($display)) {
                echo '<tr>';
                echo '<td>' . $billDet['s_no'] . '</td>';
                //echo '<td>' . $billDet['prod_id'] . '</td>';
                echo '<td>' . $billDet['prod_name'] . '</td>';
                echo '<td>' . $billDet['price'] . '</td>';
                echo '<td>' . $billDet['qty'] . '</td>';
                echo '<td>' . $billDet['total'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="container">
        <?php
        //DISPLAY TOTAL
        $query = "SELECT * FROM bill_info";
        $query_run = mysqli_query($mysqli, $query);

        $total = 0;
        while ($num = mysqli_fetch_array($query_run)) {
            $total += $num['total'];
        }
        echo 'TOTAL: ' . $total;

        ?>
    </div>
</div>

<!-- BILL PRODUCT SECTION ENDS -->
<div class="container">
    <button class="btn btn-danger delall" id="delall" name="delall" value="delall">Clear Bill</button>
    <a class="btn btn-primary" id="genbtn" href="generatepdf.php">Generate Bill</a>
</div>

<?php
include('footer.php');
?>