<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // Verify that the user_id exists in the users table
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Verify that the product_id exists in the products table
        $stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Add product to cart
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) 
                                    ON DUPLICATE KEY UPDATE quantity = quantity + 1");
            $stmt->bind_param("ii", $user_id, $product_id);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: view_cart.php");
            exit();
        } else {
            echo "Error: Product does not exist.";
        }
    } else {
        echo "Error: User does not exist.";
    }

    $stmt->close();
    $conn->close();
}
?>