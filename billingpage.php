<?php
include('config.php');
include('header.php');
$sql = "SELECT * FROM product_info ";
$result = mysqli_query($mysqli, $sql);
?>
<div class="container">
    <h2>ADD PRODUCT TO LIST</h2>
</div>
<!-- BILL DETAILS -->
<form class="form-inline" action="" method="POST">
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

        <?php

        if (isset($_POST['submit'])) {
            //$s_no = $_POST['s_no'];

            //$prod_id = $_POST['prod_id'];
            $prod_name = $_POST['prod_name'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $_POST['price'] * $_POST['qty'];

            $billDet = mysqli_query($mysqli, "INSERT into bill_info values('','','','$prod_name','$price','$qty','$total')");
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
<a class="btn btn-primary" href="generatepdf.php">Generate Bill</a>

<?php
include('footer.php');
?>