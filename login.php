<?php
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get form data
    $login = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :login OR email = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verify password
        if (password_verify($password, $user['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Username or email not found. Please register first.";
    }
}


?>