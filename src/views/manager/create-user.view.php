<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>

<div class="container-sm mt-4">
    <h1>Create New User</h1>
    <form action="/manager/create-user/submit" method="POST" class="p-4 border rounded shadow-sm bg-light">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="employee_code" class="form-label">Employee Code</label>
            <input type="text" class="form-control" value="<?= Helper::generateUniqueEmployeeCode(); ?>" name="display_code" disabled>
            <input type="hidden" name="employee_code" value="<?= Helper::generateUniqueEmployeeCode(); ?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="employee">Employee</option>
                <option value="manager">Manager</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark w-100">Create User</button>
        <div class="mt-3">
            <?php
            Helper::displayErrors();
            Helper::displaySuccess();
            ?>
        </div>
    </form>
</div>


<?php include('views/partials/footer.php'); ?>