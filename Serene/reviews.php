<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serene Skin - Reviews</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color:#e8d3d4;;
            font-family: Arial, sans-serif;
    
        }

          .container {
            max-width: 1200px; /* Max width for content */
            margin: 0 auto; /* Center the container */
            padding: 20px; /* Padding for the container */

            text-align-last: center;
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

        h1{
            text-align: center;
            font-size: 40px;
            font-family: Arial-cursive;;
            font-weight: bold;
            color: #4b023b;
            margin-bottom: 30px;

        }

        .review-form-container {
            max-width: 600px; /* Center the form */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc; /* Add border */
            border-radius: 10px; /* Rounded corners */
            background-color: #fff; /* White background */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        label{
           
            font-size: 20px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #100f10;
            display: block; /* Block display for proper spacing */
            margin-bottom: 10px;
        }

        select, textarea, input[type="submit"] {
            width: 100%; /* Full-width elements */
            padding: 10px; /* Add padding */
            border-radius: 5px; /* Rounded corners */
            border: 1px solid #ccc; /* Border */
            align: center;
            front-weight:bold;
            margin-bottom: 15px; /* Spacing */
            box-sizing: border-box; /* Prevent padding from increasing width */
        }

        textarea {
            resize: vertical; /* Allow vertical resizing only */
        }

        input[type="submit"] {
            background-color: #a67990; /* Button color */
            color: white; /* Button text color */
            font-size: 20px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            border: none; /* No border */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s; /* Smooth transition */
        }

        input[type="submit"]:hover {
            background-color: #8f5d78; /* Darker shade on hover */
        }

        .container a {

            background-color:#8f5d78;
            color: white;  
            font-size: 20px;
            font-family: Arial, sans-serif;
            font-weight: bold;                       
            display: inline-block; 
            padding: 10px 20px;               
            border-radius: 5px;        
            transition: background-color 0.3s ease; 
            border: 2px solid transparent; 
         }

        footer {
            background-color: #2d2d2d;
            color: white;
            padding: 40px 0;
            margin-top: 40px; /* Space above footer */
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

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .social-icons a {
            margin-right: 10px;
            font-size: 20px;
            color: white;
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

         table, th, td {
        border: 3px solid black;
        border-collapse: collapse;
        padding: 8px;
        margin: 20px auto ; /* Center the table */
        width: 50%; /* Full width for the table */
    }
        th {
            background-color: #a67990; /* Header background color */
            color: white; /* Header text color */
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            border: 1px solid #111213;
        }

        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #111213;
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

<div class="container">
    <h1>Reviews</h1>
    
<div class="review-form-container">
    <form action="" method="post">
        <label for="rating">Rate</label>
        <select name="rating" id="rating" required>
            <option value="">Rate product</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        
        <label for="review">Write Review:</label>
        <textarea name="review_description" id="review_description" rows="4" required></textarea>
        <input type="submit" value="Submit">
    </form>
</div>

    <?php

        if(isset($_GET['product'])){
            $product_id = $_GET['product'];
            $user = $_GET['user'];
            /*echo $product_id;
            echo $user;*/
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rating = $_POST['rating'];
            $review_description = $_POST['review_description'];
            $user = $_SESSION['user'];

            if (empty($rating)) {
                echo "Rating is required.";
            } else {
                $sql = "INSERT INTO reviews (product, user, rating, review_description) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "isis", $product_id, $user, $rating, $review_description);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Review submitted successfully.");</script>';
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }


        $sql = "SELECT product, user, rating, review_description FROM reviews WHERE product = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            echo"<table>
                <tr>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Description</th>
                </tr>";
            while($row = mysqli_fetch_assoc($result)){
                    echo"<tr>
                        <td>" . $row["user"]. "</td>
                        <td>" . $row["rating"]. "/10</td>
                        <td>" . $row["review_description"]. "</td>
                    </tr>";
                }
            echo"</table>";
        }else{
            echo"<h2>No Reviews Available</h2>";
        }

    ?>
     <a href="product.php?product=<?php echo urlencode($product_id); ?>&user=<?php echo urlencode($user); ?>">Back to Product</a>
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