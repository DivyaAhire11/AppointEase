<?php
// This file is deprecated. Use Pages/Login/login.php instead.
// Redirect to new login page
header("Location: ../Pages/Login/login.php");
exit;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointment Login</title>
    <style>
        body {
            font-family: Arial;
            background: #e8f0fe;
        }
        .container {
            width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #4285f4;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #2b6adf;
        }
        .message {
            color: red;
            text-align: center;
        }
        .toggle {
            text-align: center;
            margin-top: 10px;
            cursor: pointer;
            color: blue;
        }
        .signup {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <p class="message"><?php echo $message; ?></p>

    <!-- LOGIN FORM -->
    <div class="login">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="toggle" onclick="showSignup()">Create an account</div>
    </div>

    <!-- SIGNUP FORM -->
    <div class="signup">
        <h2>Signup</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Signup</button>
        </form>
        <div class="toggle" onclick="showLogin()">Already have an account?</div>
    </div>
</div>

<script>
function showSignup() {
    document.querySelector('.login').style.display = 'none';
    document.querySelector('.signup').style.display = 'block';
}

function showLogin() {
    document.querySelector('.signup').style.display = 'none';
    document.querySelector('.login').style.display = 'block';
}
</script>

</body>
</html>
