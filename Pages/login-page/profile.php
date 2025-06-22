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
        $sql = "SELECT id, username, email, userType, password FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Handle profile update
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $userType = isset($_POST["userType"]) ? $_POST["userType"] : $user['userType']; // Only update userType if provided

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

    // Handle password change
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_password"])) {
        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        if (password_verify($currentPassword, $user["password"])) {
            if (strlen($newPassword) < 8) {
                echo "<div class='alert alert-danger'>New password must be at least 8 characters long.</div>";
            } elseif ($newPassword !== $confirmPassword) {
                echo "<div class='alert alert-danger'>New password and confirmation do not match.</div>";
            } else {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = :password WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':password', $newPasswordHash, PDO::PARAM_STR);
                $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Password updated successfully.</div>";
                    $user["password"] = $newPasswordHash; // Update in memory for consistency
                } else {
                    echo "<div class='alert alert-danger'>Failed to update password.</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Current password is incorrect.</div>";
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
                    <select class="form-control" name="userType" id="userType" <?php echo ($user['userType'] ?? 'user') === 'user' ? 'disabled' : ''; ?>>
                        <option value="user" <?php echo ($user['userType'] ?? 'user') === 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo ($user['userType'] ?? 'user') === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    <?php if (($user['userType'] ?? 'user') === 'user'): ?>
                        <small class="text-muted">Only admins can change user type.</small>
                    <?php endif; ?>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Update Profile" name="update">
                </div>
            </form>

            <!-- Change Password Form -->
            <h3 class="mt-4">Change Password</h3>
            <form action="profile.php" method="post">
                <div class="form-group position-relative">
                    <label for="current_password">Current Password:</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" required>
                    <span class="password-toggle" data-target="current_password">
                        <ion-icon name="eye-outline"></ion-icon>
                    </span>
                </div>
                <div class="form-group position-relative">
                    <label for="new_password">New Password:</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                    <span class="password-toggle" data-target="new_password">
                        <ion-icon name="eye-outline"></ion-icon>
                    </span>
                </div>
                <div class="form-group position-relative">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    <span class="password-toggle" data-target="confirm_password">
                        <ion-icon name="eye-outline"></ion-icon>
                    </span>
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Change Password" name="update_password">
                </div>
            </form>
            <div><p><a href="index.php">Back to Home</a></p></div>
        <?php else: ?>
            <div class="alert alert-warning">User data not found. Please log in again.</div>
            <p><a href="login.php">Login</a></p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.password-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('ion-icon');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.setAttribute('name', 'eye-off-outline');
                    } else {
                        input.type = 'password';
                        icon.setAttribute('name', 'eye-outline');
                    }
                });
            });
        });
    </script>
</body>
</html>