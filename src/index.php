<?php
session_start();
require __DIR__ . '/autoload.php';

$routes = require('routes.php');
$router = new Router($routes);

?>