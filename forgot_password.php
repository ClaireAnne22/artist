<?php
include 'dbconnect.php';

$showForgotPasswordContainer = true; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32)); // Generate a secure token
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expiration time (1 hour from now)

        
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expiry) VALUES (:user_id, :token, :expiry)");
        $stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':expiry', $expiry, PDO::PARAM_STR);
        $stmt->execute();

        
        $resetLink = "http://localhost/Group_4/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n\n$resetLink\n\nThis link is valid for 1 hour.";
        $headers = "From: no-reply@yourdomain.com";

        
        if (mail($email, $subject, $message, $headers)) {
            echo "<script>alert('Password reset link sent to your email.');</script>";
        } else {
            echo "<script>alert('Failed to send the email. Please try again later.');</script>";

            
            error_log("Failed to send email to $email with token $token");
        }

        
        echo "<pre>";
        echo "Testing email parameters:\n";
        echo "To: $email\n";
        echo "Subject: $subject\n";
        echo "Message: $message\n";
        echo "Headers: $headers\n";
        echo "</pre>";
    } else {
        echo "<script>alert('Email address not found.');</script>";
    }

    
    $showForgotPasswordContainer = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        .forgot-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .forgot-container h3 {
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
    <?php if ($showForgotPasswordContainer): ?>
    <div class="forgot-container" id="forgot-password-container">
        <h3>Forgot Password</h3>
        <p>Enter your email address below, and we’ll send you a link to reset your password.</p>
        <form method="POST">
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
        <p class="mt-3"><a href="index.php">Back to Login</a></p>
    </div>
    <?php endif; ?>
</body>
</html>
