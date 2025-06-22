<?php
session_start();
require_once "../login-page/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
    $user_id = $_SESSION["user_id"];
    $product_id = $_POST["product_id"];

    $sql = "DELETE FROM carts WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'product_id' => $product_id
    ]);
}

header("Location: cart.php");
exit();
