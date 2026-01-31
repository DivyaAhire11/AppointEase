<?php
session_start();
include "../../config/db.php";

$message = "";

/* SIGNUP */
if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name == "" || $email == "" || $password == "") {
        $message = "All fields are required!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $check = pg_query_params(
            $conn,
            "SELECT id FROM users WHERE email = $1",
            [$email]
        );

        if (pg_num_rows($check) > 0) {
            $message = "Email already exists!";
        } else {
            pg_query_params(
                $conn,
                "INSERT INTO users (name, email, password) VALUES ($1, $2, $3)",
                [$name, $email, $hash]
            );
            $message = "Signup successful! You can login now.";
        }
    }
}

/* LOGIN */
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = pg_query_params(
        $conn,
        "SELECT id, name, password FROM users WHERE email = $1",
        [$email]
    );

    if (pg_num_rows($result) == 1) {
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: ../dashboard.php");
            exit;
        } else {
            $message = "Wrong password!";
        }
    } else {
        $message = "User not found!";
    }
}
?>
