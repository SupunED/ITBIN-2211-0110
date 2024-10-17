<?php
    include 'db.php';
    session_start();

    if(isset($_GET['product'])){
        $product_id = $_GET['product'];
        #echo $product_id;
    }

    if(isset($_POST['add_to_cart']) && empty($_SESSION['username'])){
        header("Location: login.php");
    }

    if(isset($_POST['reviews'])){
        header("Location: reviews.php?product=" . $product_id . "&user=" . $_SESSION['user']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #fffff;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color:#DFB9B9;
            padding: 10px 20px;
            position: relative;
        }
        .navbar-left ul, .navbar-right ul {
            display: flex;
            list-style-type: none;
            gap: 50px;
        }
        .navbar-left ul li, .navbar-right ul li {
            display: inline;
        }
        .navbar ul li a, .navbar button a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size:18px;
            font-weight:bold;
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
        .product-container {
            display: flex;
            height: 100vh;
            width: 90vw;
            align-items: center;
            justify-content: center;
        }
        .product-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }
        .product-image img {
            max-width:70%;
            max-height:70%;
            object-fit: contain;
        }
        .product-details {
            flex: 1;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
        }
        .product-details h1 {
            margin-top: 0;
        }
        .price {
            color: #e74c3c;
            font-size: 1.5em;
            margin: 10px 0;
        }
        .description {
            margin: 20px 0;
            line-height: 1.5;
        }
        .buy-now {
            background: #E198A3;
            color: #fff;
            font-size: 17px;
            width: 50%;
            padding: 10px;
            border-radius: 30px;
            border: 0;
            outline: 0;
            margin-top: 50px;
            box-shadow: 0 10px 10px rgba(24, 24, 24, 0.25);
            cursor: pointer;
        }
        .buy-now:hover {
            background-color:;
            transform: translate(0px, -8px);
        }
        .product-image img:hover {
            transform: scale(1.2);
            transition: transform 0.9s ease;
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
                    <li><a href='cart.php'>View Cart</a>
                    <li><a href='profile.php?user=<?php echo htmlspecialchars($_SESSION["username"]); ?>'>Profile</a></li>
                    <li><a href="logout.php" class="button">Logout</a></li>
                    <?php else: ?>
                    <li><a href="Login.php" class="button">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    



    <div class="product-container">
        <?php


            if(isset($_GET['user'])){
                $_SESSION['user'] = $_GET['user'];
            }

            if(isset($_GET['product'])){
                $product_id = $_GET['product'];

                $sql = "SELECT product_id, pname, price, product_description, image FROM products WHERE product_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $product_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <div class='product-image'>
                        <img src='" . $row["image"] . "' alt='" . $row["pname"] . "'>
                    </div>
                    <div class='product-details'>
                        <h1>" . $row["pname"] . "</h1>
                        <p class='price'>Rs." . $row["price"] . "</p>
                        <p class='description'>" . $row["product_description"] . "</p>
                        <form method='post' action=''>
                            <button class='buy-now' type='submit' name='add_to_cart'>Add to Cart</button>
                            <button class='buy-now' type='submit' name='reviews'>Reviews</button>
                        </form>
                    </div>
                    ";
                }else{
                    echo "<p>Product Not Found!</p>";
                }
            }else{
                echo "<p>Invalid product ID.</p>";
            }

            if(isset($_POST['add_to_cart']) && !empty($_SESSION['username'])){
                $quantity = 1;
                $cart_sql = "SELECT quantity FROM cart WHERE product = ? AND user = ?";
                $cart_stmt = mysqli_prepare($conn, $cart_sql);
                mysqli_stmt_bind_param($cart_stmt, "is", $product_id, $_SESSION['user']);
                mysqli_stmt_execute($cart_stmt);
                $cart_result = mysqli_stmt_get_result($cart_stmt);

                if(mysqli_num_rows($cart_result) > 0){
                    $cart_row = mysqli_fetch_assoc($cart_result);
                    $new_quantity = $cart_row['quantity'] + $quantity;

                    $update_sql = "UPDATE cart SET quantity = ? WHERE product = ? AND user = ?";
                    $update_stmt = mysqli_prepare($conn, $update_sql);
                    mysqli_stmt_bind_param($update_stmt, "iis", $new_quantity, $product_id, $_SESSION['user']);
                    mysqli_stmt_execute($update_stmt);

                    echo "<p>Updated Quantity: " . $new_quantity . "</p>";
                }else{
                    $insert_sql = "INSERT INTO cart (product, user, quantity) VALUES (?, ?, ?)";
                    $insert_stmt = mysqli_prepare($conn, $insert_sql);
                    mysqli_stmt_bind_param($insert_stmt, "isi",  $product_id, $_SESSION['user'], $quantity);
                    mysqli_stmt_execute($insert_stmt);

                    echo "<p>Added to cart. Quantity: " . $quantity . "</p>";
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
