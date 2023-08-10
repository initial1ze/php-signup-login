<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnfPassword = $_POST['cnfPassword'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($password == $cnfPassword) {
        include_once "./db.php";

        $select_sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $user_exists_stmt = $conn->prepare($select_sql);
        $user_exists_stmt->execute();
        $result = $user_exists_stmt->get_result();
        $user_exists_row = $result->fetch_assoc();

        if (count($user_exists_row) > 0) {
            echo "User already exists";
            exit();
        }

        $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        $stmt->execute();

        echo "User created successfully";
    } else {
        echo "Password do not match";
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

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username">

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">

            <label for="cnfPassword">Confirm Password</label>
            <input type="password" name="cnfPassword" placeholder="Confirm Password">


            <input type="submit" value="Sign Up">

            <p> Already have an account? <a href="./login.php">Login</a></p>
        </form>
    </div>
</body>

</html>