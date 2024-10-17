<?php 
session_start();
include 'db.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if ($password === $user["password"]) {
            $_SESSION["username"] = $user["username"];
            header("Location: home.php?user=" . urldecode($username));
            die();
        } else {
            echo '<script>alert("Password does not match!");</script>';
        }
    } else {
        echo '<script>alert("Check Credentials!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: url('back1.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #DFB9B9;
            padding: 12px 20px;
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
            gap: 30px;
        }

        .navbar-left ul li,
        .navbar-right ul li {
            display: inline;
        }

        .navbar ul li a, 
        .navbar button a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-weight: bold;
        }

        .navbar button {
            background-color: #a67990;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .navbar button a {
            color: white;
        }

        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .logo-img {
            width: 300px;
            height: auto;
        }


        
        
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }
        .box {
            background: #fdfdfd;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08);
            width: 450px;
        }
        .box header {
            font-size: 25px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
            margin-bottom: 10px;
        }
        .box form .field {
            display: flex;
            margin-bottom: 10px;
            flex-direction: column;
        }
        .box form .input input {
            height: 40px;
            width: 100%;
            font-size: 16px;
            padding: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .btn {
            height: 35px;
            background: rgba(220, 146, 200, 0.808);
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s;
            margin-top: 10px;
            padding: 0px 10px;
        }
        .btn:hover {
            opacity: 0.82;
        }
        .links {
            margin-bottom: 15px;
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
        ul {
            list-style-type: none;
        }
        ul li {
            margin-bottom: 10px;
        }
        ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        .contact-info p, .contact-info a {
            font-size: 14px;
        }
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
        <a href="home.php"><img src="pink.PNG" class="logo-img" alt="Serene Skin Logo"></a>
    </div>
    <div class="navbar-right">
        <ul>
            <li><button><a href="register.php">Register</a></button></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="box">
        <header>Login</header>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
                <button id="togglePassword" type="button" style="background: transparent; border: none; cursor: pointer;">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Login">
            </div>
            <div class="links">
                Don't have an account? <a href="register.php">Sign Up Now</a>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
});
</script>

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
