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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['Name'];
    $message = $_POST['Message'];

    // Handle file upload
    if (isset($_FILES["Img"]) && $_FILES["Img"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["Img"]["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check file size (limit to 10MB)
        if ($_FILES["Img"]["size"] > 10000000) {
            die("Sorry, your file is too large.");
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            die("Sorry, file already exists.");
        }

        // Try to upload file
        if (!move_uploaded_file($_FILES["Img"]["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO feed (name, message, img_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $message, $target_file);

        if ($stmt->execute()) {
            // Redirect to news.php
            header("Location: news.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No file was uploaded or there was an upload error.";
        // Add detailed error handling
        if (isset($_FILES["Img"]["error"])) {
            switch ($_FILES["Img"]["error"]) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Missing a temporary folder.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "A PHP extension stopped the file upload.";
                    break;
                default:
                    echo "Unknown upload error.";
                    break;
            }
        }
    }

    // Redirect to news.php after error handling
    header("Location: news.php");
    exit();
}

$conn->close();