  <header class="w-full mx-auto p-4 flex justify-center">
    <nav class="w-[75vw] bg-gray-300 rounded-xl shadow border border-black/10 flex items-center justify-center gap-1 p-2">
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Logged in links -->
        <?php 
        $navStyling = ''; // for page dependent styling

        if ($pageTitle === 'home') {
          $navStyling = 'text-blue-600 bg-blue-50'; // tailwind styling if active
        } else {
          $navStyling = 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'; // default tailwind styling
        }
        ?>
        <a href="/querymate/index.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
        <?php echo $navStyling; /* Pass rest of styling */?>">Home</a>

        <?php
        if ($pageTitle === 'tutor') {
          $navStyling = 'text-blue-600 bg-blue-50'; // tailwind styling if active
        } else {
          $navStyling = 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'; // default tailwind styling
        }
        ?>
        
        <a href="/querymate/public/views/tutor.php"  class="px-3 py-2 rounded-lg text-sm font-medium 
        <?php echo $navStyling; /* Pass rest  of styling */?>">Tutor</a>
        
        <a href="public\views\logout.php" 
        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100"
        >Log out</a>

    <?php elseif ($pageTitle === 'Register'): ?>
        <!-- Register page (cancel) -->
        <a href="/querymate/index.php"  
        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100">
        Cancel</a> 

    <?php else: ?>
    <!-- Not logged in, not on register page -->
    <!-- Empty, minimal bar shown -->
    <?php endif; ?>
    </nav>
  </header>