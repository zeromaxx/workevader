<?php
include('views/partials/head.php');
include('views/partials/navbar.php');
?>

<div class="container-sm mt-5">
    <h1 class="text-center mb-4">Login</h1>
    <form action="/login/submit" method="POST" class="p-4 border rounded shadow-sm bg-light">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-dark w-100">Login</button>

        <div class="mt-3">
            <?php
            Helper::displayErrors();
            Helper::displaySuccess();
            ?>
        </div>
    </form>
</div>

<?php include('views/partials/footer.php'); ?>