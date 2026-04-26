<?php
session_start();

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = cleanInput($_POST["email"] ?? "");
    $password = cleanInput($_POST["password"] ?? "");
    
    $errors = [];

    // Validate Email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format. Please use 'user@example.com'.";
    }

    // Validate Password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Checking Results
    if (empty($errors)) {
        echo "<h2>Login Successful</h2>";
        echo "Welcome: " . $email;
    } else {
        echo "<h2>Login Error</h2>";
        foreach ($errors as $error) {
            echo "<p style='color:red;'>- $error</p>";
        }
        echo "<br><a href='login.php'>Try Again</a>";
    }
} else {
    header("Location: login.php");
    exit();
}
?>