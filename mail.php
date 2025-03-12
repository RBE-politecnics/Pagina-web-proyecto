<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Get data from form
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$computers = $_POST['computers'];
$connection = $_POST['connection'];
$rooms = $_POST['rooms'];
$message = $_POST['message'];

// Preparing mail content
$messagecontent = "
    <h2>New Incident Report</h2>
    <p><strong>Name:</strong> $name $lastname</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Number of Computers:</strong> $computers</p>
    <p><strong>Connection Type:</strong> $connection</p>
    <p><strong>Number of Rooms:</strong> $rooms</p>
    <p><strong>Comments:</strong> $message</p>
";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'live.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'api';
    $mail->Password = '9191483f4c336e9a605153ee24d25324';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('hi@demomailtrap.co', 'Incident Report');
    $mail->addAddress('rburnate2324@politecnics.barcelona', 'Administrator');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Incident Report';
    $mail->Body = $messagecontent;

    $mail->send();
    echo '<script>
            alert("Message has been sent successfully!");
            window.location.href = "Index.html";
          </script>';
} catch (Exception $e) {
    echo '<script>
            alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");
            window.location.href = "Index.html";
          </script>';
}
?>