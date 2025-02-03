<?php
// Retrieve form data
$Fullname = $_POST['fullname'] ?? null;
$Email = $_POST['email'] ?? null;
$Companyname = $_POST['companyname'] ?? null;
$Phone = $_POST['phone'] ?? null;
$NIN = $_POST['nin'] ?? null;
$Nationalid = null;
$Employmentnumber = $_POST['employmentnumber'] ?? null;
$Employmentid = null;
$Gender = $_POST['gender'] ?? null;
$Checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : 'No';



// Handling file uploads
$target_dir = "uploads/";
if (isset($_FILES["nationalid"]) && $_FILES["nationalid"]["error"] == UPLOAD_ERR_OK) {
    $Nationalid = $target_dir . basename($_FILES["nationalid"]["name"]);
    // Check if file is an actual image
    $checkNationalid = getimagesize($_FILES["nationalid"]["tmp_name"]);
    if ($checkNationalid === false) {
        die("National ID file is not an image.");
    }
    // Move the uploaded file to the uploads directory
    if (!move_uploaded_file($_FILES["nationalid"]["tmp_name"], $Nationalid)) {
        die("Sorry, there was an error uploading your national ID file.");
    }
} else {
    die("National ID file upload failed.");
}

if (isset($_FILES["employmentid"]) && $_FILES["employmentid"]["error"] == UPLOAD_ERR_OK) {
    $Employmentid = $target_dir . basename($_FILES["employmentid"]["name"]);
    // Check if file is an actual image
    $checkEmploymentid = getimagesize($_FILES["employmentid"]["tmp_name"]);
    if ($checkEmploymentid === false) {
        die("Employment ID file is not an image.");
    }
    // Move the uploaded file to the uploads directory
    if (!move_uploaded_file($_FILES["employmentid"]["tmp_name"], $Employmentid)) {
        die("Sorry, there was an error uploading your employment ID file.");
    }
} else {
    die("Employment ID file upload failed.");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'membership');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO register (Fullname, Email, Companyname, Phone, NIN, Nationalid, Employmentnumber, Employmentid, Gender, Checkbox) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssissssss", $Fullname, $Email, $Companyname, $Phone, $NIN, $Nationalid, $Employmentnumber, $Employmentid, $Gender, $Checkbox);

if ($stmt->execute()) {
    echo "<script>
    alert('Thank you for submitting your application. We appreciate your patience as we review your information. We will be in touch with you soon.');
    window.location.href = 'membership.php';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>