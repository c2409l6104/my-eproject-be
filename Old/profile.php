<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

$userId = $_SESSION["user_id"] ?? null;
$user = null;

try {
    if ($userId) {
        $sql = "SELECT id, username, email, userType FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $userType = $_POST["userType"];

        $sql = "UPDATE users SET username = :username, email = :email, userType = :userType WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':userType', $userType, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
            $user = array_merge($user, ['username' => $username, 'email' => $email, 'userType' => $userType]);
        } else {
            echo "<div class='alert alert-danger'>Failed to update profile.</div>";
        }
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if ($user): ?>
            <form action="profile.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="userType">User Type:</label>
                    <select class="form-control" name="userType" id="userType">
                        <option value="user" <?php echo ($user['userType'] ?? 'user') === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($user['userType'] ?? 'user') === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Update Profile" name="update">
                </div>
            </form>
            <div><p><a href="index.php">Back to Home</a></p></div>
        <?php else: ?>
            <div class="alert alert-warning">User data not found. Please log in again.</div>
            <p><a href="login.php">Login</a></p>
        <?php endif; ?>
    </div>
</body>
</html>