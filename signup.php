<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>Sign Up</title>
</head>

<body>
    <div class="info"></div>
    <div class="form-container">
        <form action="signup.php" method="post" id="signupForm">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required pattern=".{8,}" title="Eight or more characters">

            <label for="cnfPassword">Confirm Password:</label>
            <input type="password" name="cnfPassword" id="cnfPassword" placeholder="Confirm Password" required pattern=".{8,}" title="Eight or more characters">

            <button type="submit">Sign Up</button>

            <p> Already have an account? <a href="./login.php">Login</a></p>
        </form>
    </div>
    <script src="./script.js"></script>
</body>

</html>