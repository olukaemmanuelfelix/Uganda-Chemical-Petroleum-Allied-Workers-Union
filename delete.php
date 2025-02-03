<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "membership";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the file path from the database
    $stmt = $conn->prepare("SELECT img_path FROM feed WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($img_path);
    $stmt->fetch();
    $stmt->close();

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM feed WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // If the record was deleted successfully, delete the file
        if (file_exists($img_path)) {
            unlink($img_path);
        }
        echo "Record and file deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the main page
header("Location: news.php");
exit();
?>