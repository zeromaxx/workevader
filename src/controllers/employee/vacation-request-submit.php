<?php
$database = new Database();
$userEmployee = new UserEmployee($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['user_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $reason = $_POST['reason'];

    if ($userEmployee->submitVacationRequest($userId, $startDate, $endDate, $reason)) {
        $_SESSION['success'] = 'Your request has been sent!';
        header('Location: /employee/dashboard');
    } else {
        $_SESSION['errors'] = $userEmployee->errors;
        header('Location: /employee/vacation-request');
    }
}
