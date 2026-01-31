<?php
/**
 * AppointEase User Authentication Handler
 * Handles login and signup functionality
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../../config/db.php";

$message = "";
$message_type = ""; // success, error

/**
 * Validate email format
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Sanitize user input
 */
function sanitizeInput($input) {
    return trim(stripslashes(htmlspecialchars($input)));
}

/* ========== SIGNUP HANDLER ========== */
if (isset($_POST['signup'])) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validation
    if (empty($name) || empty($email) || empty($password)) {
        $message = "All fields are required!";
        $message_type = "error";
    } elseif (!isValidEmail($email)) {
        $message = "Invalid email format!";
        $message_type = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters!";
        $message_type = "error";
    } elseif ($password !== $password_confirm) {
        $message = "Passwords do not match!";
        $message_type = "error";
    } else {
        // Check if email already exists
        $check = pg_query_params(
            $conn,
            "SELECT id FROM users WHERE email = $1",
            [$email]
        );

        if ($check && pg_num_rows($check) > 0) {
            $message = "Email already registered!";
            $message_type = "error";
        } else {
            // Hash password and insert user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $insert = pg_query_params(
                $conn,
                "INSERT INTO users (name, email, password) VALUES ($1, $2, $3) RETURNING id",
                [$name, $email, $hash]
            );

            if ($insert) {
                $message = "✅ Signup successful! Please login.";
                $message_type = "success";
                // Clear form on success
                $_POST = [];
            } else {
                $message = "Signup failed. Please try again.";
                $message_type = "error";
            }
        }
    }
}

/* ========== LOGIN HANDLER ========== */
if (isset($_POST['login'])) {
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation
    if (empty($email) || empty($password)) {
        $message = "Email and password are required!";
        $message_type = "error";
    } else {
        $result = pg_query_params(
            $conn,
            "SELECT id, name, password FROM users WHERE email = $1",
            [$email]
        );

        if ($result && pg_num_rows($result) == 1) {
            $user = pg_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['login_time'] = time();
                
                // Redirect to dashboard
                header("Location: ../dashboard.php");
                exit;
            } else {
                $message = "Invalid email or password!";
                $message_type = "error";
            }
        } else {
            $message = "Invalid email or password!";
            $message_type = "error";
        }
    }
}

?>
