<?php
session_start();
require_once "../login-page/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$product_id = $_POST["product_id"];
$quantity = $_POST["quantity"];

// Check if product is already in cart
$sql = "SELECT * FROM carts WHERE user_id = :user_id AND product_id = :product_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ":user_id" => $user_id,
    ":product_id" => $product_id
]);

if ($stmt->rowCount() > 0) {
    // Update quantity
    $update = $conn->prepare("UPDATE carts SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id");
    $update->execute([
        ":quantity" => $quantity,
        ":user_id" => $user_id,
        ":product_id" => $product_id
    ]);
} else {
    // Insert new item
    $insert = $conn->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    $insert->execute([
        ":user_id" => $user_id,
        ":product_id" => $product_id,
        ":quantity" => $quantity
    ]);
}

header("Location: shop.php");
exit();
?>
