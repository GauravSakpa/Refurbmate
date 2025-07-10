<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Validate password strength
    if (strlen($password) < 6) {
        die("Password must be at least 6 characters long");
    }

    // Validate password confirmation
    if ($password !== $confirm_password) {
        die("Passwords do not match");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }
        header,
        footer {
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        header {
            top: 0;
        }
        footer {
            bottom: 0;
        }
        main {
            flex: 1;
            margin-top: 60px; /* Adjust according to header height */
            margin-bottom: 60px; /* Adjust according to footer height */
            overflow-y: auto;
        }
        .banner {
            width: 100%;
            background-image: linear-gradient(rgba(255, 255, 255, 0.75), #35c1bebf);
            background-size: cover;
            background-position: center;
        }
        .navbar {
            margin: auto;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            width: 120px;
            cursor: pointer;
        }
        .navbar ul li {
            list-style: none;
            display: inline-block;
            margin: 0 20px;
            position: relative;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #080808;
            text-transform: uppercase;
        }
        .navbar ul li::after {
            content: '';
            height: 3px;
            width: 0%;
            background: #009688;
            position: absolute;
            left: 0;
            bottom: -10px;
            transition: 0.5s;
        }
        .navbar ul li:hover::after {
            width: 100%;
        }
        .dropdown:hover .dropdown-content {
            display: block;
            height: max-content;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
            padding: 10px; /* Add padding inside the dropdown */
        }
        .dropdown-content li {
            padding: 5px 10px; /* Add padding around each list item */
        }
        .dropdown-content li a {
            display: block; /* Ensure the padding is applied properly */
            padding: 8px 12px; /* Add padding inside each link */
            text-decoration: none;
            color: white;
        }
        .dropdown-content li a:hover {
            background-color: #575757;
        }
        .logout-link {
            color: white;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Adjust width */
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            padding-top: 45px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        label {
            text-align: left;
            font-weight: bold;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        button {
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }        
        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        footer {
            background-color: #7e908f;
            color: white;
            padding: 25px 0;
            width: 100%;
        }
        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .footer-left, .footer-center, .footer-right {
            flex: 1;
            text-align: center;
        }
        .footer-center ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-center ul li {
            display: inline-block;
            margin: 0 10px;
        }
        .footer-center ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        .footer-center ul li a:hover {
            text-decoration: underline;
        }
        .footer-right a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        .footer-right a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
            .footer-center ul li {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <header class="banner">
        <div class="navbar cor">
            <h1>Refurbmate</h1>
            <ul>
                <li><a href="signup.php">Home</a></li>
                <li><a href="login.php">Log in</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </div>
    </header>
    <main>
        <h2>Sign Up</h2>
        <form method="POST" action="signup.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br>
            <button type="submit">Sign Up</button>
        </form>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <p>&copy; 2025 Refurbmate. All rights reserved.</p>
                <p>Developed By: Gaurav</p>
            </div>
            <div class="footer-center">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about_us.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="privacy_policy.html">Privacy Policy</a></li>
                </ul>
                <p>Customer Support and Service Center 80008585</p>
            </div>
            <div class="footer-right">
                <p>Follow us:</p>
                <a href="https://www.facebook.com" target="_blank">Facebook</a> |
                <a href="https://twitter.com" target="_blank">Twitter</a> |
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
    </footer>
</body>
</html>