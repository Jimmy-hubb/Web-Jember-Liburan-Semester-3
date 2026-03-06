<?php
require_once 'db.php';

try {
    $query = "SELECT * FROM wisata"; // Tabel Anda
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $query .= " WHERE nama_wisata LIKE :search OR alamat_wisata LIKE :search";
    }

    $stmt = $pdo->prepare($query);

    if (isset($search)) {
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result); // Return JSON untuk digunakan oleh AJAX
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
