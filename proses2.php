<?php
include 'db.php';

$aksi = $_GET['aksi'] ?? '';
if ($aksi == 'tambah_wisata') {
    $nama_wisata = $_POST['nama_wisata'];
    $alamat_wisata = $_POST['alamat_wisata'];
    $deskripsi_wisata = $_POST['deskripsi_wisata'];
    $operasional = $_POST['operasional'];
    $harga_tiket = $_POST['harga_tiket'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO wisata (nama_wisata, alamat_wisata, deskripsi_wisata, operasional, harga_tiket, gambar) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nama_wisata, $alamat_wisata, $deskripsi_wisata, $operasional, $harga_tiket, $gambar]);
        header("Location: daftar_wisata.php");
    } else {
        echo "Error uploading file.";
    }
} elseif ($aksi == 'edit_data_wisata') {
    // Handle fetch single wisata data for editing
    $id = $_GET['id'];
    $query = "SELECT * FROM wisata WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch());

} elseif ($aksi == 'update_wisata') {
    $id = $_POST['id'];
    $nama_wisata = $_POST['nama_wisata'];
    $alamat_wisata = $_POST['alamat_wisata'];
    $deskripsi_wisata = $_POST['deskripsi_wisata'];
    $operasional = $_POST['operasional'];
    $harga_tiket = $_POST['harga_tiket'];
    $gambar = $_FILES['gambar']['name'];

    $target_dir = "uploads/";
    $update_query = "UPDATE wisata SET nama_wisata = ?, alamat_wisata = ?, deskripsi_wisata = ?, operasional = ?, harga_tiket = ?";
    $params = [$nama_wisata, $alamat_wisata, $deskripsi_wisata, $operasional, $harga_tiket];

    // Jika ada gambar baru, maka update juga gambar
    if ($gambar) {
        $target_file = $target_dir . basename($gambar);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $update_query .= ", gambar = ?";
            $params[] = $gambar;
        }
    }
    $update_query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($update_query);
    $stmt->execute($params);

    echo "1"; // Pastikan tidak ada karakter tambahan setelah ini
    exit;
} elseif ($aksi == 'delete_wisata') {
    // Handle delete wisata
    $id = $_GET['id'];
    
    // Optionally delete the image file from the server
    $query = "SELECT gambar FROM wisata WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    if ($result && $result['gambar'] && file_exists("uploads/" . $result['gambar'])) {
        unlink("uploads/" . $result['gambar']);
    }

    // Delete the record from the database
    $query = "DELETE FROM wisata WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    header("Location: daftar_wisata.php");
}
?>
