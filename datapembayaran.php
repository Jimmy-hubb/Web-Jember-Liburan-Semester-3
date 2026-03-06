<?php
include 'db.php'; 
include 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <section class="content">
      <div class="box">
      <div class="box-header with-border">
        <i class="fa fa-map-marker"></i>
        <h3 class="box-title">Tabel Pembayaran</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i>
          </button>
          <span class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Data</span>
        </div>
      </div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Alamat</th>
              <th>Total Bayar</th>
              <th>Order ID</th>
              <th>Email</th>
              <th>Status Transaksi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  
            error_reporting(0);
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM pemesanan ORDER BY id DESC");
            while ($data = mysqli_fetch_array($query)) {
              $transaction = $data['transaction_status'];
              
              // $code = $data['email']."/".$data['order_id']."/".$data['destinasi']."/".$data['jumlah_tiket']."/".$data['tanggal_kunjungan'];
              // require_once('qrcode/qrlib.php'); 
              // $qrFileName = "qrcodes/code".$no.".png"; // Nama file QR Code
              // QRcode::png($code, $qrFileName, "M", 2, 2);
              
              echo "<tr>";
              echo "<td>".$no++."</td>";
              //echo "<td><img src='".$qrFileName."' alt='QR Code'></td>"; // Menampilkan QR code
              echo "<td>".$data['nama']."</td>";
              echo "<td>".$data['alamat']."</td>";
              echo "<td>".$data['total_bayar']."</td>";
              echo "<td>".$data['order_id']."</td>";
              echo "<td>".$data['email']."</td>";

              if ($transaction >= 3) {
                echo "<td><b>Pembayaran Sukses</b></td>";
              } elseif ($transaction == 2) {
                echo "<td><b>Pembayaran Pending</b></td>";
              } else {
                echo "<td><b>Pembayaran Belum Dilakukan</b></td>";
              }

              echo "<td><a href='hapus.php?id=".$data['id']."' class='btn btn-danger'><i class='bi bi-trash-fill'></i> HAPUS</a></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      </section>
  </div>

    <!-- JS Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<?php
include 'footer.php';
?>
