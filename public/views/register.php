<?php $page = 'register'; ?>
<?php
require __DIR__ . '/../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';

    if ($password !== $confirmpassword) {
        echo "<p style='color:red;'>Error: Passwords do not match.</p>";
        exit;
    }

    if ($username && $email && $password) {
        $hash = password_hash($password, PASSWORD_ARGON2ID);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $hash]);
            echo "<p style='color:green;'>Registration successful!</p>";
        }
        catch (PDOException $e) {
            if ($e->getCode() === 23000) {
                echo "<p style='color:red;'>Username or email already taken.</p>";
            }
            else {
                echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
    else {
        echo "<p style='color:red;'>All fields required.</p>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=2">
</head>
<body class="min-h-screen bg-gradient-to-tl from-[#42AA94] to-[#4193C9] text-gray-900">

  <header class="w-full mx-auto p-4 flex justify-center">
    <nav class="w-[50vw] bg-gray-300 rounded-xl shadow border border-black/10 flex items-center justify-center gap-1 p-2">
      <a href="/querymate/index.php"  class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100">
    Cancel</a>
    </nav>
  </header>

  <main class="w-full flex items-center justify-center">
    <section class="w-[50vw] h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-hidden">
      <h1 class="text-3xl font-semibold text-center">Sign Up</h1>
      <form class="w-1/2 mx-auto space-y-6" method="post" action="register.php">
        <div>
            <label for="username" class="block text-sm font-medium mb-2">Username</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900" 
            type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium mb-2">Email</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
            type="email" id="email" name="email" required><br>
        </div>
        <div>
         <label for="password" class="block text-sm font-medium mb-2">Password</label>
        <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
        type="password" id="password" name="password" required><br>   
        </div>
        <div>
            <label for="confirmpassword" class="block text-sm font-medium mb-2">Confirm Password</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900" 
            type="password" id="confirmpassword" name="confirmpassword" required>
        </div>
        <div>
            <button
                type="submit"
                class="w-full py-2 px-4 rounded-md text-white font-medium bg-gradient-to-r from-[#42AA94] to-[#4193C9] 
                hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">Sign Up</button>
        </div>
      </form>

    </section>
  </main>
</body>
</html>