<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $userService = new AuthService($database);

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $employee_code = $_POST['employee_code'];

    if ($userService->registerUser($email, $password, $role, $employee_code)) {
        $_SESSION['success'] = 'User registered successfully!';
        header('Location: /manager/dashboard');
    } else {
        $_SESSION['errors'] = $userService->errors;
        header('Location: /manager/create-user');
    }

    exit;
}
