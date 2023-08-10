<?php

$server = "localhost";
$username = "rajesh";
$password = "1234";
$database = "logintask";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
