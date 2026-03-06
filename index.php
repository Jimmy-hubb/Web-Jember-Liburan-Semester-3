<?php
session_start();
include('db.php'); // Menyertakan file koneksi database

// Ambil data wisata populer menggunakan PDO
$queryWisata = "SELECT * FROM wisata WHERE populer = 1";
$stmtWisata = $pdo->prepare($queryWisata);
$stmtWisata->execute();
$destinasiWisata = $stmtWisata->fetchAll(PDO::FETCH_ASSOC);

// Ambil total jumlah pengguna
$queryUsers = "SELECT COUNT(*) AS total_users FROM users";
$stmtUsers = $pdo->prepare($queryUsers);
$stmtUsers->execute();
$totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liburin Aja - Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
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
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
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
            color: var(--primary-color);
        }

        /* Hero Section Styles */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Make sure video stays behind content */
        }

        .hero-content {
            position: relative;
            z-index: 1; /* Keep the text above the video */
            max-width: 800px;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 0.5s;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 0.7s;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards 0.9s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Covid Data Section Styles */
        .covid-data {
            padding: 4rem 0;
            background-color: #fff;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color:black;
            margin-bottom: 0.5rem;
        }

        .covid-cards {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .covid-card {
            flex-basis: calc(25% - 1rem);
            background-color: #009ee5;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .covid-card:hover {
            transform: translateY(-5px);
        }

        .covid-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .covid-card p {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
        }

        /* Popular Destinations Styles */
        .popular-destinations {
            padding: 4rem 0;
            background-color: #f9f9f9;
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .destination-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .destination-card:hover {
            transform: translateY(-5px);
        }

        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .destination-info {
            padding: 1.5rem;
        }

        .destination-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #009ee5;
        }

        .destination-info p {
            margin-bottom: 1rem;
            color: #333;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: #fff;
            padding: 3rem 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-section {
            flex-basis: calc(33.333% - 2rem);
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .footer-section p {
            margin-bottom: 1rem;
        }

        .social-icons a {
            color: #fff;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }


        .swal2-confirm {
            margin-right: 10px; /* Menambahkan jarak antara tombol "Login" dan "Batal" */
        }



        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Animations */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .covid-card {
                flex-basis: calc(50% - 1rem);
            }

            .footer-section {
                flex-basis: 100%;
            }
            .logout-link {
             margin-left: auto; /* Posisikan logout di kanan */
            }
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
                    <li><a href="destinasi-jabar.php">Daftar Wisata</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                    <div class="logout-link">
                        <li><a href="logout.php">Logout</a></li>
                    </div>
                <?php else: ?>
                    <li><a href="#" onclick="checkLogin()">Pesan Tiket</a></li>
                    <li><a href="destinasi-jabar.php">Daftar Wisata</a></li>
                    <li><a href="contact_us.php">Contact</a></li>
                <?php endif; ?>
            </ul>


        </nav>
    </header>

    <main>
        <section class="hero">
            <!-- Video Background -->
            <video autoplay muted loop>
                <source src="tes.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="hero-content">
                <h1>Jelajahi Keindahan Jember</h1>
                <p>Platform Pemesanan Tiket Wisata Di Daerah Jember Yang Mana Juga Menyediakan Detail-Detail Wisata Di Jember</p>
                <a href="#destinasi" class="btn">Mulai Menjelajah</a>
            </div>
        </section>

        <section class="covid-data">
    <div class="container">
        <div class="section-title">
            <h2>Data Tentang Jeli</h2>
        </div>
        <div class="covid-cards">
            <div class="covid-card">
                <h3>Total Pemesanan</h3>
                <p id="positif">0</p>
            </div>
            <div class="covid-card">
                <h3>Total Akun User</h3>
                <p id="sembuh"><?php echo htmlspecialchars($totalUsers); ?></p>
            </div>
            <div class="covid-card">
                <h3>Total Tiket Yang Berhasil</h3>
                <p id="meninggal">0</p>
            </div>
            <div class="covid-card">
                <h3>Total Tiket Yang Dikembalikan</h3>
                <p id="dirawat">0</p>
            </div>
        </div>
    </div>
</section>


        <section class="popular-destinations" id="destinasi">
            <div class="container">
                <div class="section-title">
                    <h2>Destinasi Populer</h2>
                </div>
                <div class="destinations-grid">
                    <?php foreach ($destinasiWisata as $row): ?>
                        <div class="destination-card">
                            <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_wisata']); ?>">
                            <div class="destination-info">
                                <h3><?php echo htmlspecialchars($row['nama_wisata']); ?></h3>
                                <p><?php echo htmlspecialchars($row['alamat_wisata']); ?></p>
                                <p><?php echo htmlspecialchars($row['deskripsi_wisata']); ?></p>
                                <a href="#" class="btn">Baca lebih lanjut</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p>Platform wisata dan komunitas dengan beragam tips liburan, dan kuliner sepulau jawa. Jangan lupa Subscribe & Like agar kamu terupdate. Jangan Lupa Liburan!</p>
                </div>
                <div class="footer-section">
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="#">Tips</a></li>
                        <li><a href="#">Daftar Wisata</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Ikuti Kami</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/lutdaahm_"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Liburin Aja. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Sticky header
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            header.classList.toggle('sticky', window.scrollY > 0);
        });

        // Fetch and display COVID-19 data
        async function fetchCovidData() {
            try {
                const response = await fetch('https://api.kawalcorona.com/indonesia/');
                const data = await response.json();
                document.getElementById('positif').textContent = data[0].positif;
                document.getElementById('sembuh').textContent = data[0].sembuh;
                document.getElementById('meninggal').textContent = data[0].meninggal;
                document.getElementById('dirawat').textContent = data[0].dirawat;
            } catch (error) {
                console.error('Error fetching COVID-19 data:', error);
            }
        }

        // Call fetchCovidData function when the page loads
        window.addEventListener('load', fetchCovidData);
    </script>

    <script>
       function checkLogin() {
    // Cek apakah pengguna sudah login
    var loggedIn = "<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'true' : 'false'; ?>";

    if (loggedIn === 'false') {
        // Menampilkan SweetAlert2 dengan tombol Cancel dan Konfirmasi
        Swal.fire({
            title: 'Anda belum login!',
            text: 'Anda harus login terlebih dahulu untuk memesan tiket!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'swal2-confirm btn btn-primary',
                cancelButton: 'swal2-cancel btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman login dengan parameter redirect
                window.location.href = "login.php?redirect=index.php";
            }
        });
    }
}


    </script>
</body>
</html>