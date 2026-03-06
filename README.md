# 🌐 Si Jeli – Jember Liburan Web

**Si Jeli (Sistem Informasi Jelajah Liburan Jember)** merupakan aplikasi **berbasis web** yang dikembangkan untuk membantu pengguna menemukan berbagai destinasi wisata di Kabupaten Jember serta melakukan pemesanan layanan wisata secara online.

Aplikasi ini menyediakan informasi mengenai berbagai **destinasi wisata, paket liburan, serta sistem pemesanan** yang dapat dilakukan langsung melalui website.

Selain itu, sistem ini juga dilengkapi dengan **panel admin** yang memungkinkan pengelola untuk mengatur data wisata, mengelola pesanan pengguna, serta melihat riwayat transaksi.

Project ini dikembangkan sebagai bagian dari **portfolio pengembangan web developer** serta pembelajaran dalam membangun aplikasi berbasis **PHP dan MySQL**.

---

# 🚀 Features

Beberapa fitur utama dalam aplikasi **Si Jeli Jember Liburan Web** antara lain:

### 🏝️ Daftar Destinasi Wisata
Menampilkan berbagai destinasi wisata di Kabupaten Jember lengkap dengan informasi dan gambar.

### 📄 Detail Wisata
Pengguna dapat melihat detail informasi wisata seperti:
- Nama tempat wisata
- Deskripsi tempat
- Gambar destinasi
- Informasi tambahan mengenai wisata

### 🛒 Sistem Pemesanan
Pengguna dapat melakukan pemesanan layanan wisata atau paket liburan secara online.

### 📑 Riwayat Pesanan
Pengguna dapat melihat **history pemesanan** yang telah dilakukan sebelumnya.

### 🔐 Login Admin
Admin dapat masuk ke dalam sistem melalui halaman login khusus.

### ⚙️ Manajemen Admin
Admin dapat mengelola berbagai data seperti:

- Mengelola data wisata
- Mengelola pesanan pengguna
- Melihat riwayat transaksi
- Mengelola data pengguna

### 📱 Responsive Design
Website dapat diakses dengan baik melalui **desktop maupun perangkat mobile**.

---

# 🛠 Tech Stack

Teknologi yang digunakan dalam pengembangan aplikasi ini:

| Technology | Description |
|-----------|-------------|
| HTML5 | Struktur halaman website |
| CSS3 | Styling dan desain tampilan |
| PHP | Bahasa pemrograman backend |
| MySQL | Database management system |
| JavaScript | Interaksi pada website |
| Bootstrap (Optional) | Framework UI |

---

# ⚙️ Installation

Ikuti langkah berikut untuk menjalankan project secara lokal.

### 1. Clone Repository

```bash
git clone https://github.com/username/si-jeli-jember-liburan-web.git
```

### 2. Masuk ke Folder Project

```bash
cd si-jeli-jember-liburan-web
```

### 3. Pindahkan ke Folder Server

Jika menggunakan **Laragon / XAMPP / WAMP**, pindahkan folder project ke:

```
htdocs
```

Contoh:

```
C:\laragon\www\
```

atau

```
C:\xampp\htdocs\
```

---

### 4. Import Database

1. Buka **phpMyAdmin**
2. Buat database baru

```
sijeli_db
```

3. Import file database:

```
database.sql
```

---

### 5. Konfigurasi Database

Buka file:

```
config/database.php
```

Lalu ubah konfigurasi sesuai dengan database lokal.

Contoh:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "sijeli_db";
```

---

### 6. Jalankan Website

Buka browser dan akses:

```
http://localhost/si-jeli-jember-liburan-web
```

---

# 🔑 Admin Access

Untuk masuk ke halaman admin:

```
http://localhost/si-jeli-jember-liburan-web/admin
```

Contoh login admin:

```
Username : admin
Password : admin123
```

---

# 📸 Application Preview

![alt text](https://github.com/Jimmy-hubb/Web-Jember-Liburan-Semester-3/blob/main/pages/WhatsApp%20Image%202026-03-02%20at%2020.05.45.jpeg?raw=true)

![alt text](https://github.com/Jimmy-hubb/Web-Jember-Liburan-Semester-3/blob/main/pages/Screenshot%202026-03-06%20162555.png?raw=true)

---

# 🎯 Project Goals

Tujuan utama dari pengembangan aplikasi ini:

- Menyediakan informasi wisata di Kabupaten Jember secara digital
- Mempermudah pengguna dalam melakukan pemesanan layanan wisata
- Membantu admin dalam mengelola data wisata dan pesanan
- Mengembangkan keterampilan dalam pengembangan aplikasi web berbasis PHP
