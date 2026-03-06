<?php
include 'db.php';

// Ambil data terbaru dari database
$sql = "SELECT order_id, destinasi, email, tanggal_kunjungan, jumlah_tiket, transaction_status, total_bayar
        FROM pemesanan 
        ORDER BY id DESC LIMIT 1"; // Mengambil entri terbaru berdasarkan ID tertinggi
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    die("Tidak Ada Riwayat Pemesanan");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Tiket</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    :root {
      --primary-color: #08959A;
      --secondary-color: #08959A;
      --text-color: #fff;
      --bg-color: #f4f4f4;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: var(--text-color);
    background-color: var(--bg-color);
    }

    .container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    }

    /* Header Styles */
    header {
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0; /* Menempel di atas */
      width: 100%; /* Penuh sepanjang lebar layar */
      z-index: 1000;
      padding: 0.5rem 1rem;
      transition: all 0.3s ease;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary-color);
    }

    .nav-links {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .nav-links li {
      margin-left: 2rem;
    }

    .nav-links a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
      font-size: 1rem; /* Ukuran font menu */
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: var(--primary-color);
    }


    .card {
      max-width: 410px; /* Lebar maksimal */
      margin: 7rem auto 3rem;; /* Tengah pada layar */
      border-radius: 15px; /* Sudut membulat */
    }
    .card-header, {
      background-color: #08959A; /* Warna latar belakang header */
      color: #fff; /* Warna teks putih agar kontras */
      border-radius: 15px 15px 0 0; /* Sudut membulat untuk header */
      padding: 10px; /* Padding dalam header */
      text-align: center; /* Teks di tengah */
      font-weight: bold; /* Teks tebal */
    }
    .card-footer {
      border-radius: 15px 15px 0 0; /* Header */
    }
    .card-footer {
      border-radius: 0 0 15px 15px; /* Footer */
    }
    .card-body {
      font-size: 0.9rem; /* Ukuran font detail */
    }
    .detail-item {
      margin-bottom: 8px; /* Jarak antar detail */
      border-bottom: 1px dashed #ddd; /* Garis bawah untuk memisahkan item */
      padding-bottom: 5px; /* Padding bawah untuk jarak dengan garis */
    }
    .detail-item:last-child {
      border-bottom: none; /* Hilangkan garis bawah untuk item terakhir */
    }
    .btn-success {
      font-size: 0.9rem; /* Ukuran font tombol */
      font-weight: bold;
    }
    .btn-danger {
      font-size: 0.9rem;
      font-weight: bold;
    }

  </style>
</head>
<body>
<header>
        <nav class="container">
            <div class="logo">Jeli</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li><a href="pesan.php">Pesan Tiket</a></li>
                    <li><a href="tiket.php">Riwayat Tiket</a></li>
                    <li><a href="destinasi-jabar.php">Daftar Wisata</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <div class="logout-link">
                        <li><a href="logout.php">Logout</a></li>
                    </div>
                <?php else: ?>
                    <li><a href="pesan.php">Pesan Tiket</a></li>
                    <li><a href="tiket.php">Riwayat Tiket</a></li>
                    <li><a href="destinasi-jabar.php">Daftar Wisata</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

  <div class="container mt-5">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">E-Tiket</h3>
      </div>
      <div class="card-body">
        <h5 class="text-primary mb-3">Detail Tiket</h5>
        <table class="detail-table">
          <tr>
            <th>Order ID</th>
            <td> : <?php echo $data['order_id']; ?></td>
          </tr>
          <tr>
            <th>Destinasi</th>
            <td> : <?php echo $data['destinasi']; ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td> : <?php echo $data['email']; ?></td>
          </tr>
          <tr>
            <th>Tanggal Kunjungan</th>
            <td> : <?php echo $data['tanggal_kunjungan']; ?></td>
          </tr>
          <tr>
            <th>Jumlah Tiket</th>
            <td> : <?php echo $data['jumlah_tiket']; ?> Orang</td>
          </tr>
          <tr>
            <th>Total Bayar</th>
            <td> : <?php echo $data['total_bayar']; ?> </td>
          </tr>
          <tr>
          <th>Status Tiket</th>
            <td>: 
            <?php 
              if ($data['transaction_status'] == 3) {
                echo "Pembayaran Sukses";
              } elseif ($data['transaction_status'] == 2) {
                echo "Pembayaran Pending";
              } elseif ($data['transaction_status'] == 0) {
                echo "Pembelian Dibatalkan";
              } else {
              echo "Belum Dibayar";
              }
            ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer text-center">
        <?php if ($data['transaction_status'] == 1): ?>
          <!-- Tombol Bayar jika status "Belum Dibayar" -->
          <a href='./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id' class="btn btn-danger">
            Bayar Sekarang
          </a>
        <?php endif; ?>
        
        <?php if ($data['transaction_status'] != 1): ?>
          <!-- Tombol Download Tiket jika status tidak "Belum Dibayar" -->
          <a href="download-pdf.php" class="btn btn-success">
            <i class="bi bi-file-pdf"></i> Download Tiket
          </a>
        <?php endif; ?>
        <a href="#" class="btn btn-danger" onclick="confirmCancel('<?php echo $data['order_id']; ?>')">
                Batalkan Tiket
        </a>
      </div>
    </div>
  </div>
  <script>
  function confirmCancel(orderId) {
    Swal.fire({
        title: 'Konfirmasi Pembatalan',
        text: 'Apakah Anda yakin ingin membatalkan tiket ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, batalkan',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `index.php?order_id=${orderId}`;
        }
    });
    }  
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>