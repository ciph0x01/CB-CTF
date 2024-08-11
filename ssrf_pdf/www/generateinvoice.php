<?php
require('fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customer_name'];
    $customerEmail = $_POST['customer_email'];
    $invoiceNumber = $_POST['invoice_number'];
    $invoiceAmount = $_POST['invoice_amount'];
    $invoiceDate = $_POST['invoice_date'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Customer Name: $customerName", 0, 1);
    $pdf->Cell(0, 10, "Customer Email: $customerEmail", 0, 1);
    $pdf->Cell(0, 10, "Invoice Number: $invoiceNumber", 0, 1);
    $pdf->Cell(0, 10, "Invoice Amount: $invoiceAmount", 0, 1);
    $pdf->Cell(0, 10, "Invoice Date: $invoiceDate", 0, 1);
    
    $pdf->Output('I', 'invoice.pdf');
}
?>
