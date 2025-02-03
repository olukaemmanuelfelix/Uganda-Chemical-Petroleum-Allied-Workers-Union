<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'membership');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record to get file paths and email
    $stmt = $conn->prepare("SELECT Nationalid, Employmentid, Email FROM register WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nationalIdPath, $employmentIdPath, $email);
    $stmt->fetch();
    $stmt->close();

    // Delete files from the uploads directory
    if (file_exists($nationalIdPath)) {
        unlink($nationalIdPath);
    }
    if (file_exists($employmentIdPath)) {
        unlink($employmentIdPath);
    }

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM register WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Send email notification using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'oluukaemmanuelfelix@gmail.com'; // Your Gmail address
        $mail->Password = 'ixnr icnb yhal vyyw'; // Your Gmail smtp app password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('oluukaemmanuelfelix@gmail.com', 'Uganda Chemical Petroleum & Allied Workers Union');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Application Declined';
        $mail->Body    = 'Dear Applicant,<br><br>We regret to inform you that your application has been declined.<br><br>Best regards,<br>Uganda Chemical Petroleum & Allied Workers Union';
        $mail->AltBody = 'Dear Applicant,\n\nWe regret to inform you that your application has been declined.\n\nBest regards,\nUganda Chemical Petroleum & Allied Workers Union';

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect to the main page
    header("Location: admin_page.php");
    exit();
} else {
    echo "Invalid request.";
}

$conn->close();
?>