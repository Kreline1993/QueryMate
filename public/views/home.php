<?php
$pageTitle = 'home';
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/nav_bar.php';
?>
<main class="w-full flex items-center justify-center">
<section class="w-[75vw] min-h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-8 overflow-hidden">
  <h1 class="text-3xl font-semibold text-center mb-8">Welcome to QueryMate!</h1>
      <p class="text-xl font-semibold text-center mb-6">Your friendly SQL tutor</p>
      <!-- If not logged in(no session) user is shown log in and sign up options -->
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


      <form class="w-3/4 mx-auto space-y-4" method="post" action="/querymate/public/?r=auth/login">
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
        href="/querymate/public/?r=auth/register"
        class="block w-3/4 text-center mt-4 px-5 py-2.5 rounded-lg font-semibold text-white shadow
        bg-gradient-to-r from-[#4193C9] to-[#42AA94]
        hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
        Sign up
      </a>
    </div>
  </div>
      <!-- If user logged in show only mascot image-->
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
<?php include __DIR__ . '/partials/footer.php'; ?>