<?php
include 'db.php';
session_start();

if (isset($_POST['checkout'])) {
    header("Location: checkout.php?user=" . $_SESSION['username']);
    //exit();
}

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Skincare Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 20px;
            padding: 0;
            background-color: #f5f5f5;
            background-size: cover; 
            font-family: Arial, sans-serif; 
        }
        
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /*background-color: rgba(255, 255, 255, 0.5);*/
            background-color: rgb(217 182 188); 
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


        .cart-container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-header {
            
            margin-bottom: 20px;
            text-align: center;
            font-size: 32px;  /* Increase the size */
            font-weight: bold;  /* Make the font bold */
            margin-bottom: 20px;
            text-align: center;
            color: #C56C86;  /* Pinkish color */
            text-transform: uppercase;  /* Uppercase text */
            letter-spacing: 2px;  /* Add some letter spacing for style */
            font-family: 'Poppins', sans-serif;  /* Use a more modern font */
        }

        .cart-item {
            display: flex;
            flex-direction: column;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .cart-item img {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }

        .cart-item-name {
            font-size: 18px;
            margin-right: 20px;
            flex: 1;
        }

        .cart-item-quantity {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .quantity-container {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            cursor: pointer;
            font-size: 16px;
        }

        .quantity-number {
            padding: 0 10px;
            font-size: 18px;
        }

        .cart-item-remove {
            color: red;
            cursor: pointer;
            margin-left: 10px;
        }

        .cart-item-price {
            font-size: 18px;
            font-weight: bold;
        }

        .item-total {
            text-align: right;
            font-size: 18px;
            margin-top: 10px;
        }

        .cart-total {
            text-align: right;
            font-size: 24px;
            margin-top: 20px;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #C56C86;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
            border-radius: 5px;
        }

        body {
    margin: 0;
    padding: 0;
    background: url('back1.png') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

/* Cart container */
.cart-container {
    width: 80%;
    margin: 50px auto;
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Cart table styling */
.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th, .cart-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.cart-table th {
    background-color: #a67;
    color: white;
    font-weight: bold;
}

.cart-table td {
    background-color: rgba(245, 245, 245, 0.9); /* Light grey background for rows */
}

/* Buttons for checkout and updating cart */
.cart-buttons {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}

.cart-buttons button {
    background-color: #a67990;
    border: none;
    padding: 10px 20px;
    color: white;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
}

.cart-buttons button:hover {
    background-color: #8c5a73; /* Slightly darker on hover */
}

/* Responsive design */
@media (max-width: 768px) {
    .cart-container {
        width: 95%;
        padding: 15px;
    }

    .cart-table th, .cart-table td {
        padding: 10px;
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
<div class="cart-container">
        <div class="cart-header"><b>Your Cart<b></div>

        <?php
            
            /*if (isset($_GET['user'])) {
                $_SESSION['user'] = $_GET['user'];
            }*/

            // Handle quantity updates
            if (isset($_POST['update_quantity'])) {
                $product_id = $_POST['product_id'];
                $new_quantity = $_POST['quantity'];
                if ($new_quantity > 0) {  // Prevent negative quantities
                    $sql = "UPDATE cart SET quantity = ? WHERE user = ? AND product = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "isi", $new_quantity, $_SESSION['user'], $product_id);
                    mysqli_stmt_execute($stmt);
                }
            }

            // Handle item removal
            if (isset($_POST['remove_item'])) {
                $product_id = $_POST['product_id'];
                $sql = "DELETE FROM cart WHERE user = ? AND product = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "si", $_SESSION['username'], $product_id);
                mysqli_stmt_execute($stmt);
            }

            // Handle empty cart
            if (isset($_POST['empty_cart'])) {
                $sql = "DELETE FROM cart WHERE user = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['user']);
                mysqli_stmt_execute($stmt);
            }

            // Fetch cart items
            $sql = "SELECT p.image, p.pname, p.price, c.quantity, c.product 
                    FROM cart c 
                    JOIN products p ON c.product = p.product_id 
                    WHERE c.user = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['user']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $total = 0;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $item_total = $row['price'] * $row['quantity'];
                    $total += $item_total;
                    echo "<div class='cart-item'>
                            <div class='cart-item-details'>
                                <img src='" . $row['image'] . "' alt='" . $row['pname'] . "'>
                                <div class='cart-item-name'>" . $row['pname'] . "</div>
                                <div class='cart-item-quantity'>
                                    <div class='quantity-container'>
                                        <!-- Form for decreasing quantity -->
                                        <form method='post' action=''>
                                            <input type='hidden' name='product_id' value='" . $row['product'] . "'>
                                            <input type='hidden' name='quantity' value='" . ($row['quantity'] - 1) . "'>
                                            <button type='submit' name='update_quantity' class='quantity-btn'>-</button>
                                        </form>

                                        <span class='quantity-number'>" . $row['quantity'] . "</span>

                                        <!-- Form for increasing quantity -->
                                        <form method='post' action=''>
                                            <input type='hidden' name='product_id' value='" . $row['product'] . "'>
                                            <input type='hidden' name='quantity' value='" . ($row['quantity'] + 1) . "'>
                                            <button type='submit' name='update_quantity' class='quantity-btn'>+</button>
                                        </form>
                                    </div>
                                </div>
                                <form method='post' action=''>
                                    <input type='hidden' name='product_id' value='" . $row['product'] . "'>
                                    <button type='submit' name='remove_item' class='cart-item-remove'>Remove</button>
                                </form>
                            </div>
                            <div class='cart-item-price'>Rs." . $row['price'] . "</div>
                            <div class='item-total'>Total: Rs." . number_format($item_total, 2) . "</div>
                        </div>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
        ?>

        <div class="cart-total">Total: Rs.<span id="total-price"><?php echo number_format($total, 2); ?></span></div>

        <form method="post" action="">
            <button type="submit" name="empty_cart" class="checkout-btn">Empty Cart</button>
            <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
        </form>

        <?php
            if (isset($_POST['empty_cart'])) {
                // Empty the cart logic
                $sql = "DELETE FROM cart WHERE user = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
                mysqli_stmt_execute($stmt);
                echo "<p>Your cart has been emptied.</p>";
            }
        ?>

        <a href='home.php?user=<?php echo $_SESSION["username"]; ?>' class="checkout-btn">Back to Home</a>
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
