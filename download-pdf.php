<?php

require __DIR__ . '/vendor/autoload.php';
include 'db.php';

use Spipu\Html2Pdf\Html2Pdf;
include "qr_code/qrlib.php";

// Ambil data terbaru dari database
$sql = "SELECT order_id, destinasi, email, tanggal_kunjungan, jumlah_tiket, total_bayar 
        FROM pemesanan 
        ORDER BY id DESC LIMIT 1"; // Mengambil entri terbaru
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    die("Data tidak ditemukan.");
}

// Direktori untuk menyimpan QR code
$tempdir = "img-qrcode/";
if (!file_exists($tempdir)) {
    mkdir($tempdir, 0755);
}

// Buat data untuk QR code
$qrContent = "E-Tiket SiJeli\n" .
             "Order ID: " . $data['order_id'] . "\n" .
             "Destinasi: " . $data['destinasi'] . "\n" .
             "Email: " . $data['email'] . "\n" .
             "Tanggal Kunjungan: " . $data['tanggal_kunjungan'] . "\n" .
             "Jumlah Tiket: " . $data['jumlah_tiket'] . " Orang\n" .
             "Total Harga: Rp " . number_format($data['total_bayar'], 0, ',', '.');

// Nama file QR code
$file_name = date("Ymd") . rand() . ".png";
$file_path = $tempdir . $file_name;

// Generate QR code
QRcode::png($qrContent, $file_path, "H", 6, 4);

// Validasi QR Code berhasil dibuat
if (!file_exists($file_path)) {
    die("QR Code gagal dibuat.");
}

// Siapkan konten HTML untuk PDF
$html = '
<style>
  body {
    font-family: Arial, sans-serif;
    font-size: 10px;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;    /* Pusatkan secara vertikal */
    height: 100vh;          /* Gunakan tinggi penuh layar */
    background-color: #f9f9f9;
  }
  h1 {
    text-align: center;
    color: #08959A;
    font-size: 13px;
    margin-bottom: 5px;
  }
  .ticket-container {
    width: 90%;                /* Lebar kontainer (opsional, bisa disesuaikan) */
    max-width: 80mm;           /* Maksimal lebar kertas */
    border: 1px solid #08959A; /* Batas dengan warna biru */
    border-radius: 5px;        /* Sudut membulat */
    padding: 0;             /* Padding di dalam kontainer */
    background: #fff;          /* Latar belakang putih */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Efek bayangan */
    margin: 0 auto;  
  }
  .ticket-header {
    text-align: center;
    margin-bottom: 10px;
  }
  .ticket-header img {
    max-width: 60px;
  }
  .ticket-details {
    margin-top: 0;
    text-align: left;
    padding: 0 10px;
  }
  .ticket-details table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
  }
  .ticket-details th, .ticket-details td {
    text-align: left;
    padding: 4px 12.4px;
    border: 1px solid #ddd;
    font-size: 8px;
  }
  .ticket-details th {
    background-color: #08959A;
    color: white;
    text-align: left;
  }
  .total {
    text-align: center;
    font-size: 8px;
    font-weight: bold;
    color: #08959A;
    margin-top: 10px;
  }
  .qr-code {
    text-align: center;
    margin-top: 10px;
  }

</style>
<div class="ticket-container">
  <div class="ticket-header">
    <img src="img/jeli.png" alt="Logo">
    <h1>E-Tiket</h1>
    <p style="font-size: 8px; margin: 0;"></p>
  </div>
  <div class="ticket-details">
    <table>
      <tr>
        <th>Order ID</th>
        <td>' . htmlspecialchars($data['order_id']) . '</td>
      </tr>
      <tr>
        <th>Destinasi</th>
        <td>' . htmlspecialchars($data['destinasi']) . '</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>' . htmlspecialchars($data['email']) . '</td>
      </tr>
      <tr>
        <th>Tanggal Kunjungan</th>
        <td>' . htmlspecialchars($data['tanggal_kunjungan']) . '</td>
      </tr>
      <tr>
        <th>Jumlah Tiket</th>
        <td>' . htmlspecialchars($data['jumlah_tiket']) . ' Orang</td>
      </tr>
      <tr>
        <th>Total Harga</th>
        <td>Rp ' . number_format($data['total_bayar'], 0, ',', '.') . '</td>
      </tr>
    </table>
  </div>
  <div class="qr-code">
    <img src="' . $file_path . '" alt="QR Code" style="width: 80px; height: 80px; margin: auto;">
    <p class="total">Terima kasih telah berwisata di Jember!</p>
 </div>
</div>
';

// Konversi HTML ke PDF
// Mengatur ukuran halaman untuk kertas struk kasir (80 mm x panjang dinamis)
$html2pdf = new Html2Pdf('P', array(80, 110), 'en'); 
$html2pdf->writeHTML($html);
$html2pdf->output('e-tiket-SiJeli.pdf'); // Nama file PDF
