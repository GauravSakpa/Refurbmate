<?php
session_start();
require 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: login_admin.php");
    exit();
}

// Fetch summary data for the dashboard
// Total orders and revenue
$total_orders = $total_revenue = 0;
$ordered_orders = $shipped_orders = $out_for_delivery_orders = $delivered_orders = 0;

$stmt = $conn->prepare("SELECT COUNT(*) as total_orders, SUM(total_price) as total_revenue FROM orders");
$stmt->execute();
$stmt->bind_result($total_orders, $total_revenue);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as ordered_orders FROM orders WHERE status = 'Ordered'");
$stmt->execute();
$stmt->bind_result($ordered_orders);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as shipped_orders FROM orders WHERE status = 'Shipped'");
$stmt->execute();
$stmt->bind_result($shipped_orders);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as out_for_delivery_orders FROM orders WHERE status = 'Out for Delivery'");
$stmt->execute();
$stmt->bind_result($out_for_delivery_orders);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) as delivered_orders FROM orders WHERE status = 'Delivered'");
$stmt->execute();
$stmt->bind_result($delivered_orders);
$stmt->fetch();
$stmt->close();

// Fetch order data for Order Management with product details
$stmt = $conn->prepare("SELECT orders.id as order_id, products.name as product_name, products.price as product_price, orders.total_price, orders.status FROM orders JOIN order_items ON orders.id = order_items.order_id JOIN products ON order_items.product_id = products.id");
$stmt->execute();
$orders = $stmt->get_result();
$stmt->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Dashboard</title>
    <style>
        .dashboard-overview, .order-management {
            margin: 20px;
        }
        .dashboard-overview h2, .order-management h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .summary-box {
            background-color: #b3e6e8;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            display: inline-block;
            width: 30%;
        }
        .summary-box p {
            margin: 5px 0;
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
            background-color: #b3e6e8;
            text-align: left;
        }
        .orders-table tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            margin: 2px;
        }
        .action-buttons button:hover {
            background-color: #45a049;
        }
        /* Header and Footer CSS */
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
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        header, footer {
            flex-shrink: 0;
        }
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
        /* Footer Styling */
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
.col_sm1 {
    margin: 0 auto;
    width: 48%;
    padding: 0;
}
        
    </style>
</head>
<body>
    <header class="banner">
        <div class="navbar cor">
            <h1>Refurbmate</h1>
            <ul>
                <li><a href="phone.html">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <?php if (isset($_SESSION['admin_user_id'])): ?>
                    <li><a href="logout_admin.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <main>
        <div class="dashboard-overview">
            <h2>Dashboard Overview</h2>
            <div class="summary-box">
                <h3>Total Orders</h3>
                <p><?php echo $total_orders; ?></p>
            </div>
            <div class="summary-box">
                <h3>Total Revenue</h3>
                <p>₹<?php echo number_format($total_revenue, 2); ?></p>
            </div>
            <div class="summary-box">
                <h3>Ordered Orders</h3>
                <p><?php echo $ordered_orders; ?></p>
            </div>
            <div class="summary-box">
                <h3>Shipped Orders</h3>
                <p><?php echo $shipped_orders; ?></p>
            </div>
            <div class="summary-box">
                <h3>Out for Delivery Orders</h3>
                <p><?php echo $out_for_delivery_orders; ?></p>
            </div>
            <div class="summary-box">
                <h3>Delivered Orders</h3>
                <p><?php echo $delivered_orders; ?></p>
            </div>
        </div>

        <div class="order-management">
            <h2>Order Management</h2>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td>₹<?php echo number_format($order['product_price'], 2); ?></td>
                            <td>₹<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td>
                                <form action="update_order_status.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <select name="status">
                                        <option value="Ordered" <?php if ($order['status'] == 'Ordered') echo 'selected'; ?>>Ordered</option>
                                        <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                        <option value="Out for Delivery" <?php if ($order['status'] == 'Out for Delivery') echo 'selected'; ?>>Out for Delivery</option>
                                        <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                        <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" class="update-button">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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