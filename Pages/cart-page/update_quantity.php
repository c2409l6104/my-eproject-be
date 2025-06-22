<?php
session_start();
require_once "../login-page/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$product_id = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? null;

if ($product_id && $quantity && $quantity > 0) {
    $sql = "UPDATE carts SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'quantity' => $quantity,
        'user_id' => $user_id,
        'product_id' => $product_id
    ]);
}

header("Location: cart.php");
exit();
