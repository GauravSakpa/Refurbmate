<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_user_id'])) {
    header("Location: login_admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    if ($stmt->execute()) {
        header("Location: admin_index.php?status=updated");
    } else {
        header("Location: admin_index.php?status=error");
    }
    $stmt->close();
}
$conn->close();
?>