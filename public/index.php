<?php
session_start();
$page = 'home';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>QueryMate — Home</title>
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=3">
</head>
<body class="min-h-screen bg-gradient-to-tl from-[#42AA94] to-[#4193C9] text-gray-900">

  <header class="w-full mx-auto p-4 flex justify-center">
    <nav class="w-[50vw] bg-gray-300 rounded-xl shadow border border-black/10 flex items-center justify-center gap-1 p-2">
      <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/querymate/index.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
      ?>">Home</a>
      <a href="/querymate/public/views/tutor.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'tutor') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' 
      ?>">Tutor</a>
      <a href="/querymate/public/views/builder.php" class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'builder') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
      ?>">Builder</a>
      <a href="public\views\logout.php" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100"
      >Log out</a>
      <?php endif; ?>
    </nav>
  </header>

  <main class="w-full flex items-center justify-center">
<section class="w-[70vw] min-h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-8 overflow-hidden">
  <h1 class="text-3xl font-semibold text-center mb-8">Welcome to QueryMate!</h1>
      <p class="text-xl font-semibold text-center mb-6">Your friendly SQL tutor</p>
      <?php if (!isset($_SESSION['user_id'])): ?>
  <div class="grid grid-cols-2 gap-8 items-center">
    <div class="flex justify-center">
      <img
        src="/querymate/public/assets/img/QueryMateLogo.png"
        alt="QueryMate mascot"
        class="block w-full max-w-[400px] h-auto object-contain"
      />
    </div>
    <div class="flex flex-col items-center">


      <form class="w-3/4 mx-auto space-y-4" method="post" action="/querymate/public/views/login.php">
        <div>
          <label for="email" class="sr-only">Email</label>
          <input
            class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900"
            type="text" id="email" name="email" placeholder="Email" required>
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input
            class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900"
            type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div>
          <button
            type="submit"
            class="cursor-pointer w-full items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white shadow
            bg-gradient-to-r from-[#42AA94] to-[#4193C9]
            hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
            Log in
          </button>
        </div>
      </form>

      <p class="text-xl font-semibold text-center mt-6">Don't have an account?</p>
      <a
        href="/querymate/public/views/register.php"
        class="block w-3/4 text-center mt-4 px-5 py-2.5 rounded-lg font-semibold text-white shadow
        bg-gradient-to-r from-[#4193C9] to-[#42AA94]
        hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
        Sign up
      </a>
    </div>
  </div>
  <?php else: ?>
        <div class="flex justify-center">
      <img
        src="/querymate/public/assets/img/QueryMateLogo.png"
        alt="QueryMate mascot"
        class="block w-full max-w-[400px] h-auto object-contain"
      />
    </div>
    <?php endif; ?>
</section>

  </main>
</body>
</html>