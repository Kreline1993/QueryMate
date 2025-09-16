<?php $page = 'home'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>QueryMate — Home</title>
  <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=1">
</head>
<body class="min-h-screen bg-gray-500 text-gray-900">
  <!-- Nav -->
  <header class="w-full mx-auto p-4 flex justify-center">
    <nav class="w-[50vw] bg-gray-300 rounded-xl shadow border border-black/10 flex items-center justify-center gap-1 p-2">
      <a href="/querymate/index.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
      ?>">Home</a>
      <a href="/querymate/public/views/tutor.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'tutor') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' 
      ?>">Tutor</a>
      <a href="/querymate/public/views/builder.php"class="px-3 py-2 rounded-lg text-sm font-medium 
      <?php echo ($page === 'builder') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
      ?>">Builder</a>
    </nav>
  </header>

<body class="min-h-screen bg-gray-700 text-gray-900 flex items-center justify-center p-4">
  <main class="w-full flex items-center justify-center">
    <section class="w-[50vw] h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-hidden">
      <h1 class="text-3xl font-semibold text-center">Welcome to QueryMate!</h1>
      <p class="text-center">Choose either tutor or builder mode.</p>
<div class="mt-6 flex justify-center gap-4">
  <a href="/querymate/public/views/tutor.php"
          class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white shadow
            bg-[#4193C9] hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4193C9]">
    Tutor
  </a>
  <a href="/querymate/public/views/builder.php"
     class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-semibold text-white shadow
            bg-[#42AA94] hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#42AA94]">
    Builder
  </a>
</div>
<div class="mx-auto w-full flex justify-center">
<img
  src="/querymate/public/assets/img/QueryMateLogo.png"
  alt="QueryMate mascot"
  class="block w-full max-w-[420px] h-auto object-contain"/>
</div>



    </section>
  </main>
</body>
</html>