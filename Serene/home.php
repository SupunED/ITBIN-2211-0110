<?php
include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serene Skin</title>
    <!-- Updated Font Awesome link -->
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
            background: #DFB9B9;
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
            gap: 30px; 
        }

        .navbar-left ul li,
        .navbar-right ul li {
            display: inline;
        }

        .navbar ul li a, 
        .navbar-right a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-weight: bold;
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

        @media only screen and (max-width: 840px) {
            .navbar {
                flex-direction: column;
            }

            .navbar-left,
            .navbar-right {
                flex-direction: column;
                width: 100%;
                align-items: center;
            }

            .navbar-left ul,
            .navbar-right ul {
                gap: 15px; 
            }
        }


        .quote-container {
    position: relative;
    text-align: center;
    width: 100%;
}

.background-image {
    width: 100%;
    height: auto;
}

.quote {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    padding: 10px 20px;
    background-color: rgba(0, 0, 0, 0.3); /* Optional: Adds a translucent background */
    border-radius: 8px;
}


        .main-content {
            padding: 20px;
            text-align: center;
        }

        .promotional-content {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .promotional-content h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }
        .additional-content {
    background-color: #f9f9f9;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
}

.additional-content img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.additional-content p {
    margin-top: 15px;
    color: #333;
    font-size: 16px;
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
            color: #00aced; 
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
                <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                    <li><a href="offers.php">Offers</a></li>
                    <li><a href='cart.php'>View Cart</a></li>
                    <li><a href='profile.php?user=<?php echo htmlspecialchars($_SESSION["username"]); ?>'>Profile</a></li>
                    <li><a href="logout.php" class="button">Logout</a></li>
                <?php else: ?>
                    <li><a href="Login.php" class="button">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    
    <div class="quote-container">
    <img src="back1.png" class="background-image" alt="Background Image">
    <div class="quote">
        <h2><center>Serene Skin </center><br> <center>Embrace natural beauty,<br> feel truly radiant</center></h2>
    </div>
</div>

    <div class="main-content">
        <!-- welcome -->
        <div class="promotional-content">
            <h2>Welcome to Serene Skin!</h2>
            <p style="color: #333; font-size: 17px;">Discover our range of premium skincare products designed to enhance your natural beauty. <br>Whether you’re looking for nourishing creams, soothing lotions, or refreshing serums, we have something for everyone!</p>
            <p style="color: #333; font-size: 17px;">Check out our latest offers and all products here!</p>
            <a href="catalog.php" class="button" style="padding: 10px 15px; background-color: #DFB9B9; color: white; text-decoration: none; border-radius: 5px;">Shop Now</a>
        </div>
       <!-- First Image and Text Section -->
    <div class="additional-content" style="position: relative; background-color:#dbccbf; padding: 20px; margin-top: 20px; border-radius: 8px;">
        <img src="photo1.png" alt="New Image 1" style="width: 50%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div style="position: absolute; top: 20%; right: 10%; background-color: white; padding: 20px; max-width: 300px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2>Haircare Products</h2>
        <p style="color: #333; font-size: 20px;">Serene Skin’s haircare products, crafted with natural ingredients, nourish and strengthen your hair. Discover radiant hair. Grab now!</p>
        <a href="catalog.php?category=hair" class="button" style="padding: 10px 15px; background-color: #DFB9B9; color: white; text-decoration: none; border-radius: 5px;">Shop Now</a>    
    </div>
    </div>

    <!-- Second Image and Text Section -->
    <div class="additional-content" style="position: relative; background-color: #dbccbf; padding: 20px; margin-top: 20px; border-radius: 8px;">
        <img src="photo2.png" alt="New Image 2" style="width: 50%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div style="position: absolute; top: 20%; left: 10%; background-color: white; padding: 20px; max-width: 300px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2>Skincare Products</h2>   
        <p style="color: #333; font-size: 20px;"><p style="color: #333; font-size: 20px;">Our products are made with natural ingredients, can use for dryness, oiliness, sensitivity, or aging.Buy now!</p></p>
        <a href="catalog.php?category=skin" class="button" style="padding: 10px 15px; background-color: #DFB9B9; color: white; text-decoration: none; border-radius: 5px;">Shop Now</a>    
    </div>
    </div>

    <!-- Third Image and Text Section  -->
<div class="additional-content" style="position: relative; background-color: #dbccbf; padding: 20px; margin-top: 20px; border-radius: 8px;">
    <img src="photo3.png" alt="New Image 3" style="width: 50%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div style="position: absolute; top: 20%; right: 10%; background-color: white; padding: 20px; max-width: 300px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2>Fragrances</h2>  
        <p style="color: #333; font-size: 20px;">We have unique freagrance collection. That matches for everyone's preferences. Grab your one now!</p>
        <a href="catalog.php?category=fragrance" class="button" style="padding: 10px 15px; background-color: #DFB9B9; color: white; text-decoration: none; border-radius: 5px;">Shop Now</a> 
    </div>
</div>

    </div>
</div>
    </div>
</div>
</div>
</div>
    </div>

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

    <div class="copyright">
        <p>&copy; 2024 SereneSkin. All Rights Reserved</p>
    </div>
</body>
</html>
