<?php
$database = new Database();
$userManager = new UserManager($database);

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$user_id = $_POST['id'];

if ($userManager->updateUser($user_id, $email, $password, $name)) {
    $_SESSION['success'] = 'User updated successfully!';
    header("Location: /manager/dashboard");
} else {
    $_SESSION['errors'] = $userManager->errors;
    header("Location: /manager/edit-user?id=$user_id");
}
exit;
