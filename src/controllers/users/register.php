<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $userService = new AuthService($database);

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($userService->registerUser($email, $password)) {
        $_SESSION['success'] = 'User registered successfully!';
    } else {
        $_SESSION['errors'] = $userService->errors;
    }

    header('Location: /register');
    exit;
}