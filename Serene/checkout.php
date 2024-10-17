<?php 
include 'db.php';
session_start();

if(isset($_POST['submit'])){
    if ($_POST['payment_method'] === 'saved_card') {
        // If the user selected the saved payment method
        header('Location: payment.php?payment=saved');
    } else {
        // If the user selected the visa/mastercard option
        header('Location: payment.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');


        html, body {
         height: 100%; /* Ensure the body takes full height */
        }

        .title {
            margin-left: 20px;
        }

        .backhome {
            margin-left: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 0.5);
            background-size: cover; 
            font-family: Arial, sans-serif;
            background: url('back1.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgb(213 179 187); 
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
            gap: 50px; 
            /*margin: 0;
            padding: 0;*/
        }

        .navbar ul li a:hover {
            color: #aa6677; /* Match hover color from second code */
            text-decoration: underline; /* Add underline on hover */
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
            transition: 0.3s;
        }

        .navbar a:hover{
            color: #a67990;
        }

        .button {
            background-color: #a67990; 
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            color: white;
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

        .product {
            border: 3px solid black;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            margin-left: 20px;
            margin-right: 20px;
        }

        .product img {
            max-width: 100px;
            margin-right: 10px;
        }

        .product-details {
            flex: 1;
        }

        .summary {
            font-family: sans-serif;
            /*background-color: rgb(213 179 187);
            margin-top: 20px;
            border-style: double;
            border-width: 3px;
            border-color: black;*/
            font-size: 18px;
            padding: 10px;
            margin-bottom: 5px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .payBtn {
            border: none; 
            padding: 8px 33px; 
            background-color: #007bff; 
            border-radius: 5px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            cursor: pointer; 
            font-size: 20px; 
            color: white; 
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-left: 25px;
            margin-bottom: 25px;
        }

        .payBtn:hover {
            background-color: #0056b3; 
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .pay_href {
            text-decoration: none;
            color: white;
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


        footer {
            background-color: #2d2d2d;
            color: white;
            padding: 40px 0;
            margin-top: auto; /* Push the footer to the bottom */
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

        .summaryContainer{
            background-color: rgba(255, 255, 255, 0.9);
            padding-top: 20px;
        }


        label {
            display: block;
            margin-left: 30px;
        }



        select {
            padding: 10px;
            border-radius: 5px;
            border: 2px solid #a67990; /* Border color that matches your theme */
            font-size: 16px;
            color: #333; /* Dark text for readability */
            background-color: white; /* White background for contrast */
            margin: 10px 0; /* Add some spacing around the select */
            transition: border-color 0.3s;
            width: 30%%; /* Make it full width for better UX */
            Margin-left: 30px;
        }

        select:hover, select:focus {
            border-color: #8c5678; /* Darker border on hover/focus */
            outline: none; /* Remove default outline */
        }

        Label {
            font-size: 18px;
            font-family: sans-serif;
        }

        /* Center and style the empty cart message */
        .empty {
            text-align: center;
            font-family: 'Poppins', sans-serif; /* Use a modern, readable font */
            font-size: 24px; /* Larger font size for emphasis */
            color: #a67990; /* Use the theme color for the text */
            margin-top: 50px; /* Add some margin for spacing */
        }

        /* Style the back-home link */
        .back-home {
            display: inline-block; /* Make it a block element so that margin works */
            text-align: center;
            margin: 20px auto; /* Center the link */
            padding: 10px 20px;
            background-color: #a67990; /* Use a matching background color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-home:hover {
            background-color: #8c5678; /* Darken the background on hover */
            color: white; /* Keep the text white on hover */
        }

        .empty-container p{
            text-align-last: center;
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

    <div class="summaryContainer">


    <h1 class="title">Order Summary</h1>

    <?php
    if(!isset($_SESSION['username'])) {
        echo "You need to be logged in to view this page.";
        exit;
    }

    $user = $_SESSION['username'];

    $cartQuery = "SELECT c.product, c.quantity, p.pname, p.price, p.image 
                  FROM cart c 
                  JOIN products p ON c.product = p.product_id 
                  WHERE c.user = ?";


    $cardQuery = "SELECT cardnumber FROM creditcard WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $cartQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!$cartItems) {
            echo "<div class='empty-container'>";
            echo "<p class='empty'>Your cart is empty.<p>";
            echo "<br/><a href='home.php?user=$user' class='back-home'>Back to Home</a>";
            echo "</div>";

            echo '
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
                <p>Serene Skin offers natural, high-quality hair, body, and skincare products to enhance your natural beauty. Every product is crafted with care for a serene, radiant experience. Each product is carefully crafted with nourishing ingredients to give you a serene and radiant experience, promoting healthy, glowing skin and hair.</p>
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
    </div>';

            

            
            exit;
        }

        $subtotal = 0;

        foreach ($cartItems as $item) {
            $totalPrice = $item['price'] * $item['quantity'];
            $subtotal += $totalPrice;
            echo "<div class='product'>";
            echo "<img src='" . htmlspecialchars($item['image']) . "' alt='" . htmlspecialchars($item['pname']) . "'>";
            echo "<div class='product-details'>";
            echo "<h3>" . htmlspecialchars($item['pname']) . "</h3>";
            echo "<p>Price: Rs. " . number_format($item['price'], 2) . "</p>";
            echo "<p>Quantity: " . htmlspecialchars($item['quantity']) . "</p>";
            echo "</div></div>";
        }

        $deliveryCharge = 1500;
        $taxRate = 0.15;
        $taxes = $subtotal * $taxRate;
        $totalPrice = $subtotal + $deliveryCharge + $taxes;

        echo "<div class='summary'>";
        echo "<p>Subtotal: Rs. " . number_format($subtotal, 2) . "</p>";
        echo "<p>Delivery Charge: Rs. " . number_format($deliveryCharge, 2) . "</p>";
        echo "<p>Taxes (15%): Rs. " . number_format($taxes, 2) . "</p>";
        echo "<p><strong>Total Price: Rs. " . number_format($totalPrice, 2) . "</strong></p>";
        echo "</div>";

        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }


    #new payment option
    $savedCards = [];
    if ($stmt = mysqli_prepare($conn, $cardQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $savedCards[] = $row['cardnumber'];
        }
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    }




    mysqli_close($conn);
    ?>

    <form method="POST" action="">
        <label for="payment-method">Pay using:</label>
        <select id="payment-method" name="payment_method" onchange="updateAction()">
            <option value="new_card">Visa/Mastercard</option>
            <?php if (count($savedCards) > 0): ?>
                <option value="saved_card">Saved Card: **** **** **** <?php echo htmlspecialchars(substr($savedCards[0], -4)); ?></option>
            <?php endif; ?>
        </select>

        <input type="hidden" name="total" value="<?php echo $totalPrice; ?>">
        <input type="hidden" id="paymentType" name="payment_type" value="new">

        <button type="submit" class="payBtn" name="submit">Pay</button>
    </form>

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

    <script>
        function updateAction() {
            const paymentMethodSelect = document.getElementById('payment-method');
            const paymentTypeInput = document.getElementById('paymentType');
            const savedCardInfo = document.getElementById('saved-card-info');

            if (paymentMethodSelect.value === 'saved_card') {
                paymentTypeInput.value = 'saved';
                savedCardInfo.style.display = 'block';
            } else {
                paymentTypeInput.value = 'new';
                savedCardInfo.style.display = 'none';
            }
        }
    </script>
    

</body>
</html>
