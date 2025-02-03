<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'membership');
$query = "SELECT * FROM register"; // select from the db table
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .TopNav {
            background-color: black;
            color: white;
            padding: 5px;
            text-align: center;
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
            font-size: 1rem;
        }
        .logo {
            height: 75px;
            width: 75px;
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
                <h2 class="mb-0">Uganda Chemical Petroleum & Allied Workers Union</h2>
            </div>
            <ul class="nav">
            <li class="nav-item"><a href="admin_page.php" class="nav-link">APPLICATIONS</a></li>
            <li class="nav-item"><a href="approve.php" class="nav-link">APPROVED</a></li>
                <li class="nav-item"><a href="news.php" class="nav-link">NEWS FEED</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">LOG OUT</a></li>
            </ul>
        </div>
    </div>

<br>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Company Name</th>
            <th>Telephone</th>
            <th>NIN</th>
            <th>National ID</th>
            <th>Employee NO.</th>
            <th>Employee ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Fullname']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Companyname']; ?></td>
            <td><?php echo $row['Phone']; ?></td>
            <td><?php echo $row['NIN']; ?></td>
            <td>
                <img src="<?php echo $row['Nationalid']; ?>" alt="National ID" class="clickable-image" style="width: 50px; height: auto; cursor: pointer;">
            </td>
            <td><?php echo $row['Employmentnumber']; ?></td>
            <td>
                <img src="<?php echo $row['Employmentid']; ?>" alt="Employment ID" class="clickable-image" style="width: 50px; height: auto; cursor: pointer;">
            </td>
            <td class="p-3">
                <div class="d-flex justify-content-between">
                <a href="approve.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Approve</a>
                    <a href="decline.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Decline</a>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="modalImage" class="img-fluid" alt="Preview Image">
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.clickable-image').forEach(image => {
        image.addEventListener('click', () => {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = image.src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        });
    });
</script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>