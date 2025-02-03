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
            <li class="nav-item"><a href="admin_page.php" class="nav-link">APPLICATIONS</a></li>
            <li class="nav-item"><a href="approve.php" class="nav-link">APPROVED</a></li>
                <li class="nav-item"><a href="news.php" class="nav-link">NEWS FEED</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">LOG OUT</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-3" style="text-shadow: 1px 1px 2px #0b0c0b;">News Feed Form</h3>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="Name" required class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Message:</label>
                    <textarea name="Message" required class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image:</label>
                    <input type="file" name="Img" required class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch data from database
                $sql = "SELECT id, name, message, img_path FROM feed";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["message"] . "</td>";
                        echo "<td><img src='" . $row["img_path"] . "' alt='Image' style='width: 100px;'></td>";
                        echo "<td>
                        <a href='edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>
                         <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>