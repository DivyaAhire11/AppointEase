<?php
// Authentication Check
// Include this file at the top of pages that require login

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header("Location: /AppointEase/Pages/Login/login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Optional: Check if session has expired (30 minutes of inactivity)
$timeout = 30 * 60; // 30 minutes
if (isset($_SESSION['login_time']) && (time() - strtotime($_SESSION['login_time']) > $timeout)) {
    session_destroy();
    header("Location: /AppointEase/Pages/Login/login.php?expired=1");
    exit;
}

// Update login time for session timeout tracking
$_SESSION['login_time'] = date('Y-m-d H:i:s');
?>
