<?php
include('config.php');
require("fpdf/fpdf.php");
class Invoice extends FPDF
{
    function Header()
    {
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Framed title
        $this->Cell(30, 10, 'INVOICE', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    function add_from($str)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->setXY(10, 50);
        $this->Cell(60, 5, 'BILL FROM', 0, 2, 'L');
        /* $this->Cell(60, 5, 'From', 1, 2, 'L', true); */
        $this->MultiCell(60, 5, $str, 0, 'LRB');
    }

    function add_to($str)
    {
        $x = $this->GetX();
        $this->setXY($x + 120, 50);
        $this->Cell(60, 5, 'BILL TO', 0, 2, 'L');
        $y = $this->GetY();
        $this->MultiCell(60, 5, $str, 0, 'LRB');
        $this->Ln(10);
    }
}

$pdf = new Invoice('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->add_from("XYZ\nabc street\nTEL:9876567891");

$pdf->SetFont('Arial', 'B', '12');

/* $pdf->Cell(50, 50, 'hello world'); */
/* $pdf->Image('bower-logo.png', 0, 0, 50, 50, 'PNG'); */

//CUSTOMER INFO 
$sqlcust = "SELECT customer_name,mobile_no,email_id FROM bill_header";
$resu = $mysqli->query($sqlcust);
if ($resu->num_rows > 0) {
    $i = 0;
    while ($row = $resu->fetch_assoc()) {
        $i++;
        $pdf->add_to("{$row["customer_name"]}\n{$row["mobile_no"]}\n{$row["email_id"]}");
        /*  $pdf->cell(15, 6, $row["customer_name"], 1, 0, 'C');
        $pdf->cell(50, 6, $row["mobile_no"], 1, 0, 'C');
        $pdf->cell(30, 6, $row["email_id"], 1, 1, 'C'); */
        $querycust = "SELECT * FROM bill_header";
        $query_run = mysqli_query($mysqli, $querycust);
    }
} else {
    $pdf->Cell(10, 10, 'NO CUSTOMER RECORD FOUND', 1, 0, 'C');
}

//PRODUCT BILL INFO
$pdf->Cell(20, 6, 'S.NO', 1, 0, 'C');
$pdf->Cell(60, 6, 'PROD NAME', 1, 0, 'C');
$pdf->Cell(40, 6, 'UNIT PRICE', 1, 0, 'C');
$pdf->Cell(20, 6, 'QTY', 1, 0, 'C');
$pdf->Cell(30, 6, 'TOTAL', 1, 1, 'C');
$sql = "SELECT s_no,prod_name,price,qty,total FROM bill_info";
$res = $mysqli->query($sql);
if ($res->num_rows > 0) {
    $i = 0;
    while ($row = $res->fetch_assoc()) {
        $i++;
        $pdf->cell(20, 6, $row["s_no"], 1, 0, 'C');
        $pdf->cell(60, 6, $row["prod_name"], 1, 0, 'C');
        $pdf->cell(40, 6, $row["price"], 1, 0, 'C');
        $pdf->cell(20, 6, $row["qty"], 1, 0, 'C');
        $pdf->cell(30, 6, $row["total"], 1, 1, 'C');
        $query = "SELECT * FROM bill_info";
        $query_run = mysqli_query($mysqli, $query);
        $total = 0;
        while ($num = mysqli_fetch_array($query_run)) {
            $total += $num['total'];
        }
    }
    $pdf->cell(80, 6,  '', 0, 0, 'C');
    $pdf->cell(60, 6,  'GRAND TOTAL:', 1, 0, 'C');
    $pdf->cell(30, 6,  $total, 1, 1, 'C');
} else {
    $pdf->Cell(10, 10, 'NO RECORD FOUND', 1, 0, 'C');
}

$pdf->Output();
ob_end_flush();
