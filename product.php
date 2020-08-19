<?php
include('config.php');
include('header.php');

?>
<div class="container">
    <h2>ADD PRODUCTS TO INVENTORY</h2>
</div>
<form class="form-group" action="" method="POST">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>PRODUCT NAME</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input class="form-control name" type="text" name="prod_name" required></td>
                <td><input class="form-control form-control-sm price" type="text" name="price" required></td>
                <td><input type="submit" class="form-control btn btn-primary " name="submit" value="submit"></td>
            </tr>
        </tbody>
</form>

</table>

<div class="container">
    <h2>INVENTORY</h2>
</div>
<table id="editable_table" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>PRODUCT-ID</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
        </tr>
    </thead>
    <?php
    if (isset($_POST['submit'])) {
        //$prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $price = $_POST['price'];

        $new = mysqli_query($mysqli, "INSERT into product_info values(NULL,'$prod_name','$price')");
        if ($new) {
            header("Location: product.php");
            echo "success";
        } else {
            echo "failed";
            echo "ERROR: Could not able to execute $new." . mysqli_error($mysqli);
        }
    }

    //DISPLAY PRODUCTS IN DATABASE INSIDE TABLE
    $display = mysqli_query($mysqli, "SELECT* from product_info ORDER by prod_id ASC");
    while ($new = mysqli_fetch_array($display)) {
        echo '<tr>';
        echo '<td>' . $new['prod_id'] . '</td>';
        echo '<td>' . $new['prod_name'] . '</td>';
        echo '<td>' . $new['price'] . '</td>';
        echo '</tr>';
    }

    ?>
</table>



<?php
include('footer.php');

?>