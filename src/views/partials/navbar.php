<nav class="navbar navbar-expand-lg bg-dark navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Work Evader</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <?php if (!AuthService::isLoggedIn()): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>

                <?php endif; ?>

                <?php if (AuthService::isLoggedIn()): ?>

                    <?php if (AuthService::getUserRole() === 'manager'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/manager/dashboard">Manager Dashboard</a>
                        </li>
                    <?php endif; ?>
                    <?php if (AuthService::getUserRole() === 'employee'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/employee/dashboard">Employee Dashboard</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">