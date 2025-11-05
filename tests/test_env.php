<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// Simple test to see if it reads from the .env file
echo "Your API key is: " . $_ENV['GEMINI_API_KEY'] . PHP_EOL;