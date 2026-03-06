<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-WAynVo6MB-VqCP4859Ra067G';
Config::$clientKey = 'SB-Mid-client-ez9iYg4lEOP9L56E';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required

include "../../../db.php";
//$order_id = $_GET['order_id'];

  // Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
  $query = "SELECT * FROM pemesanan ORDER BY tanggal_pemesanan DESC LIMIT 1"; // Pastikan ada kolom created_at
  $sql = mysqli_query($conn, $query);  // Eksekusi/Jalankan query dari variabel $query
  $data = mysqli_fetch_array($sql);

if ($data) {
    $order_id = $data['order_id']; // Ambil order_id terbaru
    $nama = $data['nama'];
    $email = $data['email'];
    $total_bayar = $data['total_bayar'];

$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' =>  $total_bayar, // no decimal allowed for creditcard
);
// Optional
$item_details = array (
    array(
        'id' => 'a1',
        'price' => $total_bayar,
        'quantity' => 1,
        'name' => "PEMBAYARAN TIKET"
    ),
  );
// Optional
$customer_details = array(
    'first_name'    => "$nama",
    'last_name'     => "",
    'email'         => "$email",
    'phone'         => "",
 
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}

} else {
    echo "Tidak ada data pemesanan.";
}

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-WAynVo6MB-VqCP4859Ra067G\';');
        die();
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAYMENT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        body {
<<<<<<< HEAD
            background: linear-gradient(to right, #08959A , #08959A );
=======
            background: linear-gradient(to right, #6a11cb, #2575fc);
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .card-body {
            padding: 40px;
            background: #fff;
            text-align: center;
        }
        .card-body p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-primary {
<<<<<<< HEAD
            background: #08959A ;
=======
            background: #6a11cb;
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
<<<<<<< HEAD
            background: #08959A ;
=======
            background: #2575fc;
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
        }
    </style>
</head>
<body>
<<<<<<< HEAD
<div class="container">
=======
    <div class="container">
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
        <div class="card">
            <div class="card-body">
                <p>Selesaikan Pembayaran Sekarang</p>
                <button id="pay-button" class="btn btn-primary">PILIH METODE PEMBAYARAN</button>
                
<<<<<<< HEAD
                <!-- Midtrans Snap Script -->
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
                <script type="text/javascript">
                    document.getElementById('pay-button').onclick = function () {
                        // SnapToken acquired from previous step
                        snap.pay('<?php echo $snap_token; ?>', {
                            // Callback setelah pembayaran sukses
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil!");
                                console.log(result); // Log hasil pembayaran jika diperlukan
                                window.location.href = "http://localhost/vsc/WEB-MAIN/tiket.php"; // Redirect ke tiket.php
                            },
                            // Callback ketika pembayaran dibatalkan
                            onPending: function(result) {
                                alert("Pembayaran tertunda. Silakan selesaikan pembayaran.");
                                console.log(result);
                            },
                            // Callback ketika pembayaran gagal
                            onError: function(result) {
                                alert("Terjadi kesalahan saat pembayaran.");
                                console.log(result);
                            }
                        });
=======
                <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
                <script type="text/javascript">
                    document.getElementById('pay-button').onclick = function(){
                        // SnapToken acquired from previous step
                        snap.pay('<?php echo $snap_token?>');
>>>>>>> a6d1d7fb59b49c614209c67b9cee60e1e520f41d
                    };
                </script>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>

