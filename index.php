<?php
session_start();
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(248, 249, 251),rgb(174, 20, 20));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 15px;
            background:rgb(242, 228, 228);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h3 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 30px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }
        button {
            background: linear-gradient(90deg,rgb(84, 94, 100),rgb(214, 134, 111)); 
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            transition: 0.3s ease;
        }
        button:hover {
            opacity: 0.9;
        }
        a {
            text-decoration: none;
            color: #72c6ef;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Login</h3>
        <form method="POST">
            <div class="mb-3">
                <input type="username" name="username" placeholder="Enter Username" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
        <p><a href="forgot_password.php">Forgot Password?</a></p>
    </div>
</body>
</html>
