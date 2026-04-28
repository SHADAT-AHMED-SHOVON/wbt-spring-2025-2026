<?php
$conn = mysqli_connect("localhost", "root", "", "school");
mysqli_set_charset($conn, "utf8mb4");

$fnameErr = $lnameErr = $numberErr = $emailErr = $passErr = "";
$fname = $lname = $number = $email = $pass = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) { $fnameErr = "First name is required"; } 
    else { $fname = cleanInput($_POST["fname"]); }

    if (empty($_POST["lname"])) { $lnameErr = "Last name is required"; } 
    else { $lname = cleanInput($_POST["lname"]); }

    $number = cleanInput($_POST["number"] ?? "");
    
    if (empty($_POST["email"])) { $emailErr = "Email is required"; } 
    else { $email = cleanInput($_POST["email"]); }

    if (empty($_POST["pass"])) { $passErr = "Password is required"; } 
    else { $pass = cleanInput($_POST["pass"]); }

    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($passErr)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO students (first_name, last_name, email, number, pass) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $number, $pass);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>