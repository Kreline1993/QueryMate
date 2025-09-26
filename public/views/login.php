<?php
session_start();
require __DIR__ . '/../../db.php';

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
            header("Location: /querymate/index.php");
            exit;
        } else {
            $err = 'Incorrect email or password.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Log In</title>
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=2">
</head>
<body class="min-h-screen bg-gradient-to-tl from-[#42AA94] to-[#4193C9] text-gray-900">
  <main class="w-full flex items-center justify-center p-6">
    <section class="w-[50vw] max-w-md bg-gray-300 rounded-2xl shadow-lg p-6">
      <h1 class="text-3xl font-semibold text-center mb-6">Log In</h1>

      <?php if ($err): ?>
        <p class="mb-4 text-red-700 font-medium"><?= htmlspecialchars($err) ?></p>
      <?php endif; ?>

      <form method="post" action="/querymate/public/views/login.php" class="space-y-5">
        <div>
          <label for="email" class="sr-only">Email</label>
          <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900"
                 type="email" id="email" name="email" placeholder="Email" required
                 value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900"
                 type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit"
                class="w-full py-2 px-4 rounded-md text-white font-medium bg-gradient-to-r from-[#42AA94] to-[#4193C9] hover:opacity-90">
          Log In
        </button>
      </form>

      <p class="mt-4 text-sm text-center">
        No account? <a class="underline" href="/querymate/public/views/register.php">Sign up</a>
      </p>
    </section>
  </main>
</body>
</html>
