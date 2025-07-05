<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    // Gmail credentials
    $gmailUser = 'techpioneers25@gmail.com';      // 🔁 Replace with your Gmail
    $gmailPass = 'nmus wxsb uwvh hxqi';          // 🔁 Use Gmail App Password

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $package = htmlspecialchars($_POST['package']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    $consent = isset($_POST['consent']) ? 'Yes' : 'No';

    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $gmailUser;
        $mail->Password = $gmailPass;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email content
        $mail->setFrom($gmailUser, 'Tech Pioneers');
        $mail->addAddress('techpioneers25@gmail.com'); // 🔁 Receiver email

        $mail->Subject = "New Inquiry from $name";
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nPackage: $package\nConsent: $consent\n\nMessage:\n$message";

        $mail->send();
        echo "<script>alert('✅ Message sent successfully!'); window.history.back();</script>";
    } catch (Exception $e) {
        echo "<script>alert('❌ Failed to send message: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
} else {
    echo "Invalid request.";
}
?>
