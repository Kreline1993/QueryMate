<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
// Load .env once for the entire app
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Default route
$route = $_GET['r'] ?? 'home/index';

// Split route into controller and action
[$controllerName, $actionName] = explode('/', $route) + [null, 'index'];

// Build names
$controllerClass = "App\\Controllers\\" . ucfirst($controllerName) . "Controller";
$actionMethod = $actionName . "Action";

// Load controller file
require_once dirname(__DIR__) . "/app/Controllers/" . ucfirst($controllerName) . "Controller.php";


$controller = new $controllerClass();
$controller->$actionMethod();