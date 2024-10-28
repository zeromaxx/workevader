<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>



<div class="d-flex justify-content-between align-items-center mt-4 mb-3">
    <h2>Your Vacation Requests</h2>
    <a href="/employee/vacation-request" class="btn btn-secondary">Submit Vacation Request</a>
</div>

<?php
Helper::displayErrors();
Helper::displaySuccess();
?>

<?php if (!empty($requests)): ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= htmlspecialchars($request['id']) ?></td>
                    <td><?= htmlspecialchars($request['start_date']) ?></td>
                    <td><?= htmlspecialchars($request['end_date']) ?></td>
                    <td><?= htmlspecialchars($request['reason']) ?></td>
                    <td><?= htmlspecialchars($request['status']) ?></td>
                    <td><?= htmlspecialchars($request['created_at']) ?></td>
                    <td>
                        <?php if ($request['status'] === 'pending'): ?>
                            <form action="/employee/delete/vacation-request/submit" method="POST" style="display:inline;">
                                <input type="hidden" name="request_id" value="<?= htmlspecialchars($request['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this request?');">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-muted mt-3">You have not submitted any vacation requests.</p>
<?php endif; ?>


<?php include('views/partials/footer.php'); ?>