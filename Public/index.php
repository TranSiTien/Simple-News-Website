<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
// require_once 'bootstrap.php';
use \Core\Router;
use \Core\Request;
use \Core\Sercurity;
use \Core\Database\Bootstrap;
use \App\Config;

$router = new Router($config['routes']);
require_once $router->direct(Request::uri());
