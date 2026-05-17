<?php

require_once __DIR__ . '/../Model/loginModel.php';
require_once __DIR__ . '/../Model/dataConnection.php';

$connection = new db();
$connection = $connection->connection();

if(isset($_POST['action']) && $_POST['action'] === 'Login') {
    $email = $_POST['email']??'';
    $password = $_POST['password']??'';
    $rememberMe = $_POST['remember_me'] ?? '0';

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

        if ($rememberMe === '1') {
            $expiry = time() + (30 * 24 * 60 * 60);
            setcookie('remember_user_id', (string) $user['id'], $expiry, '/');
            setcookie('remember_name', $user['name'], $expiry, '/');
            setcookie('remember_role', $user['role'], $expiry, '/');
            setcookie('remember_email', $email, $expiry, '/');
        } else {
            setcookie('remember_user_id', '', time() - 3600, '/');
            setcookie('remember_name', '', time() - 3600, '/');
            setcookie('remember_role', '', time() - 3600, '/');
            setcookie('remember_email', '', time() - 3600, '/');
        }

        echo $user['role'];
    } else {
        echo "Invalid email or password";
    }
}
