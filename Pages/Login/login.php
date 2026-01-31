<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup - AppointEase</title>
    <link rel="stylesheet" href="../../Style/base/navbar.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #006d77 0%, #00897b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            display: flex;
            gap: 30px;
            width: 100%;
            max-width: 900px;
        }

        .auth-form {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            flex: 1;
            min-width: 300px;
        }

        .auth-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #006d77;
            font-size: 26px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            border-color: #006d77;
            box-shadow: 0 0 0 3px rgba(0, 109, 119, 0.1);
            outline: none;
        }

        .message {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 500;
            display: none;
        }

        .message.show {
            display: block;
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

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #006d77 0%, #00897b 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 109, 119, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 30px 0 20px;
            position: relative;
            color: #999;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #ddd;
            z-index: 0;
        }

        .divider span {
            background: white;
            padding: 0 10px;
            position: relative;
            z-index: 1;
        }

        .toggle-form {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .toggle-form a {
            color: #006d77;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .toggle-form a:hover {
            text-decoration: underline;
        }

        .form-hidden {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                gap: 20px;
            }

            .auth-form {
                padding: 30px 20px;
            }

            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include "auth.php"; ?>

    <div class="auth-container">
        <!-- Login Form -->
        <div class="auth-form" id="loginForm">
            <h2>Login</h2>

            <?php if (!empty($message) && isset($_POST['login'])): ?>
                <div class="message show <?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="login">Login</button>
            </form>

            <div class="toggle-form">
                Don't have an account? <a onclick="toggleForms()">Sign Up</a>
            </div>
        </div>

        <!-- Signup Form -->
        <div class="auth-form form-hidden" id="signupForm">
            <h2>Create Account</h2>

            <?php if (!empty($message) && isset($_POST['signup'])): ?>
                <div class="message show <?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

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
                    <input type="password" id="signup-password" name="password" placeholder="Min. 6 characters" required>
                </div>

                <div class="form-group">
                    <label for="signup-confirm">Confirm Password</label>
                    <input type="password" id="signup-confirm" name="password_confirm" placeholder="Re-enter password" required>
                </div>

                <button type="submit" name="signup">Sign Up</button>
            </form>

            <div class="toggle-form">
                Already have an account? <a onclick="toggleForms()">Login</a>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            loginForm.classList.toggle('form-hidden');
            signupForm.classList.toggle('form-hidden');
        }

        // Check if there was an error and show appropriate form
        document.addEventListener('DOMContentLoaded', function() {
            const message = document.querySelector('.message.show');
            if (message && message.classList.contains('error')) {
                const form = message.closest('.auth-form');
                if (form.id === 'signupForm') {
                    document.getElementById('loginForm').classList.add('form-hidden');
                } else {
                    document.getElementById('signupForm').classList.add('form-hidden');
                }
            }
        });
    </script>
</body>
</html>
