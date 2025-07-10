<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = $_GET['order_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_id, $_SESSION['user_id']);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT products.name, order_items.quantity, products.price 
                        FROM order_items 
                        JOIN products ON order_items.product_id = products.id 
                        WHERE order_items.order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items = $stmt->get_result();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Order Confirmation</title>
    <style>
        .order-confirmation-page {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .order-confirmation-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details, .order-items {
            margin-bottom: 20px;
        }
        .order-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .order-item h3 {
            margin-bottom: 5px;
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
        <link rel="stylesheet" href="phone.css">
    </header>
    <main>
        <div class="order-confirmation-page">
            <div class="order-confirmation-header">
                <h1>Order Confirmation</h1>
            </div>
            <div class="order-details">
                <h2>Order Details</h2>
                <p>Order ID: <?php echo $order['id']; ?></p>
                <p>Address: <?php echo htmlspecialchars($order['address']); ?></p>
                <p>City: <?php echo htmlspecialchars($order['city']); ?></p>
                <p>State: <?php echo htmlspecialchars($order['state']); ?></p>
                <p>ZIP Code: <?php echo htmlspecialchars($order['zip_code']); ?></p>
                <p>Country: <?php echo htmlspecialchars($order['country']); ?></p>
                <p>Total Price: ₹<?php echo number_format($order['total_price'], 2); ?></p>
            </div>
            <div class="order-items">
                <h2>Order Items</h2>
                <?php while ($item = $order_items->fetch_assoc()): ?>
                    <div class="order-item">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Quantity: <?php echo $item['quantity']; ?></p>
                        <p>Price: ₹<?php echo number_format($item['price'], 2); ?></p>
                    </div>
                <?php endwhile; ?>
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
</body>
</html>