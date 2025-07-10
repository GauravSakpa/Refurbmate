<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT products.id, products.name, products.price, products.image, cart.quantity 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$total_price = 0;
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_price += $row['price'] * $row['quantity'];
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Shopping Cart</title>
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
        <div class="cart-page">
            <div class="cart-header">
                <h1>Shopping Cart</h1>
            </div>
            <div class="cart-main">
                <div class="cart-items">
                    <?php if (empty($cart_items)): ?>
                        <p>Your cart is empty.</p>
                    <?php else: ?>
                        <?php foreach ($cart_items as $item): ?>
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" onerror="this.onerror=null;this.src='default_image.webp';">
                                </div>
                                <div class="cart-item-details">
                                    <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                                    <p>Price: ₹<?php echo number_format($item['price'], 2); ?></p>
                                    <p>Quantity: 
                                        <form action="update_cart.php" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;">
                                            <button type="submit" class="update-button">Update</button>
                                        </form>
                                    </p>
                                    <form action="remove_from_cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="remove-button">Remove</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="cart-summary">
                    <h2>Cart Summary</h2>
                    <p>Total Items: <?php echo array_reduce($cart_items, fn($carry, $item) => $carry + $item['quantity'], 0); ?></p>
                    <p>Total Price: ₹<?php echo number_format($total_price, 2); ?></p>
                    <button type="button" class="checkout-button" onclick="proceedToCheckout()">Proceed to Checkout</button>
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
    <script>
        function proceedToCheckout() {
            window.location.href = "checkout.php";
        }
    </script>
</body>
</html>