<?php
include 'db.php';
require_once('barcode/fpdf/phpqrcode/qrlib.php'); 
require_once('barcode/fpdf/fpdf.php');

// Ambil order_id dari URL
$order_id = $_GET['order_id'];

// Ambil data berdasarkan order_id
$query = "SELECT * FROM pemesanan WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan.");
}

$row = mysqli_fetch_assoc($result);

// Buat QR Code
$tempDir = "qrcodes/";
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0777, true);
}

$codeContents = "Order ID: " . $row['order_id'] .
    "\nNama: " . $row['nama_pembeli'] .
    "\nDestinasi: " . $row['destinasi'] .
    "\nJumlah Tiket: " . $row['jumlah_tiket'] .
    "\nTanggal Kunjungan: " . $row['tanggal_kunjungan'];

$fileName = $tempDir . $row['order_id'] . '.png';
QRcode::png($codeContents, $fileName, "M", 4, 4);

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'E-TIKET', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(0, 10, "Nama: " . $row['nama_pembeli'], 0, 1);
$pdf->Cell(0, 10, "Order ID: " . $row['order_id'], 0, 1);
$pdf->Cell(0, 10, "Destinasi: " . $row['destinasi'], 0, 1);
$pdf->Cell(0, 10, "Jumlah Tiket: " . $row['jumlah_tiket'], 0, 1);
$pdf->Cell(0, 10, "Tanggal Kunjungan: " . $row['tanggal_kunjungan'], 0, 1);

// Tambahkan QR Code ke PDF
$pdf->Image($fileName, 150, 50, 40, 40);

$pdf->Output('I', 'E-Tiket_' . $row['order_id'] . '.pdf');
?>
