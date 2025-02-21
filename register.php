<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Use PDO syntax instead
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password)");
    
    // Bind parameters using PDO
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        header("Location: index.php?message=success");
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt = null;  
    $conn = null;  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(248, 249, 251),rgb(174, 20, 20)); 
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 20px;
            border: 1px solid #ccc;
            padding: 10px 15px;
        }

        button {
            background: linear-gradient(90deg,rgb(84, 94, 100),rgb(214, 134, 111));
            color: white;
            border: none;
            padding: 10px;
            border-radius: 25px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            opacity: 0.9;
        }

        .forgot-password {
            display: block;
            margin-top: 15px;
            color: #72c6ef;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Register</h3>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="username" placeholder="Enter Username" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter Password" class="form-control" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="index.php" style="color: #72c6ef;">Login</a></p>
        <a href="#" class="forgot-password">Forgot Password?</a>
    </div>
</body>
</html>
