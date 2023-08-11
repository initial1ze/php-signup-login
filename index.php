<?php
session_start();

if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
