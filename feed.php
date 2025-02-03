<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<style>
        .feed_sec {
            padding: 10px;
            margin: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 500px;
        }

        .feed_msec {
            display: flex;
            overflow-x: auto;
            padding: 20px;
        }

        .tit {
            text-align: center;
            color: blue;
            margin-top: 10px;
        }

        .feed_img {
            width: 13cm;
            height: 13cm;
        }

        .read-more-btn {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .message {
            display: none;
        }
    </style>
<div class="NavLinks2">
        <ul class="NavLink">
            <div class="s">kiitia Jokolera, kitezi</div>
            <div class="s">ugandachemicalpetroleumalliedw@gmail.com</div>
            <div class="s">+256 700965425</div> 
            <div class="m"></div> 
        </ul>
        <div class="sep">
        <div class="icons">
        <i class="fa-brands fa-twitter"></i>
        </div>
        <div class="icons">
        <i class="fa-brands fa-facebook"></i>
        </div>
        <div class="icons">
        <i class="fa-brands fa-linkedin"></i>
        </div>
        <div class="icons">
        <i class="fa-brands fa-instagram"></i>
        </div>
        <div class="icons">
        <i class="fa-brands fa-whatsapp"></i>
        </div>
    </div>
     </div>
<div class="NavContainer">
 <div class="LogoContainer">
    <img src="media/WhatsApp Image 2024-12-17 at 4.50.45 PM.jpeg" alt="" class="logo">
    <h2>Uganda Chemical <br>
        Petroleum & Allied 
        <br>Workers Union</h2>
 </div>
 
 <div class="NavLinks">
    <ul class="NavLinks">
        <li><a href="index.html" class="k">HOME</a></li>
        <li><a href="feed.html" class="w">NEWS FEED</a></li>
        <li><a href="contact_us.html" class="e">CONTACT US</a></li>
        <li><a href="structure.html" class="e">STRUCTURE</a></li>
        <li><a href="" class="y"></a></li>
        <li><a href="membership.html" class="r">MEMBERSHIP</a></li>
    </ul>
 </div>

 <ul class="dropdown_menu ">
    <li><a href="#home" class="k">Home</a></li>
    <li><a href="#about" class="w">About us</a></li>
    <li><a href="#services" class="e">Services</a></li>
    <li><a href="#hire" class="r">Membership</a></li>
</ul>

 <div class="MenueToggle" id="menu">
    <i class="fa-solid fa-bars"></i>
 </div>
</div>

<div class="fee">
    <p class="fe">News Feed</p>
</div>

<div class="feed_msec">
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
            echo "<div class='feed_sec'>";
            echo "<img src='" . $row["img_path"] . "' alt='Image' class='feed_img'>";
            echo "<h3 class='tit'>" . htmlspecialchars($row["name"]) . "</h3>";
            echo "<p class='message'>" . htmlspecialchars($row["message"]) . "</p>";
            echo "<button class='read-more-btn'>Read More</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No records found</p>";
    }

    $conn->close();
    ?>
</div>
    <script>
        document.querySelectorAll('.read-more-btn').forEach(button => {
            button.addEventListener('click', () => {
                const message = button.previousElementSibling;
                if (message.style.display === 'none' || message.style.display === '') {
                    message.style.display = 'block';
                    button.textContent = 'Read Less';
                } else {
                    message.style.display = 'none';
                    button.textContent = 'Read More';
                }
            });
        });
    </script>

<footer class="quicks">
   <div class="q_links">
    <h4>Quick links</h4>
    <p class="tol"></p>
    <a href=""><p>Home</p></a>
    <a href=""><p>News Feed</p></a>
    <a href=""><p>Contact Us</p></a>
    <a href=""><p>Membership</p></a>
   </div>


   <div class="q_social">
    <h4>Social Media</h4>
    <p class="tol"></p>
    <a href=""><p>Facebook</p></a>
    <a href=""><p>Linkedin</p></a>
    <a href=""><p>X (former twitter)</p></a>
    <a href=""><p>Instagram</p></a>
   </div>


   <div class="q_contact">
    <h4>Contact Details</h4>
    <p class="tol"></p>
    <a href=""><p>86589349392</p></a>
    <a href=""><p>9846899</p></a>
    <a href=""><p>workers@info.com</p></a>
    <a href=""><p>gdklkflgjl</p></a>
   </div>
</footer>

<footer>
    <p class="foot"> Copy Right &copy; 2024 </p>
    <p class="z"></p>
    <p class="foot"> Uganda Chemical Petroleum & Allied Workers Union </p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script  src="lazoTechStyle.js"></script>
</body>
</html>