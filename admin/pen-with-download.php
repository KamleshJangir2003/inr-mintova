<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load FPDF library
require('fpdf.php'); // <-- make sure this path is correct

include('inc/function.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Pending Withdrawals',0,1,'C');
$pdf->Ln(5);

// Table header
$pdf->SetFont('Arial','B',8);
$headers = ['#','User ID','Name','Request','Payout','Bank','Branch','Acc Name','Acc No.','IFSC','Status','Date'];
$widths  = [10,15,25,15,15,20,20,25,25,20,20,20];

foreach ($headers as $i => $col) {
    $pdf->Cell($widths[$i],7,$col,1);
}
$pdf->Ln();

// Fetch data
$query = "SELECT * FROM imaksoft_withdrawal WHERE status = 'P' ORDER BY id DESC LIMIT 10000";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

$pdf->SetFont('Arial','',8);
$i = 1;
while ($fetch = mysqli_fetch_assoc($result)) {
    $pdf->Cell($widths[0],6,$i,1);
    $pdf->Cell($widths[1],6,$fetch['userid'],1);
    $pdf->Cell($widths[2],6,getMemberUserid($conn, $fetch['userid'], 'name'),1);
    $pdf->Cell($widths[3],6,$fetch['request'],1);
    $pdf->Cell($widths[4],6,$fetch['payout'],1);
    $pdf->Cell($widths[5],6,$fetch['bname'],1);
    $pdf->Cell($widths[6],6,$fetch['branch'],1);
    $pdf->Cell($widths[7],6,$fetch['accname'],1);
    $pdf->Cell($widths[8],6,$fetch['accno'],1);
    $pdf->Cell($widths[9],6,$fetch['ifscode'],1);
    $pdf->Cell($widths[10],6,($fetch['status']=='P'?'Pending':'Completed'),1);
    $pdf->Cell($widths[11],6,$fetch['date'],1);
    $pdf->Ln();
    $i++;
}

$pdf->Output('D', 'pending_withdrawals.pdf'); // Download PDF
exit;
?>
