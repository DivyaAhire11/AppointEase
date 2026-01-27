<?php
session_start();
include "../../config/db.php";

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit;
}

$message = "";
$message_type = ""; // success or error

/* SIGNUP */
if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "All fields are required!";
        $message_type = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters!";
        $message_type = "error";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match!";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
        $message_type = "error";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check_query = "SELECT id FROM users WHERE email = $1";
        $check_result = pg_query_params($conn, $check_query, array($email));

        if (pg_num_rows($check_result) > 0) {
            $message = "Email already registered! Please login or use a different email.";
            $message_type = "error";
        } else {
            // Insert new user
            $insert_query = "INSERT INTO users (name, email, password) VALUES ($1, $2, $3) RETURNING id";
            $insert_result = pg_query_params($conn, $insert_query, array($name, $email, $hashed_password));

            if ($insert_result) {
                $message = "Signup successful! Please login with your credentials.";
                $message_type = "success";
            } else {
                $message = "Signup failed. Please try again.";
                $message_type = "error";
            }
        }
    }
}

/* LOGIN */
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Email and password are required!";
        $message_type = "error";
    } else {
        // Query to find user
        $query = "SELECT id, name, email, password FROM users WHERE email = $1";
        $result = pg_query_params($conn, $query, array($email));

        if (pg_num_rows($result) > 0) {
            $user = pg_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['login_time'] = date('Y-m-d H:i:s');

                header("Location: ../dashboard.php");
                exit;
            } else {
                $message = "Invalid password!";
                $message_type = "error";
            }
        } else {
            $message = "Email not found. Please signup first!";
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
    <title>Login - AppointEase</title>
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

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .form-group input::placeholder {
            color: #999;
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

        .btn-primary:active {
            transform: translateY(0);
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

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
            cursor: pointer;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-weight: 400;
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
        <h1>AppointEase</h1>
        <p>Healthcare Appointment Booking System</p>
    </div>

    <!-- Form Content -->
    <div class="form-content">
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <div id="loginForm" class="form-section active">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me" name="remember">
                    <label for="remember-me">Remember me</label>
                </div>

                <button type="submit" name="login" class="btn btn-primary">Login</button>

                <div class="toggle-form">
                    <a href="forgot_password.php" style="font-size: 12px;">Forgot Password?</a>
                </div>

                <div class="toggle-form">
                    Don't have an account? <a onclick="toggleForm()">Signup here</a>
                </div>
            </form>
        </div>

        <!-- SIGNUP FORM -->
        <div id="signupForm" class="form-section">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="signup-name">Full Name</label>
                    <input type="text" id="signup-name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="signup-email">Email Address</label>
                    <input type="email" id="signup-email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="password" placeholder="At least 6 characters" required>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                </div>

                <button type="submit" name="signup" class="btn btn-primary">Create Account</button>

                <div class="toggle-form">
                    Already have an account? <a onclick="toggleForm()">Login here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2026 AppointEase. All rights reserved. | <a href="../../index.php">Back to Home</a></p>
    </div>
</div>

<script>
    function toggleForm() {
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');

        loginForm.classList.toggle('active');
        signupForm.classList.toggle('active');

        // Clear form fields when switching
        document.querySelectorAll('input').forEach(input => {
            if (input.type !== 'checkbox') {
                input.value = '';
            }
        });
    }

    // Add enter key functionality
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const activeForm = document.querySelector('.form-section.active form');
            const submitBtn = activeForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                activeForm.submit();
            }
        }
    });
</script>

</body>
</html>
