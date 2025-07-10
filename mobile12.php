<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobile2.css">
    <title>SAMSUNG Galaxy S21 FE 5G (Lavender, 128 GB, 8 GB RAM)</title>
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
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
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
        <div class="product-page">
            <div class="product-header">
                <h1>SAMSUNG Galaxy S21 FE 5G (Lavender, 128 GB, 8 GB RAM)</h1>
            </div>
            <div class="product-main">
                <div class="product-image">
                    <img src="SAMSUNG Galaxy S21 FE.webp" alt="SAMSUNG Galaxy S21 FE 5G">
                    <div class="buy-buttons">
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="12">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-details">
                    <h2>Product Description</h2>
                    <p>The SAMSUNG Galaxy S21 FE 5G in Lavender is a premium mobile device that offers advanced features and a sleek design. It comes with 128 GB of storage and 8 GB of RAM, providing ample space and performance for all your needs. The 5G capability ensures fast internet speeds and seamless connectivity.</p>
                    <h2>Key Features</h2>
                    <ul>
                        <li>128 GB Storage</li>
                        <li>8 GB RAM</li>
                        <li>5G Mobile Network</li>
                        <li>Lavender Color</li>
                        <li>Advanced Camera System</li>
                        <li>High-Resolution Display</li>
                        <li>Long-Lasting Battery Life</li>
                    </ul>
                    <h2>Pricing</h2>
                    <p class="product-price">Starting from ₹1,249/m or ₹29,999</p>
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
                    <li><a href="about_us.php">About</a></li>
                    <li><a href="phone.php">Contact</a></li>
                    <li><a href="about_us.php">Privacy Policy</a></li>
                    <p>Traffic WhatsApp Helpline: 8454999999 Alert Citizen: 103 Control Room: 100 Senior Citizen: 1090</p>            
                </ul>
            </div>
            <div class="footer-right">
                <p>Follow us:</p>
                <a href="https://www.facebook.com" target="_blank">Facebook</a> |
                <a href="https://twitter.com" target="_blank">Twitter</a> |
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <p>Contact us: 8425888548</p>
            </div>
        </div>
    </footer>
</body>
</html>