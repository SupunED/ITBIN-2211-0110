<?php
session_start();
include 'db.php';

if (isset($_GET['user'])) {
    $_SESSION['username'] = $_GET['user'];
    /*echo "user = " . $_SESSION['username'];*/
}


$category = "";

if(isset($_GET['category'])){
    $category = $_GET['category'];
}else{
    $category = "";
}

/*if (isset($_POST['category'])) {
    $category = $_POST['category'];
} elseif (isset($_POST['all'])) {
    $category = "";
}*/

$sql = "SELECT product_id, pname, price, product_description, image FROM products";
if ($category && $category !== 'all') {
    $sql .= " WHERE category = '" . mysqli_real_escape_string($conn, $category) . "'";
}

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Banner</title>
    <style>
        
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
            gap: 50px; /
            margin: 0;
            padding: 0;
        }

        .navbar ul li a:hover {
            color: #aa6677; /* Change text color on hover */
            text-decoration: underline; /* Optional: add underline on hover */
        }

        .navbar-left ul li,
        .navbar-right ul li {
            display: inline;
        }

        .navbar ul li a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size: 18px;
            font-weight: bold;
        }

        .navbar a.button {
            background-color: #a67990; 
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .navbar a.button:hover {
            background-color: #8c5678;
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

        .shop-banner {
            display: grid;
            justify-content: space-around;
            align-items: center;
            background-color: #ffffff;
            padding: 80px;
            grid-template-columns: repeat(4, 1fr);
            gap: 50px;
        }

        .product-card {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 20px;
            margin: 0;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        .product-image {
            max-width: 100%;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            color: #000000;
            margin-bottom: 20px;
        }

        .add-to-cart {
            background-color: #e29eaf;
            color: #fff;
            padding: 10px 50px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: #EE4C7C;
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
</head>

<body>
    <nav class="navbar">

    <div class="navbar-left">
    <form method="post" action="">
        <ul>
            <li><a href="catalog.php">All</a></li>
            <li><a href="catalog.php?category=skin">Skin</a></li>
            <li><a href="catalog.php?category=hair">Hair</a></li>
            <li><a href="catalog.php?category=fragrance">Fragrance</a></li>
        </ul>
    </form>


<br/><br/>

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

    

    <br/><br/>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='shop-banner'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <div class='product-card'>
                    <img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["pname"]) . "' class='product-image'>
                    <div class='product-name'>" . htmlspecialchars($row["pname"]) . "</div>
                    <div class='product-price'>" .'Rs.' . htmlspecialchars($row["price"]) . "</div>
                    <a href='product.php?product=" . htmlspecialchars($row["product_id"]) . (isset($_SESSION['username']) && !empty($_SESSION['username']) ? "&user=" . htmlspecialchars($_SESSION['username']) : "") . "' class='add-to-cart'>View Product</a>
                </div>
            ";
        }
        echo "</div>";
    } else {
        echo "<br/>No Products Available<br/>";
    }

    mysqli_close($conn);
    ?>

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