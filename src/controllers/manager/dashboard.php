<?php
$heading = 'Manager Dashboard';

$database = new Database();
$userManager = new UserManager($database);
$userEmployee = new UserEmployee($database);

$users = $userManager->getAllUsers();
$vacationRequests = $userEmployee->getAllVacationRequests();

require('views/manager/dashboard.view.php');