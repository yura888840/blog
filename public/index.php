<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:08
 */

// Should be unset for production
//error_reporting(E_ALL);
session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/MVC/Router.php';

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$requestData = ($method == 'POST') ? $_POST : $_GET;

$router = new \Blog\MVC\Router();
$viewData = $router->doRouting($url, $method, $requestData);

echo $viewData;
