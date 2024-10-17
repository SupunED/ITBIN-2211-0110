<?php 
   session_start();

   include("db.php");
   if (!isset($_SESSION['username'])) {
       header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Change Profile</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

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
    </style>

</head>

<body>
<nav class="navbar">
        <div class="navbar-left">
            <ul>
                <li><a href="#">Skin</a></li>
                <li><a href="#">Hair</a></li>
                <li><a href="#">Fragrance</a></li>
            </ul>
        </div>
        <div class="logo">
        <a href="<?php 
            if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                echo 'home.php?user=' . urlencode($_SESSION['username']);
            } else {
                echo 'home.php';
            }
        ?>"><img src="pink.PNG" class="logo-img" alt="Serene Skin Logo"></a>
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
        <div class="box form-box">
            <?php 

                if (isset($_POST['Cancel'])) {
                    header("Location: profile.php");
                }

               if (isset($_POST['submit'])) {
                   $newUsername = $_POST['username'];
                   $email = $_POST['email'];
                   $phone = $_POST['phone']; 
                   $dob = $_POST['dob'];
                   $gender = $_POST['gender'];

                   $id = $_SESSION['username'];

                   $edit_query = mysqli_query($conn, "UPDATE users SET username='$newUsername', email='$email', phone='$phone', DateOfBirth='$dob', gender='$gender' WHERE username='$id'") or die("Error occurred");

                   if ($edit_query) {

                    $_SESSION['username'] = $newUsername;

                       echo "<div class='message'>
                       <p>Profile Updated!</p>
                   </div> <br>";
                   echo "<a href='home.php?username=" . urlencode($newUsername) . "'><button class='btn'>Go Home</button></a>";
                   }
               } else {
                   $username = $_SESSION['username'];
                   $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

                   while ($result = mysqli_fetch_assoc($query)) {
                       $res_Uname = $result['username'];
                       $res_Email = $result['email'];
                       $res_Phone = $result['phone'];
                       $res_Dob = $result['DateOfBirth'];
                       $res_Gender = $result['gender'];
                   }
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $res_Phone; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="<?php echo $res_Dob; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?php if($res_Gender == 'male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if($res_Gender == 'female') echo 'selected'; ?>>Female</option>
                        <option value="other" <?php if($res_Gender == 'other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                    <input type="submit" class="btn" name="Cancel" value="Cancel" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
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
