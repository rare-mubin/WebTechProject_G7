<?php

require_once __DIR__ . '/../Model/loginModel.php';
require_once __DIR__ . '/../Model/dataConnection.php';

$connection = new db();
$connection = $connection->connection();

if(isset($_POST['action']) && $_POST['action'] === 'Login') {
    $email = $_POST['email']??'';
    $password = $_POST['password']??'';

    if(empty($email) || empty($password)) {
        echo "All fields are required";
        exit;
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $loginModel = new LoginModel();
    $user = $loginModel->validateUser($connection, $email, $password);

    if($user) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        echo "OK";
    } else {
        echo "Invalid email or password";
    }
}
