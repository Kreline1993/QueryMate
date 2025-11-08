<?php
namespace App\Controllers;

/**
 * Handles all authentication logic (login, register, logout).
 * Keeps auth separate from views following MVC principles.
 */
class AuthController
{
    /** 
     * Logs users in.
     * Validates input, verifies credentials, and starts session. 
     */
    public function loginAction(): void
    {
        // DB connection - local scope to keep each action independent
        $pdo = require dirname(__DIR__, 2) . '/db.php';

        $errorMessage = '';

        // Only process form on post to avoid running on page load
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            
            // Prevent empty fields before DB query
            if (!$email || !$password) {
                $errorMessage = 'All fields are required.';
            } else {
                // Prepared statement prevents SQL injection
                $stmt = $pdo->prepare("
                    SELECT id, username, password_hash 
                    FROM users 
                    WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                // Verify password using PHP's hashing API
                if ($user && password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect to home prevents form resubmission
                    header("Location: /querymate/public/");
                    exit;
                } else {
                    // Generic error message to avoid revealing if account exists
                    $errorMessage = 'Incorrect email or password.';
                }
            }
        }
    
        // Load the login view; controller handles logic, view handles display
        require dirname(__DIR__, 2) . '/public/views/login.php';
    }

    /** 
     * Registers new users.
     * Validates input, hashes password, and inserts via prepared statements.
     */
    public function registerAction(): void
    {
        $pdo = require dirname(__DIR__, 2) . '/db.php';

        $pageTitle = 'Register';
        $errors = [];
        $data = ['username' => '', 'email' => ''];
        $success = isset($_GET['success']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Trim & sanitise inout to prevent invalid or malicious data
            $username        = trim($_POST['username'] ?? '');
            $email           = trim($_POST['email'] ?? '');
            $password        = $_POST['password'] ?? '';
            $confirmpassword = $_POST['confirmpassword'] ?? '';

            // Validation to keep DB clean and secure
            // Username validation
            if ($username === '') {
                $errors['username'] = "Username is required.";
            } elseif (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
                $errors['username'] = "Username can only contain letters, numbers and underscores.";
            } elseif (strlen($username) < 3 || strlen($username) > 32) {
                $errors['username'] = "Username must be between 3 and 32 characters long.";
            }

            // Email validation
            if ($email === '') {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }

            // Password validation
            if ($password === '' || $confirmpassword === '') {
                $errors['password'] = "Please enter and confirm your password.";
            } elseif ($password !== $confirmpassword) {
                $errors['password'] = "Passwords do not match.";
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])\S{8,}$/', $password)) {
                $errors['password'] = "Password must be at least 8 characters and include uppercase, lowercase, a number, and a special character.";
            }

            // Escape before redisplay - prevents XSS
            $data['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
            $data['email']    = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            if (!$errors) {
                try {
                    // Prepared statement: check if username or email already exists
                    $stmt = $pdo->prepare("
                        SELECT username, email 
                        FROM users 
                        WHERE username = :u OR email = :e 
                        LIMIT 1
                    ");
                    $stmt->execute([
                        ':u' => $username,
                        ':e' => $email
                    ]);
                    $row = $stmt->fetch();

                    if ($row) {
                        if ($row['username'] === $username) {
                            $errors['username'] = "Username is already taken.";
                        }
                        if ($row['email'] === $email) {
                            $errors['email'] = "Email already registered.";
                        }
                    } else {
                        // Hash password before storing
                        $hash = password_hash($password, $algo);

                        // Insert new user using prepared statement
                        $insert = $pdo->prepare("
                            INSERT INTO users (username, email, password_hash) 
                            VALUES (:u, :e, :h)
                        ");
                        $insert->execute([
                            ':u' => $username,
                            ':e' => $email,
                            ':h' => $hash
                        ]);

                        // Redirect to same route with success flag to prevent form resubmission
                        header("Location: /querymate/public/?r=auth/register&success=1");
                        exit;
                    }
                } catch (\PDOException $e) {
                    // Debug only; log in real app
                    $errors['server'] = "Database error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
                }
            }
        }
        // Pass data and errors to view for rendering
        require dirname(__DIR__, 2) . '/public/views/register.php';
    }

    /** 
     * Logs user out by clearing session and redirecting home.
     * Keeps logout consistent with MVC routing. 
     */
    public function logoutAction(): void
    {
    // Make sure session is started before destroying it
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Unset all session variables for security
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to home
    header("Location: /querymate/public/?r=home/index");
    exit;
}
}