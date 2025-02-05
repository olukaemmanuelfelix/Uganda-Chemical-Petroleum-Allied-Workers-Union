
<?php

// Start the session to store login state
session_start();

// Define default admin credentials
$default_username = 'admin';
$default_password = 'admin123'; // Make sure to store passwords securely in a real application

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password
    if ($username === $default_username && $password === $default_password) {
        // Successful login, set session variable
        $_SESSION['admin_logged_in'] = true;
        echo 'Login successful!';
        // Redirect to admin dashboard or desired page
        header('Location: admin_page.php');
        exit();
    } else {
        // Invalid credentials
        echo 'Invalid username or password!';
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazo Tech</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
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
        <li><a href="index.php" class="k">HOME</a></li>
        <li><a href="feed.php" class="w">NEWS FEED</a></li>
        <li><a href="contact_us.php" class="e">CONTACT US</a></li>
        <li><a href="structure.php" class="e">STRUCTURE</a></li>
        <li><a href="" class="y"></a></li>
        <li><a href="membership.php" class="r">MEMBERSHIP</a></li>
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
    <p class="fe">Admin Login</p>
</div>

<div class="contact">
  
    <div class="contact_container">
        <div class="contact_info">
            <div class="box">
                <div class="icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="text">
                    <label for="" class="font_head">Email</label>
                    <label for="">quos saepe exercitationem</label>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="text">
                    <label for="" class="font_head">Address</label>
                    <label for="">quos saepe exercitationem</label>
                   <label for="">quos saepe exercitationem</label>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="text">
                    <label for="" class="font_head">Phone</label>
                    <label for="">quos saepe exercitationem</label>
                   <label for="">quos saepe exercitationem</label>
                </div>
            </div>
          </div>
          <div>
            <div class="contact_form">
                <form action="" method="POST">
                    <div class="input_box">
                        <span>Username:</span>
                        <input type="text" id="username" name="username" required>
                        
                    </div>
                    <div class="input_box">
                        <span>Password:</span>
                        <input type="password" id="password" name="password" required>
                        
                    </div>
                    <div class="input_box">
                        <input type="submit" name="" value="Login" required>
                    </div>
                    <a href="" style="color: red; margin-top: 10px;">Forgot password</a>
                </form>
            </div>
        </div>
    </div>
</div>


<footer class="quicks">
   <div class="q_links">
    <h4>Quick links</h4>
    <p class="tol"></p>
    <a href="i"><p>Home</p></a>
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