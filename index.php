<?php
require_once 'bootstrap.php';

session_start();
$router = new Router($config['routes']);
require_once $router->direct(Request::uri());
