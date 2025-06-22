<?php
session_start();
require_once './login-page/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'];
    $address = $_POST['address'] ?? null;
    $shipping_method = $_POST['shipping_method'] ?? 'standard';
    $payment_method = $_POST['payment_method'] ?? 'credit_card';
    $note = $_POST['note'] ?? null;
    $total = floatval($_POST['total']);
    $userId = $_SESSION["user_id"] ?? null; // Assume user is logged in

    if (!$userId) {
        header("Location: login.php?error=1");
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO orders (user_id, fullname, phone, email, address, shipping_method, payment_method, note, total_amount, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $fullname, $phone, $email, $address, $shipping_method, $payment_method, $note, $total]);
        $order_id = $conn->lastInsertId();

        if (!empty($_SESSION['cart'])) {
            $stmt_detail = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
            foreach ($_SESSION['cart'] as $item) {
                $productId = $item['product_id'] ?? $item['name']; // Adjust based on cart structure
                $quantity = $item['quantity'];
                $unitPrice = $item['unit_price'];
                $stmt_detail->execute([$order_id, $productId, $quantity, $unitPrice]);
            }
            $stmt_detail->close();
        }

        unset($_SESSION['cart']);
        header("Location: ./shop-page/shop.php?success=1");
        exit();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        // Optionally redirect with error
        header("Location: checkout.php?error=1");
        exit();
    }
} else {
    header("Location: checkout.php?error=1");
    exit();
}
?>