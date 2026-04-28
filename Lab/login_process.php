<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "school");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"] ?? "");
    $password = htmlspecialchars($_POST["password"] ?? "");
    
    $stmt = mysqli_prepare($conn, "SELECT id, email FROM students WHERE email = ? AND pass = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: crud.php");
        exit();
    } else {
        echo "Invalid login. <a href='login.php'>Try Again</a>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>