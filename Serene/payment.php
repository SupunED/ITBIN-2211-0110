<?php
    include 'db.php';
    session_start();

    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
        die();
        header('Location: login.php');
    }

    $paymentMethod = "";
    if (isset($_GET['payment'])) {
        $paymentMethod = $_GET['payment'];
    } else {
        $paymentMethod = "new";
    }


    if(isset($_POST['cancel'])){
        header('Location: home.php');
    }

    $alertMessage = "";
    $alertType = "success"; // success or error


    $cardholder = '';
    $cardnumber = '';
    $expirymonth = '';
    $expiryyear = '';
    $cvv = '';

    if (isset($_POST['update'])) {
        $cardholder = $_POST['cardholder-name'];
        $cardnumber = $_POST['card-number'];
        $expirymonth = $_POST['expiry-month']; 
        $expiryyear = $_POST['expiry-year'];
        $cvv = $_POST['cvv'];

        $id = $_SESSION['username'];

        $update_query = mysqli_query($conn, "UPDATE creditcard SET cardholder='$cardholder', cardnumber='$cardnumber', expirymonth='$expirymonth', expiryyear='$expiryyear', cvv='$cvv' WHERE username='$id'") or die("Error occurred");
    
        if ($update_query) {
            echo "<script>alert('Credit card details updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update credit card details!');</script>";
        }
    
    
    } else if (isset($_POST['submit'])) {
        // Process payment
        echo "<script>
        alert('Payment processed successfully!');
        setTimeout(function() {
            window.location.href = 'home.php';
        }, 1000); // Delay the redirection by 1 second (1000 milliseconds)
      </script>";


        $sql = "DELETE FROM cart WHERE user = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['user']);
        mysqli_stmt_execute($stmt);


    }elseif(isset($_POST['save'])){

        $cardholder = $_POST['cardholder-name'];
        $cardnumber = $_POST['card-number'];
        $expirymonth = $_POST['expiry-month']; 
        $expiryyear = $_POST['expiry-year'];
        $cvv = $_POST['cvv'];


        $username = $_SESSION['username'];
        $query = mysqli_query($conn, "INSERT INTO creditcard (username, cardholder, cardnumber, expirymonth, expiryyear, cvv) VALUES ('$username', '$cardholder', '$cardnumber', '$expirymonth', '$expiryyear', '$cvv')");
        
        if($query) {
            echo "<script>alert('Credit card details saved successfully!');</script>";
        } else {
            echo "<script>alert('Error saving credit card details');</script>";
        }   
    }
    
 
    elseif($paymentMethod === 'saved'){
        $username = $_SESSION['username'];
        $query = mysqli_query($conn, "SELECT * FROM creditcard WHERE username='$username'");

        while ($result = mysqli_fetch_assoc($query)) {
            $cardholder = $result['cardholder'];
            $cardnumber = $result['cardnumber'];
            $expirymonth = $result['expirymonth'];
            $expiryyear = $result['expiryyear'];
            $cvv = $result['cvv'];  
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 0.5);
            background-size: cover; 
            font-family: Arial, sans-serif;
            background: url('back1.png') no-repeat center center fixed;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
            margin-bottom: 50px;
            margin-top: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="number"], select {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .card-logos {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .card-logos img {
            height: 50px;
            margin: 0 10px;
        }

        .confirm, .cancel, .update, .save{
            width: 100%;
            padding: 10px;
            background-color: #378dd3;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        .confirm:hover {
            background-color: #125f9e;
        }

        .cancel {
            background-color: #e25050;
        }

        .cancel:hover {
            background-color: #b92727;
        }

        .update, .save{
            background-color: #3aaf76;
        }


        .update:hover, .save:hover {
            background-color: #358d62;
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

        .logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo-img {
            width: 300px; 
            height: auto; 
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


<div class="container">
    <h2>Payment</h2>

    <?php if (!empty($alertMessage)): ?>
        <div class="alert <?php echo $alertType === 'success' ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $alertMessage; ?>
        </div>
    <?php endif; ?>               



    <div class="card-logos">
        <input type="radio" name="payment_method" value="visa">
        <img src="images/Visa_logo.png" alt="Visa">

        <input type="radio" name="payment_method" value="mastercard">
        <img src="images/mastercard_logo.png" alt="MasterCard">

        <input type="radio" name="payment_method" value="amex">
        <img src="images/amex.jfif" alt="American Express">

    </div>


    <form method="post" action="" id="payment-form" >

        <label for="cardholder-name">Cardholder's Name:</label>
        <input type="text" id="cardholder-name" name="cardholder-name" value="<?php echo $cardholder; ?>" autocomplete="off" placeholder="John Doe" required>

        <label for="card-number">Card Number:</label>
        <input type="text" id="card-number" name="card-number" value="<?php echo $cardnumber; ?>" autocomplete="off" placeholder="0123XXXXXXXXXXXX" required>

        <label for="expiry-month">Expiry Month:</label>
        <select id="expiry-month" name="expiry-month" required>
            <option value="">Select Month</option>
            <option value="01" <?php if($expirymonth == '1') echo 'selected'; ?>>January</option>
            <option value="02" <?php if($expirymonth == '2') echo 'selected'; ?>>February</option>
            <option value="03" <?php if($expirymonth == '3') echo 'selected'; ?>>March</option>
            <option value="04" <?php if($expirymonth == '4') echo 'selected'; ?>>April</option>
            <option value="05" <?php if($expirymonth == '5') echo 'selected'; ?>>May</option>
            <option value="06" <?php if($expirymonth == '6') echo 'selected'; ?>>June</option>
            <option value="07" <?php if($expirymonth == '7') echo 'selected'; ?>>July</option>
            <option value="08" <?php if($expirymonth == '8') echo 'selected'; ?>>August</option>
            <option value="09" <?php if($expirymonth == '9') echo 'selected'; ?>>September</option>
            <option value="10" <?php if($expirymonth == '10') echo 'selected'; ?>>October</option>
            <option value="11" <?php if($expirymonth == '11') echo 'selected'; ?>>November</option>
            <option value="12" <?php if($expirymonth == '12') echo 'selected'; ?>>December</option>
        </select>

        <label for="expiry-year">Expiry Year:</label>
        <select id="expiry-year" name="expiry-year" required>
            <option value="">Select Year</option>
            <option value="2024" <?php if($expiryyear == '2024') echo 'selected'; ?>>2024</option>
            <option value="2025" <?php if($expiryyear == '2025') echo 'selected'; ?>>2025</option>
            <option value="2026" <?php if($expiryyear == '2026') echo 'selected'; ?>>2026</option>
            <option value="2027" <?php if($expiryyear == '2027') echo 'selected'; ?>>2027</option>
            <option value="2028" <?php if($expiryyear == '2028') echo 'selected'; ?>>2028</option>
            <option value="2029" <?php if($expiryyear == '2029') echo 'selected'; ?>>2029</option>
            <option value="2030" <?php if($expiryyear == '2030') echo 'selected'; ?>>2030</option>
        </select>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" value="<?php echo $cvv; ?>" autocomplete="off" required>

        <button type="submit" name="submit" class="confirm">Confirm Payment</button>

        <?php 
            if($paymentMethod === 'saved'){
                echo "<br><br>";
                echo '<button type="submit" name="update" class="update">Update Payment Details</button>';
            }
            if($paymentMethod === 'new'){
                echo "<br><br>";
                echo '<button type="submit" name="save" class="save">Save Payment Details</button>';
            }

        ?>
        <br><br>
    </form>

    <form method="post">
        <button type="submit" name="cancel" class="cancel">Cancel</button>
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

</body>


<script>
    document.getElementById('payment-form').addEventListener('submit', function(event) {

        var cardNumber = document.getElementById('card-number').value.trim();
        var cvv = document.getElementById('cvv').value.trim();
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked');

        var isValid = true;
        var errorMessage = '';

        if (!/^\d{13,19}$/.test(cardNumber) || parseInt(cardNumber, 10) <= 0) {
            isValid = false;
            errorMessage += 'Invalid card number. It should contain only positive digits and be between 13 and 19 characters long.\n';
        }

        if (!/^\d{3,4}$/.test(cvv) || parseInt(cvv, 10) <= 0) {
            isValid = false;
            errorMessage += 'Invalid CVV. It should be a 3 or 4 digit positive number.\n';
        }

        if (!paymentMethod) {
            isValid = false;
            errorMessage += 'Please select a payment method.\n';
        }

        if (!isValid) {
            alert(errorMessage);
            event.preventDefault(); 
        } 
    });
</script>

    

</html>
