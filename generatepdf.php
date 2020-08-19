<?php
include('config.php');
include('header.php');
ob_start();
require("fpdf/fpdf.php");
class Invoice extends FPDF
{
    function add_from($str)
    {
        $this->SetFont('Arial', '', 10);
        $this->setXY(10, 50);
        $this->Cell(70, 7, 'From', 1, 2, 'L', true);
        $this->MultiCell(70, 8, $str, 'LRB', 1);
    }

    function add_to($str)
    {
        $x = $this->GetX();
        $this->setXY($x + 120, 50);
        $this->Cell(60, 7, 'To', 1, 2, 'L', true);
        $y = $this->GetY();
        $this->MultiCell(60, 8, $str, 'LRB', 1);
        $this->Ln(10);
    }
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
/* $pdf->add_from("XYZ Enterprises\nabc street,PO 8976\nTel:9876567891");
$pdf->add_to("ABC Enterprises\ndef street,PO 8975\nTel:9876567756"); */
$pdf->SetFont('Arial', 'B', '12');

/* $pdf->Cell(50, 50, 'hello world'); */
/* $pdf->Image('bower-logo.png', 0, 0, 50, 50, 'PNG'); */

$pdf->Cell(15, 6, 'S.NO', 1, 0, 'C');
$pdf->Cell(50, 6, 'PROD NAME', 1, 0, 'C');
$pdf->Cell(30, 6, 'UNIT PRICE', 1, 0, 'C');
$pdf->Cell(20, 6, 'QTY', 1, 0, 'C');
$pdf->Cell(20, 6, 'TOTAL', 1, 1, 'C');
$sql = "SELECT s_no,prod_name,price,qty,total FROM bill_info";
$res = $mysqli->query($sql);
if ($res->num_rows > 0) {
    $i = 0;
    while ($row = $res->fetch_assoc()) {
        $i++;
        $pdf->cell(15, 6, $row["s_no"], 1, 0, 'C');
        $pdf->cell(50, 6, $row["prod_name"], 1, 0, 'C');
        $pdf->cell(30, 6, $row["price"], 1, 0, 'C');
        $pdf->cell(20, 6, $row["qty"], 1, 0, 'C');
        $pdf->cell(20, 6, $row["total"], 1, 1, 'C');
        $query = "SELECT * FROM bill_info";
        $query_run = mysqli_query($mysqli, $query);
        $total = 0;
        while ($num = mysqli_fetch_array($query_run)) {
            $total += $num['total'];
        }
    }
    $pdf->cell(45, 6,  'GRAND TOTAL:', 1, 0, 'C');
    $pdf->cell(20, 6,  $total, 1, 1, 'C');
} else {
    $pdf->Cell(10, 10, 'NO RECORD FOUND', 1, 0, 'C');
}






$pdf->Output();
ob_flush();

include('footer.php');
