<?php
include 'db.php';

if(isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];

    switch($aksi) {
        case 'add':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                    die("Username, email, dan password harus diisi!");
                }

                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    die("Format email tidak valid!");
                }

                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR username = ?");
                $stmt->execute([$email, $username]);
                if($stmt->fetchColumn() > 0) {
                    die("Email atau username sudah terdaftar!");
                }

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $role = $_POST['role'];
                
                try {
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$username, $email, $password, $role]);
                    header('Location: dashboard2.php?status=success&message=Data berhasil ditambahkan');
                    exit;
                } catch(PDOException $e) {
                    header('Location: dashboard2.php?status=error&message=Gagal menambahkan data');
                    exit;
                }
            }
            break;

        case 'edit':
            if(isset($_GET['id'])) {
                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                
                try {
                    $stmt = $pdo->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
                    $stmt->execute([$id]);
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($data) {
                        echo json_encode($data);
                    } else {
                        echo json_encode(['error' => 'Data tidak ditemukan']);
                    }
                } catch(PDOException $e) {
                    echo json_encode(['error' => 'Terjadi kesalahan']);
                }
                exit;
            }
            break;

        case 'update':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $role = $_POST['role'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(['error' => 'Format email tidak valid']);
                    exit;
                }

                try {
                    if (!empty($_POST['password'])) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id = ?");
                        $stmt->execute([$username, $email, $password, $role, $id]);
                    } else {
                        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
                        $stmt->execute([$username, $email, $role, $id]);
                    }
                    echo json_encode(['success' => 'Data berhasil diupdate']);
                } catch(PDOException $e) {
                    echo json_encode(['error' => 'Gagal mengupdate data']);
                }
                exit;
            }
            break;

        case 'delete':
            if(isset($_GET['id'])) {
                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                
                try {
                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role='admin'");
                    $stmt->execute([$id]);
                    header('Location: dashboard2.php?status=success&message=Data berhasil dihapus');
                    exit;
                } catch(PDOException $e) {
                    header('Location: dashboard2.php?status=error&message=Gagal menghapus data');
                    exit;
                }
            }
            break;

        default:
            header('Location: dashboard2.php');
            exit;
    }
} else {
    header('Location: dashboard2.php');
    exit;
}
?>
