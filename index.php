<?php /* index.php — Tailwind test homepage */ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="dist/output.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-700 text-gray-900 flex items-center justify-center p-6">
  <main class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
    <header class="px-6 py-4 border-b border-black/10 flex items-center justify-between">
      <h1 class="text-xl font-semibold">QueryMate — Tailwind Test - Going Poorly</h1>
      <span class="text-xs text-gray-500">XAMPP • PHP + Ollama</span>
    </header>

    <section class="p-6 space-y-4">
      <div>
        <label for="sql" class="block text-sm font-medium">Your SQL</label>
        <!-- TEAL input box -->
        <textarea id="sql"
          class="mt-1 w-full min-h-[140px] rounded-xl bg-teal-500 text-black placeholder-white/80 p-4 font-mono text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-white/60"
          placeholder="Paste your SQL here..."></textarea>
      </div>

      <div class="flex gap-3 flex-wrap">
        <button id="btnAnalyze"
          class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-black transition">Analyze</button>
        <button id="btnClear"
          class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition">Clear</button>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Response</label>
        <!-- MEDIUM BLUE response box -->
        <div id="out"
          class="rounded-xl bg-blue-500 text-white p-4 min-h-[120px] whitespace-pre-wrap font-mono text-sm shadow-inner">
          —
        </div>
      </div>
      </body>
</html>