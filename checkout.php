<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
$buy_now = isset($_POST['buy_now']) ? intval($_POST['buy_now']) : null;

if ($buy_now && $product_id) {
    // Clear the cart for the "Buy Now" action
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Add product to cart for immediate checkout
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) 
                            ON DUPLICATE KEY UPDATE quantity = 1");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();
}

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['product_id'])) {
    // Handle form submission for checkout
    $full_name = $_POST['full-name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip-code'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone-number'];
    $payment_method = $_POST['payment-method']; // Get the payment method from the form

    // Insert order details into the database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, full_name, address, city, state, zip_code, country, phone_number, payment_method, total_price) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssd", $user_id, $full_name, $address, $city, $state, $zip_code, $country, $phone_number, $payment_method, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items into the database
    foreach ($cart_items as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) 
                                VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $order_id, $item['id'], $item['quantity']);
        $stmt->execute();
        $stmt->close();
    }

    // Clear the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Close the database connection after all operations
    $conn->close();

    // Redirect to an order confirmation page
    echo "<script>alert('Order Confirmed! Order ID: $order_id'); window.location.href = 'order_confirmation.php?order_id=$order_id';</script>";
    exit();
}

// Close the database connection after fetching cart items
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add&pay.css">
    <title>Address, Shipping & Payment</title>
    <style>
        .payment-form {
            margin-top: 20px;
        }

        .payment-form-details {
            margin-top: 10px;
            display: none; /* Hidden by default */
        }

        .confirm-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .confirm-button:hover {
            background-color: #45a049;
        }

        .order-summary {
            margin-top: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .order-item-image img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .order-item-details {
            flex-grow: 1;
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
    </header>
    <main>
        <div class="address-shipping-payment-page">
            <div class="header">
                <h1>Address, Shipping & Payment</h1>
            </div>
            <div class="main-content">
                <div class="address-form">
                    <h2>Shipping Address</h2>
                    <form id="shipping-form" method="POST" action="checkout.php">
                        <label for="full-name">Full Name:</label>
                        <input type="text" id="full-name" name="full-name" required>
                        
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                        
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                        
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" required>
                        
                        <label for="zip-code">Zip Code:</label>
                        <input type="text" id="zip-code" name="zip-code" required>
                        
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" required>
                        
                        <label for="phone-number">Phone Number:</label>
                        <input type="text" id="phone-number" name="phone-number" required>
                        
                        <div class="payment-form">
                            <h2>Payment Details</h2>
                            <label for="payment-method">Payment Method:</label>
                            <select id="payment-method" name="payment-method" required>
                                <option value="">Select Payment Method</option>
                                <option value="debit-card">Debit Card</option>
                            </select>
                            <div id="debit-card-form" class="payment-form-details">
                                <label for="card-number">Card Number:</label>
                                <input type="text" id="card-number" name="card-number" pattern="\d{16}" title="Card number must be 16 digits" required>
                                
                                <label for="expiry-date">Expiry Date:</label>
                                <input type="month" id="expiry-date" name="expiry-date" required>
                                </br>
                                
                                <label for="cvv">CVV:</label>
                                <input type="password" id="cvv" name="cvv" maxlength="3" pattern="[0-9]{3}" title="Enter a valid 3-digit CVV" required>

                                <label for="cardholder-name">Cardholder Name:</label>
                                <input type="text" id="cardholder-name" name="cardholder-name">
                            </div>
                            <button type="submit" class="confirm-button">Confirm Payment</button>
                        </div>
                    </form>
                </div>
                <div class="order-summary">
                    <h2>Order Summary</h2>
                    <?php if (empty($cart_items)): ?>
                        <p>Your cart is empty.</p>
                    <?php else: ?>
                        <?php foreach ($cart_items as $item): ?>
                            <div class="order-item">
                                <div class="order-item-image">
                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" onerror="this.onerror=null;this.src='default_image.webp';">
                                </div>
                                <div class="order-item-details">
                                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p>Price: ₹<?php echo number_format($item['price'], 2); ?></p>
                                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p>Total Price: ₹<?php echo number_format($total_price, 2); ?></p>
                    <?php endif; ?>
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
        document.getElementById('payment-method').addEventListener('change', function() {
            var paymentMethod = this.value;
            var debitCardForm = document.getElementById('debit-card-form');
            if (paymentMethod === 'debit-card') {
                debitCardForm.style.display = 'block';
            } else {
                debitCardForm.style.display = 'none';
            }
        });
    </script>
</body>
</html>