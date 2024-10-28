<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>

<div class="container-sm mt-4">
    <h1>Update User</h1>
    <form action="/manager/edit-user/submit" method="POST" class="p-4 border rounded shadow-sm bg-light">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= htmlspecialchars($user['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a new password or leave blank to keep the same">
        </div>

        <button type="submit" class="btn btn-dark w-100">Update User</button>
        <div class="mt-3">
            <?php
            Helper::displayErrors();
            Helper::displaySuccess();
            ?>
        </div>
    </form>
</div>


<?php include('views/partials/footer.php'); ?>