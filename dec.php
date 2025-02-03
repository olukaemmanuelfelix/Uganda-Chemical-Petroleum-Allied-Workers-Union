<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'membership');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Get the email of the user to notify
    $query = "SELECT Email FROM register WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $email = $row['Email'];

    // SQL to delete the record (i.e., decline the application)
    $deleteQuery = "DELETE FROM register WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();

    // Now send the email notification about the decline
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'oluukaemmanuelfelix@gmail.com';         //SMTP username
        $mail->Password   = 'Uganda@2020';                           //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to

        //Recipients
        $mail->setFrom('oluukaemmanuelfelix@gmail.com', 'Lazo Tech');
        $mail->addAddress($email);     // Add the user's email address as the recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Application Status';
        $mail->Body    = 'Dear User,<br><br>Unfortunately, your application has been declined.<br><br>Regards,<br>Lazo Tech Team';
        $mail->AltBody = 'Dear User, Unfortunately, your application has been declined. Regards, Lazo Tech Team';

        // Send email
        $mail->send();

        // Success message
        echo "<script>
        alert('Application has been declined and the user has been notified.');
        window.location.href = 'admin_page.php'; 
    </script>";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No ID provided.";
}

$query = "SELECT Email FROM register WHERE id = ?";

?>
