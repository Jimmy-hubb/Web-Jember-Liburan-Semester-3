<?php
include 'db.php';

$error_message = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'pembeli';

    // Cek apakah email sudah ada
    $check_stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Email sudah terdaftar!";
    } else {
        // Insert dengan kolom username
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $error_message = "Gagal register, coba lagi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom right, #4db6ac, #e0f2f1); /* Gradien hijau teal dominan dan putih lembut */
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
    }

    .register-card {
        background-color: #e0f2f1; /* Hijau teal sangat terang untuk container */
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        color: #004d40;
    }

    .form-section {
        padding: 2rem;
    }

    .form-control {
        background-color: #e0f2f1; /* Latar belakang input hijau teal sangat terang */
        color: #004d40; /* Teks input hijau teal gelap */
        border: 1px solid #4db6ac;
        border-radius: 10px;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 15px rgba(77, 182, 172, 0.8); /* Fokus warna hijau teal */
        outline: none;
    }

    .btn-register {
        background: linear-gradient(to right, #4db6ac, #b2dfdb); /* Gradien hijau teal dominan dan putih lembut */
        border: none;
        color: #004d40;
        padding: 0.75rem;
        border-radius: 10px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-register:hover {
        background: linear-gradient(to right, #b2dfdb, #4db6ac);
        transform: translateY(-2px);
    }

    .login-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: #00796b; /* Hijau teal untuk teks tautan */
        text-decoration: none;
        font-size: 1rem;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .login-link:hover {
        color: #004d40;
        text-decoration: underline;
    }

    .image-section img {
        width: 100%;
        border-radius: 15px;
    }

    /* Modal style adjustments for teal and white theme */
    .modal-content {
        background-color: #b2dfdb; /* Warna dominan hijau teal */
        color: #004d40;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        border-top: none;
    }

    .btn-primary {
        background-color: #4db6ac;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #80cbc4; /* Warna hijau teal lebih terang untuk hover */
    }
</style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row register-card">
                    <div class="col-md-6 image-section">
                        <img src="hero-img-1.png" alt="Register Image">
                    </div>
                    <div class="col-md-6 form-section">
                        <h3 class="text-center">Register</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-register">Register</button>
                            <a href="login.php" class="login-link">Already have an account? Login</a>
                        </form>
                    </div>
                </div>

                <!-- Modal for Error Notification -->
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="errorModalLabel">Registration Error</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php if (!empty($error_message)) echo $error_message; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show error modal if there's an error message
        <?php if (!empty($error_message)) : ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {});
            errorModal.show();
        <?php endif; ?>
    </script>
</body>

</html>
