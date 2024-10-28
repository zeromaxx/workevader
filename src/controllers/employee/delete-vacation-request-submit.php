<?php
$database = new Database();
$userEmployee = new UserEmployee($database);

$userId = $_SESSION['user_id'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
    $requestId = $_POST['request_id'] ?? null;

    if ($requestId && $userEmployee->deleteVacationRequest($requestId, $userId)) {
        $_SESSION['success'] = 'Your request was successful.';
        header("Location: /employee/dashboard");
        exit;
    } else {
        $_SESSION['errors'] = $userEmployee->errors;
        header("Location: /employee/dashboard");
        exit;
    }
}
