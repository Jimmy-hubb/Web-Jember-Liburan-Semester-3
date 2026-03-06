<?php
session_start();
include 'db.php';

$error_message = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan peran
        if ($user['role'] == 'admin') {
            header("Location: dashboard2.php");
        } else {
            $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
            header("Location: $redirect");
        }
        exit();
    } else {
        $error_message = "Email atau password salah!";
    }
}

// Tampilkan notifikasi dari session
$notification_message = "";
if (isset($_SESSION['notification'])) {
    $notification_message = $_SESSION['notification'];
    unset($_SESSION['notification']); // Hapus pesan setelah ditampilkan
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-card {
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
            background-color: #e0f2f1;
            color: #004d40;
            border: 1px solid #4db6ac;
            border-radius: 10px;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 15px rgba(77, 182, 172, 0.8); /* Fokus warna hijau teal */
            outline: none;
        }

        .btn-login {
            background: linear-gradient(to right, #4db6ac, #b2dfdb); /* Gradien hijau teal dominan dan putih lembut */
            border: none;
            color: #004d40;
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #b2dfdb, #4db6ac);
            transform: translateY(-2px);
        }

        .link-group {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .register-link, .back-link, .forgot-link {
            color: #00796b; /* Hijau teal untuk teks tautan */
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .register-link:hover, .back-link:hover, .forgot-link:hover {
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
                  <!-- Notifikasi Alert -->
                <?php if (!empty($notification_message)): ?>
                    <div class="alert alert-info mt-4" role="alert">
                        <?php echo $notification_message; ?>
                    </div>
                <?php endif; ?>
                <div class="row login-card">
                    <div class="col-md-6 image-section">
                        <img src="blog-1.png" alt="Login Image">
                    </div>
                    <div class="col-md-6 form-section">
                        <h3 class="text-center">Login</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-login">Login</button>
                        </form>
                        <div class="link-group">
                            <a href="index.php" class="back-link">Back</a>
                            <a href="register.php" class="register-link">Register</a>
                            <a href="#" class="forgot-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                        </div>
                    </div>
                </div>
                
                <!-- Modal for Error Notification -->
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
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

                <!-- Modal for Forgot Password -->
                <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="forgotPasswordLabel">Forgot Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="forgot_password.php" method="post">
                                    <div class="mb-3">
                                        <label for="forgotEmail" class="form-label">Enter your email</label>
                                        <input type="email" class="form-control" id="forgotEmail" name="forgotEmail" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Verification Email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Tampilkan modal error jika ada pesan error
    <?php if (!empty($error_message)) : ?>
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {});
        errorModal.show();
    <?php endif; ?>
</script>

</body>

</html>