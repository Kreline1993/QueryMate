<?php $page = 'tutor'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="/querymate/public/assets/css/output.css?v=2">
</head>
<body class="min-h-screen bg-gradient-to-tl from-[#42AA94] to-[#4193C9] text-gray-900">

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


  <main class="w-full flex items-center justify-center">
    <section class="w-[50vw] h-[75vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-auto">
      <h1 class="text-3xl font-semibold text-center">QueryMate Tutor</h1>
      <p class="text-center">Check your SQL or ask for explainations.</p>
<div class="mt-6 flex justify-center gap-4">
This is the tutor
</div>



    </section>
  </main>
</body>
</html>