<?php
function validateSignUpForm($email, $password, $confirm_password)
{
    $errors = [];

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    return $errors;
}

function validateLoginForm($email, $password)
{
    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    return $errors;
}
