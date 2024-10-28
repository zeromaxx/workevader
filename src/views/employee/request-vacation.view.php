<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>

<div class="container-sm mt-5">
    <form action="/employee/vacation-request/submit" method="POST" class="p-4 border rounded shadow-sm bg-light">
        <h1 class="text-center mb-4">Request Vacation</h1>

        <input type="hidden" name="user_id" value="<?= AuthService::retrieveSessionUserId(); ?>">

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason:</label>
            <textarea id="reason" name="reason" rows="4" class="form-control" placeholder="Enter your reason"></textarea>
        </div>

        <button type="submit" class="btn btn-dark w-100">Submit Request</button>

        <div class="mt-3">
            <?php
            Helper::displayErrors();
            Helper::displaySuccess();
            ?>
        </div>
    </form>
</div>