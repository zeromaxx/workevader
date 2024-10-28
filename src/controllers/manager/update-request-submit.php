<?php
$database = new Database();
$userManager = new UserManager($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['request_id'];
    $action = $_POST['action'];

    if ($requestId && $action) {
        if ($action === 'approve') {
            $success = $userManager->approveVacationRequest($requestId);
            $_SESSION['success'] = $success ? 'Request approved successfully.' : 'Failed to approve request.';
        } elseif ($action === 'reject') {
            $success = $userManager->rejectVacationRequest($requestId);
            $_SESSION['success'] = $success ? 'Request rejected successfully.' : 'Failed to reject request.';
        }
    }

    header("Location: /manager/dashboard");
    exit;
}
?>
