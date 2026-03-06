<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // atau path ke PHPMailer jika manual

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    $mail = new PHPMailer(true);
    
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fhanwam@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'bbqa pnvt fniz phts'; // Ganti dengan password email Anda atau App Password jika 2FA aktif
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan Email
        $mail->setFrom($email, $name);
        $mail->addAddress('fhanwam@gmail.com'); // Alamat penerima
        $mail->addReplyTo($email, $name);

        // Konten Email
        $mail->isHTML(true);
        $mail->Subject = "Contact Us Form: $subject";
        $mail->Body    = "Anda menerima pesan baru dari form kontak di website Si Jeli.<br><br>" .
                         "Detail Pesan:<br>" .
                         "Nama: $name<br>" .
                         "Email: $email<br>" .
                         "Subjek: $subject<br>" .
                         "Pesan:<br>" . nl2br($message);

        $mail->send();
        echo "Pesan Anda berhasil dikirim.";
    } catch (Exception $e) {
        echo "Maaf, terjadi masalah saat mengirim pesan Anda. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Metode pengiriman data tidak valid.";
}
?>
