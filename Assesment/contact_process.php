<?php
$nameErr = $emailErr = $genderErr = $companyErr = $reasonErr = $skillsErr = "";
$name = $email = $gender = $company = $reason = "";
$skills = [];

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }

    if (empty($_POST["company"])) {
        $companyErr = "Company is required";
    } else {
        $company = cleanInput($_POST["company"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $company)) {
            $companyErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["reason"])) {
        $reasonErr = "Reason is required";
    } else {
        $reason = cleanInput($_POST["reason"]);
    }

    if (empty($_POST["skills"])) {
        $skillsErr = "At least one skill is required";
    } else {
        $skills = array_map('cleanInput', $_POST["skills"]); 
    }


    
}
