<?php
session_start();
include 'db.php';

$sql = "SELECT offerid, pname, image, originalprice, discountedprice FROM offers";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serene Skin</title>
    <style>
        /* Your CSS styling here */
        body {
            margin: 0;
            padding: 0;
            background-color: #a67;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.5);
            padding: 10px 20px;
            position: relative;
        }
        .navbar-left ul,
        .navbar-right ul {
            display: flex;
            list-style-type: none;
            gap: 50px;
        }
        .navbar ul li a,
        .navbar button a {
            text-decoration: none;
            color: rgba(255, 255, 255);
            font-size: 18px;
            font-weight: bold;
        }
        .logo {
            position: absolute;
            left: 50%;
            transform: translate(-50%);
        }
        .logo-img {
            width: 300px;
            height: auto;
        }
        header {
            color: rgb(248, 246, 246);
            text-align: center;
        }
        h1 {
            color: #000000;
            font-size: 65px;
            font-family: Arial-cursive;
            text-align: center;
        }
        .shop-banner {
            display: flex;
            justify-content: space-around;
            background-color: #ffc0cb;
            flex-wrap: wrap;
            padding: 5px;
        }
        .product {
            width: 30%;
            padding: 5px;
            text-align: center;
            margin: 5px;
            background-color: rgba(245, 200, 250);
        }
           
        .product img {
            max-width: 300px;
            height: 300px;
        
        }
        .product h2 {
            font-size: 1.5rem;
        }
        .product p {
            text-decoration: line-through;
            color: rgb(66, 57, 57);
        }
        button {
            background-color: red;
            color: white;
            padding: 10px 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #555555;
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
                    <li><a href='cart.php'>View Cart</a>
                    <li><a href='profile.php?user=<?php echo htmlspecialchars($_SESSION["username"]); ?>'>Profile</a></li>
                    <li><a href="logout.php" class="button">Logout</a></li>
                    <?php else: ?>
                    <li><a href="Login.php" class="button">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <header> 
        <h1>Special Offers</h1>
        <h2>Online Exclusive Value Deals!<h2>
    </header>  
    <marquee><h2>Don't miss out our exclusive web offers!<h2></marquee>

    <div class="shop-banner">
        <?php
        {
            // Check if any records are found
            if ($result->num_rows > 0) {
                // Loop through each offer and display it
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <img src='" . $row['image'] . "' alt='" . $row['pname'] . "'>
                            <h2>" . $row['pname'] . "</h2>
                            <h3><p>Rs." . number_format($row['originalprice'], 2) . "</p></h3>
                            <h2>Rs." . number_format($row['discountedprice'], 2) . "</h2>
                            <ul>
                                <li>Available In store & Online</li>
                                <li>Check rewards app for offer code</li>
                                <li>Valid till 4th August</li>
                                <li>Islandwide Delivery Available</li>
                                <li>Other Terms & Conditions Apply.</li>
                                <li>Offer is ONLY valid for Reward members.</li>
                            </ul>
                            <button>Shop Now</button>
                          </div>";
                }
        
            } else {
                echo "<p>No offers available at the moment.</p>";
            }
    
        }
        mysqli_close($conn);
        ?>
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
