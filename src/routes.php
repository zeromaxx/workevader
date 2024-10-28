<?php
return [
    '/' => ['path' => 'controllers/index.php'],

    '/register' => ['path' => 'controllers/register.php'],
    '/login' => ['path' => 'controllers/login.php'],
    '/register/submit' => ['path' => 'controllers/users/register.php'],
    '/login/submit' => ['path' => 'controllers/users/login.php'],
    '/logout' => ['path' => 'controllers/logout.php'],

    '/employee/dashboard' => ['path' => 'controllers/employee/dashboard.php', 'protected' => true, 'role' => 'employee'],
    '/employee/vacation-request' => ['path' => 'controllers/employee/vacation-request.php', 'protected' => true, 'role' => 'employee'],
    '/employee/vacation-request/submit' => ['path' => 'controllers/employee/vacation-request-submit.php', 'protected' => true, 'role' => 'employee'],
    '/employee/delete/vacation-request/submit' => ['path' => 'controllers/employee/delete-vacation-request-submit.php', 'protected' => true, 'role' => 'employee'],

    '/manager/dashboard' => ['path' => 'controllers/manager/dashboard.php', 'protected' => true, 'role' => 'manager'],
    '/manager/create-user' => ['path' => 'controllers/manager/create-user.php', 'protected' => true, 'role' => 'manager'],
    '/manager/edit-user' => ['path' => 'controllers/manager/edit-user.php', 'protected' => true, 'role' => 'manager'],
    '/manager/create-user/submit' => ['path' => 'controllers/manager/create-user-submit.php', 'protected' => true, 'role' => 'manager'],
    '/manager/delete-user/submit' => ['path' => 'controllers/manager/delete-user-submit.php', 'protected' => true, 'role' => 'manager'],
    '/manager/edit-user/submit' => ['path' => 'controllers/manager/edit-user-submit.php', 'protected' => true, 'role' => 'manager'],
    '/manager/update-request/submit' => ['path' => 'controllers/manager/update-request-submit.php', 'protected' => true, 'role' => 'manager'],
];
