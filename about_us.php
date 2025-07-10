<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Refurbmate</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}
h1 {
    color: Grey;
    font-size: 2em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
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
.content {
    text-align: center;
    color: #fff;
    padding: 0px 100px;
    flex: 1;
}
.content h1 {
    font-size: 70px;
    margin-top: 80px;
}
button {
    width: 200px;
    padding: 15px 0;
    text-align: center;
    margin: 20px 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid #009688;
    background: transparent;
    color: #7b7979;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
span {
    background: #009688;
    height: 100%;
    width: 0%;
    border-radius: 25px;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
    transition: 0.5s;
}
button:hover span {
    width: 100%;
}
button:hover {
    border: none;
}
.cor {
    background-color: #8080800a;
}
        .gallery-container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 900px;
            margin: 15px auto; /* Center the gallery */
        }
        .gallery h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #333;
            display: inline-block;
            padding-bottom: 5px;
        }
        .gallery {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap; /* Allow images to wrap */
            gap: 7px;
        }
        .gallery img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin: 5px;
        } main {
            flex: 1;
            overflow-y: auto;
        }
        .cart-container {
            display: flex;
            align-items: center;
        }
        .cart-container img {
            width: 24px;
            height: 24px;
            margin-right: 5px;
        }
        .cart-container a {
            text-decoration: none;
            color: #080808;
            text-transform: uppercase;
        }
        container {
    flex: 1;
    margin: 63px auto 70px;
    padding: 43px;
    max-width: 810px;
    background: #d1d1d18e;
    border-radius: 44px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

        h2 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        p {
    margin-bottom: 15px;
    color: #000000;
    line-height: 1.6;
    text-align: center;
}

footer {
    background-color: #7e908f;
    color: white;
    padding: 25px 0;
    width: 100%;
    margin-top: 7px;
}
footer p{
    color: #fff;
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
                <li><a href="phone.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="logout.php">Log out</a></li>
                <?php endif; ?>
                <li>
                    <a href="track_order.php">Orders</a>
                </li>
                <li class="cart-container">
                    <img src="cart3.png" alt="Cart Logo">
                    <a href="view_cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <div class="contain">
            <h2>About Us</h2>
            <p>Welcome to Refurbmate, your number one source for all refurbished mobile phones. We're dedicated to giving you the very best of refurbished phones, with a focus on quality, customer service, and uniqueness.</p>
            <p>Founded in 2025 by Gaurav, Refurbmate has come a long way from its beginnings. When Gaurav first started out, his passion for eco-friendly and cost-effective mobile solutions drove him to start Refurbmate.</p>
            <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
            <p>Sincerely,<br>Gaurav</p>

            <!-- Photo Gallery Container -->
            <div class="gallery-container">
                <h2>Our Gallery</h2>
                <div class="gallery">
                    <img src="factory1.jpg" alt="Gallery Image 1">
                    <img src="factory2.jpg" alt="Gallery Image 2">
                    <img src="factory3.jpg" alt="Gallery Image 3">
                    <img src="factory4.jpg" alt="Gallery Image 4">
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <p>&copy; 2025 Refurbmate. All rights reserved.</p>
                <p>Developed By: Gaurav</p>
            </div>
            <div class="footer-center">
                <ul>
                    <li><a href="phone.php">Home</a></li>
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="phone.php">Contact</a></li>
                    <li><a href="about_us.html">Privacy Policy</a></li>
                    <p>Customer Support and Service Center 80008585
                    </p>
                </ul>
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