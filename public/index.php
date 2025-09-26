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
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=2">
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
      <a href="/querymate/public/views/builder.php"class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'builder') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
      ?>">Builder</a>
      <?php endif; ?>
    </nav>
  </header>

  <main class="w-full flex items-center justify-center">
    <section class="w-[50vw] h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-hidden">
      <h1 class="text-3xl font-semibold text-center">Welcome to QueryMate!</h1>
      <p class="text-center">Your friendly SQL tutor</p>
      <div class="mt-6 flex justify-center gap-4">
        <form class="w-1/4 mx-auto space-y-4" method="post" action="/querymate/public/views/login.php">
        <div>
            <label for="email" class="sr-only">Email</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900" 
            type="text" id="email" name="email" placeholder="Email" required>
      </div>
      <div>
             <label for="password" class="sr-only">Password</label>
            <input class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900" 
            type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <div>
            <button type="submit"
            class="w-full items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white shadow
            bg-gradient-to-r from-[#42AA94] to-[#4193C9]
            hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">Log in</button>
      </div>
            </div>
        </form>
      </div>
      <div class="mt-6 flex justify-center gap-4">

        <a href="public\views\register.php"
          class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white shadow
            bg-gradient-to-r from-[#4193C9] to-[#42AA94] 
                hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
        Sign up</a>
      </div>

      <div class="mt-6 mx-auto w-full flex justify-center">
        <img
          src="/querymate/public/assets/img/QueryMateLogo.png"
          alt="QueryMate mascot"
          class="block w-full max-w-[420px] h-auto object-contain"/>
      </div>

    </section>
  </main>
</body>
</html>