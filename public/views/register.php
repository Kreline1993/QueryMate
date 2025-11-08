<?php
// Expects: $pageTitle, $errors, $data, $success
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/nav_bar.php';
?>

<main class="w-screen flex items-center justify-center">
  <section class="w-[75vw] min-h-[80vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-hidden">
    <h1 class="text-3xl font-semibold text-center">Sign Up</h1>

    <?php if (!empty($success)): ?>
      <div class="w-1/2 mx-auto mb-4 p-3 rounded-md bg-green-100 text-green-800 border border-green-300">
        Registration successful! You can now sign in.
      </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="w-1/2 mx-auto mb-4 p-3 rounded-md bg-red-100 text-red-800 border border-red-300">
        <strong>Please fix the following errors:</strong>
        <ul class="list-disc list-inside mt-2 text-sm">
          <?php foreach ($errors as $message): ?>
            <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form class="w-1/2 mx-auto space-y-6" method="post" action="/querymate/public/?r=auth/register">
      <div>
        <label for="username" class="block text-sm font-medium mb-2">Username</label>
        <input
          class="w-full px-3 py-2 rounded-md bg-gray-50 border border-gray-400 text-gray-900"
          type="text"
          id="username"
          name="username"
          required
          maxlength="32"
          value="<?= $data['username'] ?? '' ?>">
        <?php if (!empty($errors['username'])): ?>
          <p class="mt-1 text-sm text-red-700">
            <?= htmlspecialchars($errors['username'], ENT_QUOTES, 'UTF-8') ?>
          </p>
        <?php endif; ?>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium mb-2">Email</label>
        <input
          class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900"
          type="email"
          id="email"
          name="email"
          required
          value="<?= $data['email'] ?? '' ?>">
        <?php if (!empty($errors['email'])): ?>
          <p class="mt-1 text-sm text-red-700">
            <?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?>
          </p>
        <?php endif; ?>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium mb-2">Password</label>
        <input
          class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900"
          type="password"
          id="password"
          name="password"
          required
          autocomplete="new-password">
      </div>

      <div>
        <label for="confirmpassword" class="block text-sm font-medium mb-2">Confirm Password</label>
        <input
          class="w-full px-3 py-2 rounded-md bg-gray-100 border border-gray-400 text-gray-900"
          type="password"
          id="confirmpassword"
          name="confirmpassword"
          required
          autocomplete="new-password">
        <?php if (!empty($errors['password'])): ?>
          <p class="mt-1 text-sm text-red-700">
            <?= htmlspecialchars($errors['password'], ENT_QUOTES, 'UTF-8') ?>
          </p>
        <?php endif; ?>
      </div>

      <div>
        <button
          type="submit"
          class="cursor-pointer w-full py-2 px-4 rounded-md text-white font-medium
                 bg-gradient-to-r from-[#42AA94] to-[#4193C9]
                 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
          Sign Up
        </button>
      </div>
    </form>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>