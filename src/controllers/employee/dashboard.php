<?php
$heading = 'Employee Dashboard';

$database = new Database();
$userEmployee = new UserEmployee($database);

$user_id = $_SESSION['user_id'];
$requests = $userEmployee->fetchVacationRequestsByUser($user_id);

$hasPendingRequests = $userEmployee->checkForPendingRequests($user_id);

require('views/employee/dashboard.view.php');