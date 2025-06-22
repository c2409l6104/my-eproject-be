<?php
session_start();



// Redirect if user is already logged in
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
    <title>Registration Form</title>
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
            background-color:rgb(0, 0, 0);
        }
        .login-link {
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <?php
        if (isset($_POST["submit"])) {
            $username = trim($_POST["username"]);
            
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $errors = array();

            if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Passwords do not match");
            }

            require_once "database.php";

            try {
                $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->fetchColumn() > 0) {
                    array_push($errors, "Email already exists!");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Registration failed.</div>";
                    }
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
        }
        
        ?>
        <form action="registration.php" method="post">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-3 password-container">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
            </div>
            <div class="form-group mb-3 password-container">
                <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password" required>
                <i class="bi bi-eye-slash password-toggle" id="toggleRepeatPassword"></i>
            </div>
            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary btn-custom" value="Register" name="submit">
            </div>
        </form>
        <div class="text-center">
            <a href="login.php" class="login-link">Already Registered? Login Here</a>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const toggleRepeatPassword = document.getElementById('toggleRepeatPassword');
        const password = document.getElementById('password');
        const repeatPassword = document.getElementById('repeat_password');

        togglePassword.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        toggleRepeatPassword.addEventListener('click', function () {
            const type = repeatPassword.type === 'password' ? 'text' : 'password';
            repeatPassword.type = type;
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>