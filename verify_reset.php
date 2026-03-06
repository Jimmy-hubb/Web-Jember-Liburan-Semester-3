<?php
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

$successMessage = $errorMessage = ""; // Variabel untuk menyimpan pesan

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Periksa apakah token ada dan masih berlaku
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Token valid, tampilkan form ganti password
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // Update password baru dan hapus token
            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
            $stmt->bind_param("si", $new_password, $user['id']);
            $stmt->execute();

            $successMessage = "Password successfully reset!";
        }
    } else {
        $errorMessage = "Invalid or expired token!";
    }
}
?>

<!-- Form Ganti Password -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f2f1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .title {
            font-size: 36px;
            font-weight: bold;
            color: #00796b;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #00796b;
            margin-bottom: 20px;
        }
        .btn-teal {
            background-color: #00796b;
            color: #ffffff;
            border: none;
        }
        .btn-teal:hover {
            background-color: #004d40;
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="title">SiJeli</div>
    <div class="container">
        <h2>Reset Your Password</h2>
        <form action="" method="post">
            <div class="mb-3 input-group">
                <label for="new_password" class="form-label d-block w-100 text-start">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <span class="input-group-text" onclick="togglePassword()">
                    👁️
                </span>
            </div>
            <button type="submit" class="btn btn-teal w-100">Reset Password</button>
        </form>
    </div>

    <!-- Modal Pop-up -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($successMessage) {
                        echo "<div class='alert alert-success'>$successMessage</div>";
                    } elseif ($errorMessage) {
                        echo "<div class='alert alert-danger'>$errorMessage</div>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("new_password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        // Tampilkan modal jika ada pesan
        <?php if ($successMessage || $errorMessage): ?>
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
