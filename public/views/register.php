<?php $page = 'register'; ?>
<?php
require __DIR__ . '/../../db.php';
session_start();

$errors =[];
$data = ['username' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';

    if ($username === '') {
      $errors['username'] = "Username is required.";
    } elseif (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
      $errors['username'] = "Username can only contain letters, numbers and underscores.";
    } elseif (strlen($username) < 3 || strlen($username) > 32) {
      $error['username'] = "Username must be between 3 and 32 characters long.";
    }
    
    if ($email === '') {
      $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid email format.";
    }

    if ($password === '' || $confirmpassword === '') {
        $errors['password'] = "Please enter and confirm your password.";
    } elseif ($password !== $confirmpassword) {
      $errors['password'] = "Passwords do not match";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])\S{8,}$/', $password)) {
      $errors['password'] = "Password must be at least 8 characters and include uppercase, lowercase, a number, and a special character.";
    }

    $data['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $data['email'] = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    if (!$errors) {
      try {
        $stmt = $pdo->prepare("SELECT username, email FROM users WHERE username = :u OR email = :e LIMIT 1");
        $stmt->execute([':u' => $username, ':e' => $email]);
        $row = $stmt->fetch();

        if ($row) {
          if ($row['username'] === $username) {
            $errors['username'] = "Username is already taken.";
        }
        if ($row['email'] === $email) {
          $errors['email'] = "Email already registered.";
        }
        } else {
          $algo = defined('PASSWORD_ARGON2ID') ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;
          $hash = password_hash($password, $algo);

          $sql = 'INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES (:u, :e, :h)';
          $stmt = $pdo->prepare($sql);
          $stmt->execute([':u' => $username, ':e' => $email, ':h' => $hash]);
          header("Location: register.php?success=1");
          exit;
        }
      } catch (PDOException $e) {
        $errors['server'] = "Database error: " . htmlspecialchars($e->getMessage());
        }
    }
  }
$success = isset($_GET['success']);  
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=6">
</head>
<body class="min-h-screen bg-gradient-to-tl from-[#42AA94] to-[#4193C9] text-gray-900">

  <header class="w-full mx-auto p-4 flex justify-center">
    <nav class="w-[75vw] bg-gray-300 rounded-xl shadow border border-black/10 flex items-center justify-center gap-1 p-2">
      <a href="/querymate/index.php"  class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100">
    Cancel</a>
    </nav>
  </header>

  <main class="w-screen flex items-center justify-center">
    <section class="w-[75vw] min-h-[80vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-hidden">
      <h1 class="text-3xl font-semibold text-center">Sign Up</h1>

      <?php if ($success): ?>
        <div class="w-1/2 mx-auto mb-4 p-3 rounded-md bg-green-100 text-green-800 border border-green-300">
          Registration successful! You can now sign in.
        </div>
      <?php endif; ?>
      <!-- See how it looks -->
      <?php if (!empty($errors)): ?>
        <div class="w-1/2 mx-auto mb-4 p-3 rounded-md bg-red-100 text-red-800 border border-red-300">
          <strong>Please fix the following errors:</strong>
          <ul class="list-disc list-inside mt-2 text-sm">
            <?php foreach ($errors as $field => $message): ?>
              <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form class="w-1/2 mx-auto space-y-6" method="post" action="register.php">
        <div>
            <label for="username" class="block text-sm font-medium mb-2">Username</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900" 
            type="text" id="username" name="username" required maxlength="32" value="<?= $data['username'] ?>">
            <?php if (!empty($errors['username'])): ?>
              <p class="mt-1 text-sm text-red-700"><?= htmlspecialchars($errors['username']) ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
            type="email" id="email" name="email" required value="<?= $data['email'] ?>">
            <?php if (!empty($errors['email'])): ?>
              <p class="mt-1 text-sm text-red-700"><?= htmlspecialchars($errors['email']) ?></p>
            <?php endif; ?>
        </div>
        <div>
         <label for="password" class="block text-sm font-medium mb-2">Password</label>
        <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
        type="password" id="password" name="password" required autocomplete="new-password">
        </div>
        <div>
            <label for="confirmpassword" class="block text-sm font-medium mb-2">Confirm Password</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
            type="password" id="confirmpassword" name="confirmpassword" required autocomplete="new-password">
          <?php if (!empty($errors['password'])): ?>
            <p class="mt-1 text-sm text-red-700"><?= htmlspecialchars($errors['password']) ?></p>
          <?php endif; ?>
        </div>
        <div>
            <button
                type="submit"
                class="cursor-pointer w-full py-2 px-4 rounded-md text-white font-medium bg-gradient-to-r from-[#42AA94] to-[#4193C9] 
                hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">Sign Up</button>
        </div>
      </form>

    </section>
  </main>
</body>
</html>