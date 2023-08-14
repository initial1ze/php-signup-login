<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" and isset($_POST['action']) and !empty($_POST['action'])) {

    // Sign Up
    if ($_POST['action'] === 'signup') {
        include_once("./db.php");
        include_once("./validations.php");

        $data = $_POST['data'];
        parse_str($data, $data);

        $email = $data['email'];
        $password = $data['password'];
        $cnfPassword = $data['cnfPassword'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $errors = validateSignUpForm($email, $password, $cnfPassword);

        $response = array();
        $response["success"] = false;

        if (count($errors) === 0) {
            $select_sql = "SELECT * FROM users WHERE email = ?";
            $user_exists_stmt = $conn->prepare($select_sql);
            $user_exists_stmt->bind_param("s", $email);
            $user_exists_stmt->execute();
            $result = $user_exists_stmt->get_result();

            if ($result->num_rows > 0) {
                $errors[] = "User already exists";
                $user_exists_stmt->close();
            } else {
                $insert_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param("ss", $email, $hashedPassword);
                $stmt->execute();
                $stmt->close();
                session_start();
                $_SESSION['registeration'] = true;
                $response["success"] = true;
            }
        }

        $response["errors"] = $errors;
        echo (json_encode($response));
    }

    // Login
    if ($_POST['action'] === 'login') {
        include_once("./db.php");
        include_once("./validations.php");

        $data = $_POST['data'];
        parse_str($data, $data);

        $email = $data['email'];
        $password = $data['password'];

        $errors = validateLoginForm($email, $password);

        $response = array();
        $response["success"] = false;

        if (count($errors) === 0) {
            $select_sql = "SELECT * FROM users WHERE email = ?";
            $user_exists_stmt = $conn->prepare($select_sql);
            $user_exists_stmt->bind_param("s", $email);
            $user_exists_stmt->execute();
            $result = $user_exists_stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $user_exists_stmt->close();

                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $response["success"] = true;
                } else {
                    $errors[] = "Incorrect password!";
                }
            } else {
                $errors[] = "Invalid email or password";
            }
        }

        $response["errors"] = $errors;
        echo (json_encode($response));
    }
}
