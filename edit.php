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
    $id = $_POST['id'];
    $name = $_POST['Name'];
    $message = $_POST['Message'];
    $target_file = null;

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
    }

    // Update data in database
    if ($target_file) {
        $stmt = $conn->prepare("UPDATE feed SET name = ?, message = ?, img_path = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $message, $target_file, $id);
    } else {
        $stmt = $conn->prepare("UPDATE feed SET name = ?, message = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $message, $id);
    }

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: news.php"); // Redirect to the main page after updating
    exit();
} else {
    // Fetch existing data
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT name, message, img_path FROM feed WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name, $message, $img_path);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .TopNav {
            background-color: black;
            color: white;
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .TopNav .s {
            color: white;
            margin: 0 10px;
            font-size: 0.9rem;
        }
        .TopNav .icons i {
            color: black;
            background-color: white;
            border-radius: 50%;
            padding: 5px;
            margin: 0 3px;
            font-size: 0.8rem;
        }
        .NavContainer {
            background-color: navy;
            color: white;
            padding: 10px;
        }
        .nav-link {
            color: white !important;
        }
        .LogoContainer h2 {
            font-size: 1.5rem;
        }
        .logo {
            height: 70px;
            width: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="TopNav d-flex justify-content-between align-items-center px-6">
        <div class="d-flex align-items-center">
            <div class="s">Kiitia Jokolera, Kitezi</div>
            <div class="s">ugandachemicalpetroleumalliedw@gmail.com</div>
            <div class="s">+256 700965425</div>
        </div>
        <div class="d-flex">
            <div class="icons"><i class="fa-brands fa-twitter"></i></div>
            <div class="icons"><i class="fa-brands fa-facebook"></i></div>
            <div class="icons"><i class="fa-brands fa-linkedin"></i></div>
            <div class="icons"><i class="fa-brands fa-instagram"></i></div>
            <div class="icons"><i class="fa-brands fa-whatsapp"></i></div>
        </div>
    </div>

    <div class="NavContainer shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <div class="LogoContainer d-flex align-items-center">
                <img src="media/WhatsApp Image 2024-12-17 at 4.50.45 PM.jpeg" alt="" class="logo me-2">
                <h2 class="mb-0">Uganda Chemical Petroleum <br>& Allied Workers Union</h2>
            </div>
            <ul class="nav">
                <li class="nav-item"><a href="news.php" class="nav-link">NEWS FEED</a></li>
                <li class="nav-item"><a href="admin_page.php" class="nav-link">PENDING</a></li>
                <li class="nav-item"><a href="approved.php" class="nav-link">APPROVED</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">LOG OUT</a></li>
            </ul>
        </div>
    </div>
    <br>
<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-3" style="text-shadow: 1px 1px 2px #0b0c0b;">Edit News Feed</h3>
        <form action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label class="form-label">Title:</label>
                <input type="text" name="Name" required class="form-control" value="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Message:</label>
                <textarea name="Message" required class="form-control" rows="4"><?php echo htmlspecialchars($message); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image:</label><br>
                <img src="<?php echo $img_path; ?>" alt="Image" style="width: 100px;"><br><br>
                <label class="form-label">New Image (optional):</label>
                <input type="file" name="Img" class="form-control" placeholder="Choose a new image...">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>