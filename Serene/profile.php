<?php 
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Function to calculate age from date of birth
function calculateAge($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #e4e9f7;
            background: url('back1.png') no-repeat center center fixed; 
            background-size: cover;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #DFB9B9;
            padding: 16px 20px;
            position: relative;
            font-weight: bold;
        }

        .navbar-left,
        .navbar-right {
            display: flex;
            align-items: center;
        }

        .navbar-left ul,
        .navbar-right ul {
            display: flex;
            list-style-type: none;
            gap: 50px; 
            margin: 0;
            padding: 0;
        }

        .navbar-left ul li,
        .navbar-right ul li {
            display: inline;
        }

        .navbar ul li a, 
        .navbar button a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size:18px;
            font-weight:bold;
        }

        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo-img {
            width: 280px; 
            height: auto; 
        }

        .main-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 70%;
            margin: auto;
        }

        .top {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            margin-top: 60px; 
            gap: 15px;
        }

        .box {
            background: #fdfdfd;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .bottom {
            width: 100%;
            margin-top: 20px;
        }

        .right-links {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            background-color: #DFB9B9; 
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            opacity: 0.82;
        }

        @media only screen and (max-width: 840px) {
            .top {
                flex-direction: column; 
                align-items: center; 
            }
            .box {
                width: 90%; /* Full width on smaller screens */
                max-width: none; /* Remove max width restriction */
            }
        }

        footer {
            background-color: #2d2d2d;
            color: white;
            padding: 40px 0;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column {
            flex: 1;
            margin: 0 20px;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .contact-info p, .contact-info a {
            font-size: 14px;
        }

        /* Social media icons using Font Awesome */
        .social-icons a {
            margin-right: 10px;
            font-size: 20px;
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #00aced; /* Change this to the hover color of your choice */
        }

        .copyright {
            text-align: center;
            padding: 20px 0;
            background-color: #222;
            font-size: 12px;
            color: #aaa;
        }
    </style>
    <script>
        function confirmLogout() {
            const confirmation = confirm("Are you sure you want to log out?");
            if (confirmation) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
        <ul>
            <li><a href="catalog.php">All</a></li>
            <li><a href="catalog.php?category=skin">Skin</a></li>
            <li><a href="catalog.php?category=hair">Hair</a></li>
            <li><a href="catalog.php?category=fragrance">Fragrance</a></li>
        </ul>
    </div>
    <div class="logo">
        <a href="<?php 
            echo isset($_SESSION['username']) && !empty($_SESSION['username']) ? 'home.php?user=' . urlencode($_SESSION['username']) : 'home.php';
        ?>">
            <img src="pink.PNG" class="logo-img" alt="Serene Skin Logo">
        </a>
    </div>
    <div class="navbar-right">
        <ul>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                <li><a href="offers.php">Offers</a></li>
                <li><a href='cart.php'>View Cart</a></li>
                <li><a href='profile.php?user=<?php echo htmlspecialchars($_SESSION["username"]); ?>'>Profile</a></li>
                <li><a href="#" class="btn" onclick="confirmLogout()">Logout</a></li>
            <?php else: ?>
                <li><a href="Login.php" class="button">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<main>
    <div class="main-box">
        <div class="top">
            <?php 
            $username = $_SESSION['username'];
            $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

            if ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['username'] ?? 'N/A';
                $res_Email = $result['email'] ?? 'N/A';
                $res_Phone = $result['phone'] ?? 'N/A';
                $res_Dob = $result['DateOfBirth'] ?? 'N/A';
                $res_Gender = $result['gender'] ?? 'N/A';
                $res_Age = $res_Dob !== 'N/A' ? calculateAge($res_Dob) : 'N/A';
            } else {
                $res_Uname = $res_Email = $res_Phone = $res_Dob = $res_Gender = $res_Age = 'N/A';
            }
            ?>
            <div class="box">
                <p>Hello <b><?php echo htmlspecialchars($res_Uname); ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo htmlspecialchars($res_Email); ?></b>.</p>
            </div>
            <div class="box">
                <p>Your phone number is <b><?php echo htmlspecialchars($res_Phone); ?></b>.</p>
            </div>
            <div class="box">
                <p>Your date of birth is <b><?php echo htmlspecialchars($res_Dob); ?></b>.</p>
            </div>
            <div class="box">
                <p>Your gender is <b><?php echo htmlspecialchars($res_Gender); ?></b>.</p>
            </div>
            <div class="box">
                <p>And you are <b><?php echo htmlspecialchars($res_Age); ?> years old</b>.</p> 
            </div>
        </div>
       
        <div class="right-links">
            <a href="edit.php?user=<?php echo $username ?>" class="btn">Change Profile</a>
            <a href="#" class="btn" onclick="confirmLogout()">Log Out</a>
        </div>
    </div>
</main>

<footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Social Media</h3>
                <p>Stay connected with Serene Skin! For any questions, product inquiries, or just to say hello, reach out to us on our social media platforms. We’re here to help you on your journey to natural beauty! Message us directly on Instagram, Facebook, or Twitter, and let’s chat! Your serene experience is just a click away.</p>
                
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Serene Skin offers natural, high-quality hair, body, and skincare products to enhance your natural beauty. Every product is crafted with care for a serene, radiant experience.Each product is carefully crafted with nourishing ingredients to give you a serene and radiant experience, promoting healthy, glowing skin and hair. </p>
            </div>
            <div class="footer-column contact-info">
                <h3>Contact Info</h3>
                <p>No 12, Park street, Sri Lanka</p>
                <p>Phone: 011 222 0000</p>
                <p>Email: SereneSkin@gmail.com</p>
            </div>
        </div>
    </footer>

</body>
</html>
