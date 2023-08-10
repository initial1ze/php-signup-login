<?php

session_start();

if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_SESSION['registeration']) && isset($_GET['registration']) && $_GET['registration'] === 'success') {
    echo '<p class="success">Registration successful! You can now log in.</p>';
    unset($_SESSION['registeration']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once("./db.php");
    include_once("./validations.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = validateLoginForm($email);

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='failure'>$error</div>";
        }
    } else {

        $select_sql = "SELECT * FROM users WHERE email = ?";
        $user_exists_stmt = $conn->prepare($select_sql);
        $user_exists_stmt->bind_param("s", $email);
        $user_exists_stmt->execute();
        $result = $user_exists_stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_exists_stmt->close();
            $conn->close();

            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['email'] = $user['email'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<div class='failure'>Incorrect password!</div>";
            }
        } else {
            echo "<div class='failure'>Invalid email or password</div>";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Login</title>
</head>

<body>
    <div class="form-container">
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <input type="submit" value="Log In">

            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
</body>

</html>