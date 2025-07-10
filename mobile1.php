<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobile2.css">
    <title>iPhone 16 Pro Max 1 TB: 5G Mobile Phone (Desert Titanium)</title>
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
            </ul>
        </div>
    </header>
    <main>
        <div class="product-page">
            <div class="product-header">
                <h1>iPhone 16 Pro Max 1 TB: 5G Mobile Phone (Desert Titanium)</h1>
            </div>
            <div class="product-main">
                <div class="product-image">
                    <img src="i_phone16promax.jpg" alt="iPhone 16 Pro Max">
                    <div class="buy-buttons">
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="1"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-details">
                    <h2>Product Description</h2>
                    <p>The iPhone 16 Pro Max 1 TB in Desert Titanium is a premium mobile device that offers advanced features and a sleek design. It comes with 1 TB of storage, providing ample space for all your needs. The 5G capability ensures fast internet speeds and seamless connectivity.</p>
                    <h2>Key Features</h2>
                    <ul>
                        <li>1 TB Storage</li>
                        <li>5G Mobile Network</li>
                        <li>Desert Titanium Color</li>
                        <li>Advanced Camera System</li>
                        <li>High-Resolution Display</li>
                        <li>Long-Lasting Battery Life</li>
                    </ul>
                    <ul>
        <li><strong>Previous Owner:</strong> Corporate User</li>
        <li><strong>Mobile Origin:</strong> Assembled in India</li>
        <li><strong>Production Date:</strong> June 2023</li>
        <li><strong>Battery Health:</strong> 92%</li>
        <li><strong>Warranty:</strong> 6 Months Refurbmate Warranty</li>
        <li><strong>Refurbishment Status:</strong> A+ Grade, Screen & Battery Replaced</li>
        <li><strong>Accessories Included:</strong> Charger, Cable (Generic), Box</li>
        <li><strong>IMEI Status:</strong> Verified - Clean</li>
    </ul>
                    <h2>Pricing</h2>
                    <p class="product-price">Starting from ₹6,495/m or ₹1,55,900</p>
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