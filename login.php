<?php

session_start();
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_SESSION['registeration'])) {
    echo '<p class="success">Registration successful! You can now log in.</p>';
    unset($_SESSION['registeration']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="info"></div>
    <div class="form-container">
        <form action="login.php" method="post" id="loginForm">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>

            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
    <script src="./script.js"></script>
</body>

</html>