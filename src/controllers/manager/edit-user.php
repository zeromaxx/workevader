<?php
$heading = 'Edit User';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /manager/dashboard');
    exit;
}

$user_id = (int) $_GET['id'];

$database = new Database();
$userManager = new UserManager($database);

$user = $userManager->getUserById($user_id);

require('views/manager/edit-user.view.php');
