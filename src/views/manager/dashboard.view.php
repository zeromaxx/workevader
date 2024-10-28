<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>

<div class="container mt-5">
    <?php
    Helper::displayErrors();
    Helper::displaySuccess();
    ?>

    <div class="d-flex justify-content-between align-items-center">
        <h2>All Users</h2>
        <a href="/manager/create-user" class="btn btn-secondary">Create User</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']); ?></td>
                        <td><?= htmlspecialchars($user['email']); ?></td>
                        <td><?= htmlspecialchars($user['name'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="/manager/edit-user?id=<?= $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="/manager/delete-user/submit" method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="mt-5">All Vacation Requests</h2>
    <table class="table table-striped table-bordered mb-5">
        <thead class="table-dark">
            <tr>
                <th>Request ID</th>
                <th>Employee Code</th>
                <th>User Email</th>
                <th>User Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vacationRequests)): ?>
                <?php foreach ($vacationRequests as $request): ?>
                    <tr>
                        <td><?= htmlspecialchars($request['id']); ?></td>
                        <td><?= htmlspecialchars($request['employee_code']); ?></td>
                        <td><?= htmlspecialchars($request['email']); ?></td>
                        <td><?= htmlspecialchars($request['name'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($request['start_date']); ?></td>
                        <td><?= htmlspecialchars($request['end_date']); ?></td>
                        <td><?= htmlspecialchars($request['reason'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($request['status']); ?></td>
                        <td><?= htmlspecialchars($request['created_at']); ?></td>
                        <td>
                            <?php if ($request['status'] === 'pending'): ?>
                                <form action="/manager/update-request/submit" method="POST" class="d-flex gap-1">
                                    <input type="hidden" name="request_id" value="<?= $request['id']; ?>">
                                    <button type="submit" name="action" value="approve" class="btn btn-sm btn-success" onclick="return confirm('Approve this request?');">Approve</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger" onclick="return confirm('Reject this request?');">Reject</button>
                                </form>
                            <?php else: ?>
                                <?= ucfirst($request['status']); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">No vacation requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>