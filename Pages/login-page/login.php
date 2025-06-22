<?php

session_start();

$adminUsername = "admin";
$adminPassword = "admin123";

if (isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .btn-custom {
            width: 100%;
        }
        .forgot-password {
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
        #loginButton {
            background-color:rgb(0, 0, 0);
        }
        #createAccountButton {
            background-color:rgb(255, 255, 255);
            color: black;
            
        }
    </style>
</head>
<body>
    <div class="login-card">
        <?php


        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
            $login = trim($_POST["username"]);
            $password = $_POST["password"];
        
            // Check if the login is for the admin account
            if ($login === $adminUsername && $password === $adminPassword) {
                $_SESSION["user"] = $adminUsername;
                header("Location: ../shop-page/admin.php");
                exit();
            }
        }
        // Check if the login is for a regular user account
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
            $login = trim($_POST["username"]);
            $password = $_POST["password"];
            require_once "database.php";

            try {
                // Allow login with username OR email
                $sql = "SELECT * FROM users WHERE username = :login OR email = :login";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user"] = $user["username"];
                        header("Location: ../../index.php");
                        $_SESSION["user_id"] = $user["id"]; // Add this line to store the user ID
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Username or Email does not match</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group mb-3">
                <input type="text" placeholder="Username/Email" name="username" class="form-control" required>
            </div>
            <div class="form-group mb-3 password-container">
                <input type="password" id="password" placeholder="Password" name="password" class="form-control" required>
                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
            </div>
            <div class="form-group mb-3">
                <input type="submit" value="Log in" name="login" class="btn btn-primary btn-custom" id="loginButton">
            </div>
            <div class="text-center mb-3">
                <a href="#" class="forgot-password">Forgotten password?</a>
            </div>
        </form>
        <div class="text-center" >
            <a href="registration.php" class="btn btn-success btn-custom" id='createAccountButton'>Create new account</a>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>