<?php
// test_db.php

require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Read DB info from .env
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$name = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

echo "Trying to connect to database '{$name}' at {$host}:{$port}...";

try {
    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    echo "Connection successful!";

    // Run a tiny query just to check it’s alive
    $stmt = $pdo->query('SELECT NOW() AS server_time');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Database responded. Server time: " . $row['server_time'];

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}