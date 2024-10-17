<?php 
session_start();
include 'db.php'; // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Register</title>
    <style>
        /* General Styles */
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
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }

        .box {
            background: #fdfdfd;
            display: flex;
            flex-direction: column;
            padding: 30px 30px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08);
        }

        .form-box {
            width: 550px;
            margin: 20px 10px;
            padding: 50px;
        }

        .form-box header {
            font-size: 25px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
            margin-bottom: 10px;
        }

        .form-box form .field {
            display: flex;
            margin-bottom: 10px;
            flex-direction: column;
        }

        .form-box form .input input,
        .form-box form .input select {
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

        .message {
            text-align: center;
            background: #f9eded;
            padding: 15px 0px;
            border: 1px solid #699053;
            border-radius: 5px;
            margin-bottom: 10px;
            color: rgb(24, 157, 215);
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
            gap: 50px;
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
            <button><a href="login.php">Login</a></button>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="box form-box">
        <?php 
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $password = $_POST['password']; 

            $stmt = $conn->prepare("SELECT * FROM users WHERE Email=? OR Username=?");
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows != 0){
                echo "<div class='message'>
                        <p>This email/username is already in use, please try another one.</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
            } else {
                $stmt = $conn->prepare("INSERT INTO users (Username, Email, Phone, DateOfBirth, Gender, Password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $username, $email, $phone, $dob, $gender, $password);

                if($stmt->execute()){
                    echo "<div class='message'>
                            <p>Registration successful!</p>
                          </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
                } else {
                    echo "<div class='message'>
                            <p>An error occurred. Please try again later.</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }
            }
            $stmt->close();
            $conn->close();
        } else {
        ?>
        <header>Sign Up</header>
        <form action="" method="post" onsubmit="return validateForm()">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" required>
            </div>

            <div class="field input">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" name="submit" class="btn">Register</button>
        </form>
        <?php } ?>
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

<script>
function validateForm() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const dob = document.getElementById('dob').value;
    const gender = document.getElementById('gender').value;
    const password = document.getElementById('password').value;

    // Check if all fields are filled
    if (!username || !email || !phone || !dob || !gender || !password) {
        alert('Please fill in all fields.');
        return false;
    }

    // Validate email format
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    // Validate phone number format (example: (123) 456-7890 or 123-456-7890)
    const phonePattern = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
    if (!phonePattern.test(phone)) {
        alert('Please enter a valid phone number (e.g., (123) 456-7890 or 123-456-7890).');
        return false;
    }

   

    // Validate age (must be 13 or older)
    const birthDate = new Date(dob);
    const today = new Date();
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    
    // If the user hasn't had their birthday this year yet, subtract 1 from age
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    if (age < 13) {
        alert('You must be at least 13 years old to register.');
        return false;
    }

    return true;
}
</script>


</body>
</html>
