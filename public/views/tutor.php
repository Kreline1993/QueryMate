<?php $pageTitle = 'tutor';

include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/nav_bar.php';
?>

  <main class="w-full flex items-center justify-center">
    <section class="w-[75vw] min-h-[80vh] bg-gray-300 rounded-2xl shadow-lg p-6 overflow-auto">
      <h1 class="text-3xl font-semibold text-center">QueryMate Tutor</h1>
      <p class="text-center">Check your SQL or ask for explainations.</p>
<div class="mt-6 flex justify-center gap-4">
    <!-- Start New Chat: posts back with new_chat flag -->
    <form method="post" class="mb-4 text-right">
      <button
        type="submit"
        name="new_chat"
        value="1"
        class="inline-block px-4 py-2 rounded-md text-xs font-semibold text-white
               bg-gradient-to-r from-[#919191] to-[#555555] hover:opacity-90">
        Start New Chat
      </button>
    </form>

    <!-- Chat history -->
    <div class="flex-1 bg-gray-100 rounded-lg p-4 mb-4 overflow-y-auto">
      <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
          <?php
            $isUser = $msg['sender'] === 'user';
            $align  = $isUser ? 'items-end' : 'items-start';
            $bg     = $isUser
                      ? 'bg-[#4193C9] text-white'
                      : 'bg-white text-gray-900';
            $label  = $isUser ? 'You' : 'Tutor';
          ?>
          <div class="mb-2 flex <?= $align ?>">
            <div class="max-w-[70%] px-3 py-2 rounded-lg shadow text-sm <?= $bg ?>">
              <div class="font-semibold mb-1"><?= $label ?></div>
              <div class="whitespace-pre-wrap">
                <?= htmlspecialchars($msg['text'], ENT_QUOTES, 'UTF-8') ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-sm text-gray-600">
          No messages yet. Ask something like:
          <span class="font-semibold">"How do I select specific columns from a table?"</span>
        </p>
      <?php endif; ?>
    </div>

    <!-- Message input -->
    <form method="post" class="flex gap-2">
      <input
        type="text"
        name="message"
        required
        placeholder="Type your SQL question here..."
        class="flex-1 px-3 py-2 rounded-md border border-gray-400 bg-white text-gray-900"
      />
      <button
        type="submit"
        class="px-4 py-2 rounded-md font-semibold text-white
               bg-gradient-to-r from-[#42AA94] to-[#4193C9] hover:opacity-90">
        Send
      </button>
    </form>
</div>



    </section>
  </main>
<?php include __DIR__ . '/partials/footer.php'; ?>