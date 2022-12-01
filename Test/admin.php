<?php
require_once '../bootstrap.php';

$uir = '/admin';
$router = new Router($config['router']);
require_once $router->direct($uir);
