<?php
include('config.php');
include('header.php');
$sql = "SELECT * FROM product_info ";
$result = mysqli_query($mysqli, $sql);
?>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<form action="" method="POST" id="formA">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>CUSTOMER NAME</th>
                            <th>CUSTOMER PHONE</th>
                            <th>CUSTOMER EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control" type="text" name="custname"></td>
                            <td><input class="form-control" type="text" name="custph"></td>
                            <td><input class="form-control" type="text" name="custemail"></td>
                        </tr>
                    </tbody>

                </table>
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"> # </th>
                            <th class="text-center"> Product </th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Total </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr id='addr0'>
                            <td>1</td>
                            <td>

                                <?php
                                echo " <select id='prodname' class='chosen-select form-control form-control-sm' name='prod_name[] required'>
                            <option value=''></option>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option  value=" . $row['prod_name'] . " data-value=" . $row['price'] . ">" . $row['prod_name'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                            </td>
                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" required /></td>
                            <td><input type="number" name='price[]' placeholder='Unit Price' value="" class="form-control price" step="0.00" min="0" id="price" readonly required /></td>
                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly /></td>
                        </tr>
                        <tr id='addr1'></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <button id="add_row" class="btn btn-default pull-left" type="button">Add Row</button>
                <button id='delete_row' class="pull-right btn btn-default" type="button">Delete Row</button>
            </div>
        </div>
        <div class="row clearfix" style="margin-top:20px">
            <div class="pull-right col-md-4">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                        <tr>
                            <th class="text-center">Sub Total</th>
                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center">Tax</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <input type="number" class="form-control" id="tax" name='tax_percent' placeholder="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">Tax Amount</th>
                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center">Grand Total</th>
                            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input class="btn btn-primary" type="submit" name="submit" value="submit">
</form>
<?php
//SAVE FORM TO DATABASE
if (isset($_POST['submit'])) {
    //$s_no = $_POST['s_no'];
    //$prod_id = $_POST['prod_id'];
    $prod_name = $_POST['prod_name'];
    $qty = $_POST['qty'];
    $unitprice = $_POST['price'];
    $total = $_POST['total'];
    $subtotal = $_POST['sub_total'];
    $taxpercent = $_POST['tax_percent'];
    $taxamount = $_POST['tax_amount'];
    $totalamount = $_POST['total_amount'];

    $invdet = mysqli_query($mysqli, "INSERT into invoice values('$prod_name','$qty','$unitprice','$total','$subtotal','$taxpercent','$taxamount','$totalamount')");
    if ($invdet) {
        exit(header("Location:bootinvoice.php"));
        echo "success";
    } else {
        echo "failed";
        echo "ERROR: Could not able to execute $invdet." . mysqli_error($mysqli);
    }
}
include('footer.php');
?>