<?php
function validateSignUpForm($email, $password, $confirm_password)
{
    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password length (you can add more password requirements here)
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    return $errors;
}

function validateLoginForm($email)
{
    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    return $errors;
}
