<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

echo "<div class='dashboard'>
        <h1>Welcome " . $_SESSION['email'] . "</h1>
        <a href='logout.php' class='logout-btn'>Logout</a>
    </div>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Dashboard</title>
</head>

<body>

</body>

</html>