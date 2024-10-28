<?php
$database = new Database();
$userService = new AuthService($database);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($userService->loginUser($email, $password)) {
    $_SESSION['success'] = 'Login successful!';

    $userRole = $_SESSION['user_role'];
    $redirectPath = $userService->getRedirectPathByRole($userRole);

    header("Location: $redirectPath");
} else {
    $_SESSION['errors'] = $userService->errors;
    header('Location: /login');
}
exit;
