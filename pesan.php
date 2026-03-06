<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php?redirect=pesan.php");
    exit();
}
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Data dari POST
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $destinasi = $_POST['destinasi'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $total_bayar = $_POST['total_bayar'];
    $order_id = 'order-' . time() . '-' . rand(1000, 9999);
    $transaction_status = 1;
    
    try {
        // Query untuk menyimpan data
        $stmt = $pdo->prepare("INSERT INTO pemesanan 
            (nama, email, telepon, alamat, destinasi, jumlah_tiket, tanggal_kunjungan, total_bayar, order_id, transaction_status)
            VALUES (:nama, :email, :telepon, :alamat, :destinasi, :jumlah_tiket, :tanggal_kunjungan, :total_bayar, :order_id, :transaction_status)");

        // Bind parameter
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telepon', $telepon);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':destinasi', $destinasi);
        $stmt->bindParam(':jumlah_tiket', $jumlah_tiket);
        $stmt->bindParam(':tanggal_kunjungan', $tanggal_kunjungan);
        $stmt->bindParam(':total_bayar', $total_bayar);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':transaction_status', $transaction_status);

        // Eksekusi statement
        $stmt->execute();
        $order_id = $pdo->lastInsertId();
        echo "<script>
                alert('Pemesanan berhasil disimpan!');
                window.location.href = './midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id';
            </script>";
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Wisata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f2f5;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .wisata-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .date-input {
            display: none;
            margin-top: 10px;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

/* Navbar Styles */
header {
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    z-index: 1000;
    transition: all 0.3s ease;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    width: 200%;
    max-width: 1200px;
    margin: 0 auto;
}

.logo {
    font-size: 1.5rem;
    font-weight: 700;
    color: #08959A;
}

.nav-links {
    display: flex;
    list-style: none;
}

.nav-links li {
    margin-left: 2rem;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: 600;
    transition: color 0.3s ease;
}

.nav-links a:hover {
    color: #08959A;
}

.logout-link {
    margin-left: auto;
}

/* Existing styles */
body {
    font-family: 'Poppins', sans-serif;
    max-width: 100%;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
}

.container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    /* Add padding-top to account for fixed navbar */
    padding-top: 100px;
}

.form-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Rest of your existing styles */
.step {
    display: none;
}
.step.active {
    display: block;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
input, select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}
button {
    background-color: #08959A;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}
button:hover {
    background-color: #067f7a;
}
.wisata-card {
    border: 1px solid #ddd;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
}
.summary {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin-top: 20px;
}
.date-input {
    display: none;
    margin-top: 10px;
}
    </style>
</head>
<body>
<header>
        <nav>
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
                    <li><a href="#" onclick="checkLogin()">Pesan Tiket</a></li>
                    <li><a href="tiket.php">Riwayat Tiket</a></li>
                    <li><a href="destinasi-jabar.php">Daftar Wisata</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Pemesanan Tiket Wisata</h1>
        
        <!-- Step 1: Biodata -->
        <div class="step active" id="step1">
            <h2>Langkah 1: Biodata</h2>
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" required>
            </div>
            <button onclick="nextStep()">Lanjutkan</button>
        </div>

        <!-- Step 2: Pilih Wisata -->
<div class="step" id="step2">
    <h2>Langkah 2: Pilih Wisata</h2>

    <!-- Dropdown untuk memilih destinasi wisata -->
    <div class="form-group">
        <label for="pilih-wisata">Pilih Wisata:</label>
        <select id="pilih-wisata" onchange="updateInputs()" required>
            <option value="" disabled selected>-- Pilih Wisata --</option>
            <option value="kuta" data-price="50000">Pantai Kuta - Rp 50.000/orang</option>
            <option value="tanahlot" data-price="75000">Tanah Lot - Rp 75.000/orang</option>
            <option value="ubud" data-price="60000">Ubud Monkey Forest - Rp 60.000/orang</option>
        </select>
    </div>

    <!-- Input jumlah tiket -->
    <div class="form-group" id="jumlah-tiket-group" style="display: none;">
        <label for="jumlah-tiket">Jumlah Tiket:</label>
        <input type="number" id="jumlah-tiket" min="1" value="1" onchange="updateTotal()">
    </div>

    <!-- Input tanggal kunjungan -->
    <div class="form-group" id="tanggal-kunjungan-group" style="display: none;">
        <label for="tanggal-kunjungan">Tanggal Kunjungan:</label>
        <input type="date" id="tanggal-kunjungan" required>
    </div>

    <!-- Total biaya -->
    <div class="form-group" id="total-biaya-group" style="display: none;">
        <p>Total Biaya: <span id="total-biaya">Rp 0</span></p>
    </div>

    <button onclick="prevStep()">Kembali</button>
    <button onclick="showSummary()">Pesan Tiket</button>
</div>

<!-- Step 3: Ringkasan -->
<div class="step" id="step3">
    <h2>Langkah 3: Ringkasan Pemesanan</h2>
    <div class="summary" id="ringkasan"></div>
    <button onclick="prevStep()">Kembali</button>
    <form action="pesan.php" method="POST">
        <input type="hidden" name="nama" id="form-nama">
        <input type="hidden" name="email" id="form-email">
        <input type="hidden" name="telepon" id="form-telepon">
        <input type="hidden" name="alamat" id="form-alamat">
        <input type="hidden" name="destinasi" id="form-destinasi">
        <input type="hidden" name="jumlah_tiket" id="form-jumlah_tiket">
        <input type="hidden" name="tanggal_kunjungan" id="form-tanggal_kunjungan">
        <input type="hidden" name="total_bayar" id="form-total_bayar">
        <br>
        <button type="submit" onclick="prepareFormData()">Konfirmasi Pemesanan
        <a href='./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id'></a>
        </button>    
    </form>
</div>

<script>
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.min = today;
    });

    let currentStep = 1;

    function updateInputs() {
        const wisataDropdown = document.getElementById("pilih-wisata");
        const selectedWisata = wisataDropdown.options[wisataDropdown.selectedIndex];
        const price = selectedWisata.getAttribute("data-price");

        // Tampilkan input jumlah tiket dan tanggal jika wisata dipilih
        if (price) {
            document.getElementById("jumlah-tiket-group").style.display = "block";
            document.getElementById("tanggal-kunjungan-group").style.display = "block";
            document.getElementById("total-biaya-group").style.display = "block";

            // Set minimal tanggal kunjungan (hari ini)
            document.getElementById("tanggal-kunjungan").min = today;

            // Update total biaya
            updateTotal();
        }
    }

    function updateTotal() {
        const wisataDropdown = document.getElementById("pilih-wisata");
        const selectedWisata = wisataDropdown.options[wisataDropdown.selectedIndex];
        const price = parseInt(selectedWisata.getAttribute("data-price"), 10) || 0;

        const jumlahTiket = parseInt(document.getElementById("jumlah-tiket").value, 10) || 0;
        const total = price * jumlahTiket;

        // Update tampilan total biaya
        document.getElementById("total-biaya").textContent = `Rp ${total.toLocaleString()}`;
    }

    function nextStep() {
        if (validateStep1()) {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }
    }

    function prevStep() {
        document.getElementById(`step${currentStep}`).classList.remove('active');
        currentStep--;
        document.getElementById(`step${currentStep}`).classList.add('active');
    }

    function validateStep1() {
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const telepon = document.getElementById('telepon').value;
        const alamat = document.getElementById('alamat').value;

        if (!nama || !email || !telepon || !alamat) {
            alert('Mohon lengkapi semua data!');
            return false;
        }
        return true;
    }

    function showSummary() {
        const wisataDropdown = document.getElementById("pilih-wisata");
        const selectedWisata = wisataDropdown.options[wisataDropdown.selectedIndex].text;
        const jumlahTiket = parseInt(document.getElementById("jumlah-tiket").value, 10) || 0;
        const tanggalKunjungan = document.getElementById("tanggal-kunjungan").value;

        if (!tanggalKunjungan || jumlahTiket <= 0) {
            alert("Mohon lengkapi jumlah tiket dan tanggal kunjungan.");
            return;
        }

        const totalBiaya = document.getElementById("total-biaya").textContent;

        const summaryHTML = `
            <h3>Data Pemesan:</h3>
            <p>Nama: ${document.getElementById("nama").value}</p>
            <p>Email: ${document.getElementById("email").value}</p>
            <h3>Detail Pemesanan:</h3>
            <p>Destinasi: ${selectedWisata}</p>
            <p>Jumlah Tiket: ${jumlahTiket}</p>
            <p>Tanggal Kunjungan: ${tanggalKunjungan}</p>
            <h3>Total Pembayaran: ${totalBiaya}</h3>
        `;

        document.getElementById("ringkasan").innerHTML = summaryHTML;

        document.getElementById(`step${currentStep}`).classList.remove("active");
        currentStep++;
        document.getElementById(`step${currentStep}`).classList.add("active");
    }

    function prepareFormData() {
        document.getElementById("form-nama").value = document.getElementById("nama").value;
        document.getElementById("form-email").value = document.getElementById("email").value;
        document.getElementById("form-telepon").value = document.getElementById("telepon").value;
        document.getElementById("form-alamat").value = document.getElementById("alamat").value;
        document.getElementById("form-destinasi").value = document.getElementById("pilih-wisata").value;
        document.getElementById("form-jumlah_tiket").value = document.getElementById("jumlah-tiket").value;
        document.getElementById("form-tanggal_kunjungan").value = document.getElementById("tanggal-kunjungan").value;
        document.getElementById("form-total_bayar").value = document.getElementById("total-biaya").textContent.replace(/[^0-9]/g, "");
    }
</script>


        <!-- Step 2: Pilih Wisata
        <div class="step" id="step2">
            <h2>Langkah 2: Pilih Wisata</h2>
            <div class="wisata-card">
                <h3>Pantai Kuta</h3>
                <p>Harga: Rp 50.000/orang</p>
                <div class="form-group">
                    <label for="jumlah-kuta">Jumlah Tiket:</label>
                    <input type="number" id="jumlah-kuta" min="0" value="0" onchange="toggleDateInput('kuta')">
                </div>
                <div class="date-input" id="date-kuta">
                    <label for="tanggal-kuta">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal-kuta" required min="">
                </div>
            </div>
            <div class="wisata-card">
                <h3>Tanah Lot</h3>
                <p>Harga: Rp 75.000/orang</p>
                <div class="form-group">
                    <label for="jumlah-tanahlot">Jumlah Tiket:</label>
                    <input type="number" id="jumlah-tanahlot" min="0" value="0" onchange="toggleDateInput('tanahlot')">
                </div>
                <div class="date-input" id="date-tanahlot">
                    <label for="tanggal-tanahlot">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal-tanahlot" required min="">
                </div>
            </div>
            <div class="wisata-card">
                <h3>Ubud Monkey Forest</h3>
                <p>Harga: Rp 60.000/orang</p>
                <div class="form-group">
                    <label for="jumlah-ubud">Jumlah Tiket:</label>
                    <input type="number" id="jumlah-ubud" min="0" value="0" onchange="toggleDateInput('ubud')">
                </div>
                <div class="date-input" id="date-ubud">
                    <label for="tanggal-ubud">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal-ubud" required min="">
                </div>
            </div>
            <button onclick="prevStep()">Kembali</button>
            <button onclick="showSummary()">Pesan Tiket</button>
        </div> -->

         <!-- Step 3: Ringkasan
        <div class="step" id="step3">
            <h2>Langkah 3: Ringkasan Pemesanan</h2>
            <div class="summary" id="ringkasan"></div>
            <button onclick="prevStep()">Kembali</button>
            <form action="pesan.php" method="POST">
                <input type="hidden" name="nama" id="form-nama">
                <input type="hidden" name="email" id="form-email">
                <input type="hidden" name="telepon" id="form-telepon">
                <input type="hidden" name="alamat" id="form-alamat">
                <input type="hidden" name="destinasi" id="form-destinasi">
                <input type="hidden" name="jumlah_tiket" id="form-jumlah_tiket">
                <input type="hidden" name="tanggal_kunjungan" id="form-tanggal_kunjungan">
                <input type="hidden" name="total_bayar" id="form-total_bayar">
                <br>
                
                <button type="submit" onclick="prepareFormData()">Konfirmasi Pemesanan
                <a href='./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id'></a>
                </button>
            </form>
        </div> -->

    <!-- <script>
        const today = new Date().toISOString().split('T')[0];
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.min = today;
        });

        let currentStep = 1;
        
        function toggleDateInput(location) {
            const tickets = parseInt(document.getElementById(`jumlah-${location}`).value) || 0;
            const dateInput = document.getElementById(`date-${location}`);
            
            if (tickets > 0) {
                dateInput.style.display = 'block';
            } else {
                dateInput.style.display = 'none';
                document.getElementById(`tanggal-${location}`).value = '';
            }
        }

        function nextStep() {
            if (validateStep1()) {
                document.getElementById(`step${currentStep}`).classList.remove('active');
                currentStep++;
                document.getElementById(`step${currentStep}`).classList.add('active');
            }
        }

        function prevStep() {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep--;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }

        function validateStep1() {
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const telepon = document.getElementById('telepon').value;
            const alamat = document.getElementById('alamat').value;

            if (!nama || !email || !telepon || !alamat) {
                alert('Mohon lengkapi semua data!');
                return false;
            }
            return true;
        }

        function validateDates() {
            const locations = ['kuta', 'tanahlot', 'ubud'];
            for (const loc of locations) {
                const tickets = parseInt(document.getElementById(`jumlah-${loc}`).value) || 0;
                if (tickets > 0) {
                    const date = document.getElementById(`tanggal-${loc}`).value;
                    if (!date) {
                        alert(`Mohon pilih tanggal kunjungan untuk ${loc.charAt(0).toUpperCase() + loc.slice(1)}`);
                        return false;
                    }
                }
            }
            return true;
        }

        function calculateTotal() {
            const kutaTickets = parseInt(document.getElementById('jumlah-kuta').value) || 0;
            const tanahlotTickets = parseInt(document.getElementById('jumlah-tanahlot').value) || 0;
            const ubudTickets = parseInt(document.getElementById('jumlah-ubud').value) || 0;

            return {
                kuta: kutaTickets * 50000,
                tanahlot: tanahlotTickets * 75000,
                ubud: ubudTickets * 60000,
                total: (kutaTickets * 50000) + (tanahlotTickets * 75000) + (ubudTickets * 60000)
            };
        }

        function formatDate(dateString) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        function showSummary() {
            if (!validateDates()) return;

            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const totals = calculateTotal();
            
            const kutaTickets = parseInt(document.getElementById('jumlah-kuta').value) || 0;
            const tanahlotTickets = parseInt(document.getElementById('jumlah-tanahlot').value) || 0;
            const ubudTickets = parseInt(document.getElementById('jumlah-ubud').value) || 0;

            if (kutaTickets + tanahlotTickets + ubudTickets === 0) {
                alert('Mohon pilih minimal 1 tiket wisata!');
                return;
            }

            let summaryHTML = `
                <h3>Data Pemesan:</h3>
                <p>Nama: ${nama}</p>
                <p>Email: ${email}</p>
                <h3>Detail Pemesanan:</h3>
            `;

            if (kutaTickets > 0) {
                const tanggalKuta = document.getElementById('tanggal-kuta').value;
                summaryHTML += `
                    <p>Pantai Kuta:</p>
                    <ul>
                        <li>Jumlah Tiket: ${kutaTickets} (Rp ${totals.kuta.toLocaleString()})</li>
                        <li>Tanggal Kunjungan: ${formatDate(tanggalKuta)}</li>
                    </ul>
                `;
            }
            if (tanahlotTickets > 0) {
                const tanggalTanahlot = document.getElementById('tanggal-tanahlot').value;
                summaryHTML += `
                    <p>Tanah Lot:</p>
                    <ul>
                        <li>Jumlah Tiket: ${tanahlotTickets} (Rp ${totals.tanahlot.toLocaleString()})</li>
                        <li>Tanggal Kunjungan: ${formatDate(tanggalTanahlot)}</li>
                    </ul>
                `;
            }
            if (ubudTickets > 0) {
                const tanggalUbud = document.getElementById('tanggal-ubud').value;
                summaryHTML += `
                    <p>Ubud Monkey Forest:</p>
                    <ul>
                        <li>Jumlah Tiket: ${ubudTickets} (Rp ${totals.ubud.toLocaleString()})</li>
                        <li>Tanggal Kunjungan: ${formatDate(tanggalUbud)}</li>
                    </ul>
                `;
            }

            summaryHTML += `<h3>Total Pembayaran: Rp ${totals.total.toLocaleString()}</h3>`;

            document.getElementById('ringkasan').innerHTML = summaryHTML;
            
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }

        function prepareFormData() {
    // Ambil nilai dari elemen HTML dan assign ke form input yang baru
    document.getElementById('form-nama').value = document.getElementById('nama').value;
    document.getElementById('form-email').value = document.getElementById('email').value;
    document.getElementById('form-telepon').value = document.getElementById('telepon').value;
    document.getElementById('form-alamat').value = document.getElementById('alamat').value;
    
    // Total biaya dan tanggal kunjungan bisa disesuaikan sesuai pilihan destinasi
    const totals = calculateTotal();
    document.getElementById('form-total_bayar').value = totals.total;

    let destinasi = '';
    let jumlah_tiket = 0;
    let tanggal_kunjungan = '';

    if (parseInt(document.getElementById('jumlah-kuta').value) > 0) {
        destinasi = 'Pantai Kuta';
        jumlah_tiket = document.getElementById('jumlah-kuta').value;
        tanggal_kunjungan = document.getElementById('tanggal-kuta').value;
    }
    
    // Atur destinasi ke form
    document.getElementById('form-destinasi').value = destinasi;
    document.getElementById('form-jumlah_tiket').value = jumlah_tiket;
    document.getElementById('form-tanggal_kunjungan').value = tanggal_kunjungan;
}
        
        function confirmOrder() {
            alert('Pemesanan berhasil! Silakan lakukan pembayaran sesuai dengan total yang tertera.');
            // Di sini bisa ditambahkan logika untuk mengirim data ke server
            window.location.reload();
        }
    </script> -->


</body>
</html>