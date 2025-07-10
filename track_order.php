<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

// Fetch user's orders from the database
$order_found = false;
if ($order_id) {
    $stmt = $conn->prepare("SELECT orders.id as order_id, orders.total_price, orders.status, order_items.product_id, products.name as product_name, products.price as product_price, order_items.quantity 
                            FROM orders 
                            JOIN order_items ON orders.id = order_items.order_id 
                            JOIN products ON order_items.product_id = products.id 
                            WHERE orders.user_id = ? AND orders.id = ?");
    $stmt->bind_param("ii", $user_id, $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();
    $order_found = $orders->num_rows > 0;
    $stmt->close();
    
    if (!$order_found) {
        $error_message = "No orders found with the provided Order ID.";
    }
} else {
    $orders = [];
    $error_message = "Please enter an Order ID to search.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="track_order.css">
    <title>Track Order</title>
    <style>
        main {
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
        .order-management {
            margin: 20px;
        }
        .order-management h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .orders-table th, .orders-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .orders-table th {
            background-color: #35c1be7d;
            text-align: left;
        }
        .orders-table tr:hover {
            background-color: #f1f1f1;
        }
        .status-bar {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .status-step {
            text-align: center;
            position: relative;
            flex: 1;
        }
        .status-step::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            width: 100%;
            height: 2px;
            background-color: #ddd;
            z-index: -1;
        }
        .status-step:first-child::before {
            content: none;
        }
        .status-step.completed::before,
        .status-step.completed .status-icon {
            background-color: #35c1be;
            color: white;
        }
        .status-icon {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            margin-bottom: 10px;
        }
        .error-message {
            color: red;
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
                    <li><a href="track_order.php">Track Order</a></li>
                    <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
                <li class="cart-container">
                    <img src="cart3.png" alt="Cart Logo">
                    <a href="view_cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </header>
    <main>
        <div class="order-management">
            <h2>Track Your Order</h2>
            <form id="search-form" action="track_order.php" method="get">
                <label for="order_id">Track Order by Order ID:</label>
                <input type="text" id="order_id" name="order_id" placeholder="Enter Order ID" value="<?php echo htmlspecialchars($order_id); ?>">
                <button type="submit">Search</button>
            </form>
            <?php if ($order_id && !$order_found): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <div id="order-details" style="display: <?php echo $order_found ? 'block' : 'none'; ?>;">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($order_found): ?>
                            <?php while ($order = $orders->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $order['order_id']; ?></td>
                                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                    <td>₹<?php echo number_format($order['product_price'], 2); ?></td>
                                    <td><?php echo $order['quantity']; ?></td>
                                    <td>₹<?php echo number_format($order['total_price'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if ($order_found): ?>
                    <div class="status-bar">
                        <div class="status-step <?php echo ($order['status'] == 'Ordered' || $order['status'] == 'Shipped' || $order['status'] == 'Out for Delivery' || $order['status'] == 'Delivered') ? 'completed' : ''; ?>">
                            <div class="status-icon">1</div>
                            <div>Ordered</div>
                        </div>
                        <div class="status-step <?php echo ($order['status'] == 'Shipped' || $order['status'] == 'Out for Delivery' || $order['status'] == 'Delivered') ? 'completed' : ''; ?>">
                            <div class="status-icon">2</div>
                            <div>Shipped</div>
                        </div>
                        <div class="status-step <?php echo ($order['status'] == 'Out for Delivery' || $order['status'] == 'Delivered') ? 'completed' : ''; ?>">
                            <div class="status-icon">3</div>
                            <div>Out for Delivery</div>
                        </div>
                        <div class="status-step <?php echo ($order['status'] == 'Delivered') ? 'completed' : ''; ?>">
                            <div class="status-icon">4</div>
                            <div>Delivered</div>
                        </div>
                    </div>
                <?php endif; ?>
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