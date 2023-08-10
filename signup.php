<?php

session_start();

if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("./db.php");
    include_once("./validations.php");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnfPassword = $_POST['cnfPassword'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $errors = validateSignUpForm($email, $password, $cnfPassword);

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
            echo "<div class='failure'>User already exists</div>";
            $user_exists_stmt->close();
        } else {
            $insert_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("ss", $email, $hashedPassword);
            $stmt->execute();
            $stmt->close();
            session_start();
            $_SESSION['registeration'] = true;
            header("Location: login.php?registration=success");
            exit();
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
    <title>Sign Up</title>
</head>

<body>
    <div class="form-container">
        <form action="signup.php" method="post">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required pattern=".{8,}" title="Eight or more characters">

            <label for="cnfPassword">Confirm Password:</label>
            <input type="password" name="cnfPassword" id="cnfPassword" placeholder="Confirm Password" required pattern=".{8,}" title="Eight or more characters">


            <input type="submit" value="Sign Up">

            <p> Already have an account? <a href="./login.php">Login</a></p>
        </form>
    </div>
</body>

</html>