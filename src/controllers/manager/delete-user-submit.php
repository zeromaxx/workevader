<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $userManager = new UserManager($database);

    $user_id = $_POST['user_id'];

    if ($userManager->deleteUser($user_id)) {
        $_SESSION['success'] = 'User deleted successfully!';
        header('Location: /manager/dashboard');
    }

    exit;
}
