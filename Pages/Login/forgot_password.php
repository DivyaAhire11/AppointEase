<?php
include "../../config/db.php";

$message = "";
$message_type = "";

// Handle password reset request
if (isset($_POST['reset_password'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $message = "Please enter your email address";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
        $message_type = "error";
    } else {
        // Check if email exists
        $query = "SELECT id FROM users WHERE email = $1";
        $result = pg_query_params($conn, $query, array($email));

        if (pg_num_rows($result) > 0) {
            // In production, you would send an actual email with reset link
            // For now, we'll show a temporary password
            $temp_password = substr(md5(time() . $email), 0, 10);
            
            // Update password (in production, use a token-based approach)
            $hashed_temp_password = password_hash($temp_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET password = $1 WHERE email = $2";
            $update_result = pg_query_params($conn, $update_query, array($hashed_temp_password, $email));

            if ($update_result) {
                $message = "⚠️ A temporary password has been generated. In production, this would be sent via email. Temporary password: <strong>" . $temp_password . "</strong><br>Please use this to log in and change your password.";
                $message_type = "success";
            } else {
                $message = "An error occurred. Please try again later.";
                $message_type = "error";
            }
        } else {
            $message = "Email not found in our system";
            $message_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - AppointEase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .form-content {
            padding: 40px;
        }

        .message {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideIn 0.3s ease-in-out;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .toggle-form {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .toggle-form a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .toggle-form a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            font-size: 13px;
            color: #666;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #667eea;
            padding: 12px 15px;
            border-radius: 4px;
            font-size: 13px;
            color: #004085;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .container {
                max-width: 100%;
            }

            .form-content {
                padding: 30px 20px;
            }

            .form-header {
                padding: 25px 15px;
            }

            .form-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="form-header">
        <h1>Reset Password</h1>
        <p>Recover your account access</p>
    </div>

    <!-- Form Content -->
    <div class="form-content">
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="info-box">
            ℹ️ Enter your email address and we'll help you reset your password.
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your registered email" required>
            </div>

            <button type="submit" name="reset_password" class="btn btn-primary">Send Reset Link</button>

            <div class="toggle-form">
                <a href="login.php">Back to Login</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2026 AppointEase. All rights reserved.</p>
    </div>
</div>

</body>
</html>
