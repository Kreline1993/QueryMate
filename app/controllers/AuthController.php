<?php
namespace App\Controllers;

class AuthController
{
    public function loginAction(): void
    {
        // DB connection
        $pdo = require dirname(__DIR__, 2) . '/db.php';

        $err = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!$email || !$password) {
                $err = 'All fields are required.';
            } else {
                $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect to home
                    header("Location: /querymate/public/");
                    exit;
                } else {
                    $err = 'Incorrect email or password.';
                }
            }
        }

        // Render the login view; it uses $err and $_POST['email'] if present
        require dirname(__DIR__, 2) . '/public/views/login.php';
    }
}