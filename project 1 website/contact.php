<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Send the email using PHPMailer
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPmailer/SMTP.php';

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                       // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;              // Enable SMTP authentication
        $mail->Username   = 'ashimp355@gmail.com'; // SMTP username
        $mail->Password   = 'cwlhukzergplxhpb'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port       = 465;              // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('ashimp355@gmail.com', 'Contact Form');
        $mail->addAddress('ashimp355@gmail.com', 'Recipient');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Test Content Form';
        $mail->Body = "Sender Name - $name <br> Sender Email - $email <br> Sender Message - $message";

        $mail->send(); // Send the email

        // Email sent successfully, now insert data into the database
        $conn = new mysqli('localhost', 'root', '', 'website');
        if ($conn->connect_error) {
            echo "$conn->connect_error";
            die("Connection Failed: " . $conn->connect_error);
        } else {
            // Insert data into the database
            $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);
            $execval = $stmt->execute();
            $stmt->close();
            $conn->close();
        }

        echo 'Message has been sent and data inserted into the database successfully.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
