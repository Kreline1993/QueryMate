<?php
namespace App\Controllers;

use Gemini;

class TutorController
{
    public function indexAction(): void
    {
        // Init chat history for this session (no DB yet)
        if (!isset($_SESSION['tutor_chat'])) {
            $_SESSION['tutor_chat'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // "Start New Chat" clears current history (no cross-chat memory)
            if (isset($_POST['new_chat'])) {
                $_SESSION['tutor_chat'] = [];
            }

            // New user message
            $userMessage = trim($_POST['message'] ?? '');
            if ($userMessage !== '') {
                // Store user message for display
                $_SESSION['tutor_chat'][] = [
                    'sender' => 'user',
                    'text'   => $userMessage,
                ];

                // Get AI tutor reply from Gemini
                $reply = $this->getGeminiTutorReply($userMessage);

                $_SESSION['tutor_chat'][] = [
                    'sender' => 'tutor',
                    'text'   => $reply,
                ];
            }
        }

        $pageTitle = 'SQL Tutor';
        $messages = $_SESSION['tutor_chat'];

        require dirname(__DIR__, 2) . '/public/views/tutor.php';
    }

    /**
     * Ask Gemini (via gemini-api-php/client) for an SQL tutor style reply.
     * Stateless: each call only uses the current question.
     */
    private function getGeminiTutorReply(string $question): string
    {
    $apiKey = $_ENV['GEMINI_API_KEY'] ?? null;
    if (!$apiKey) {
        return "Tutor unavailable — missing GEMINI_API_KEY.";
    }

    try {
        // Create Gemini client via the static helper from google-gemini-php/client
        $client = Gemini::client($apiKey);

        // Short instruction so responses stay in SQL-tutor mode
        $prompt = "You are a helpful SQL tutor. "
            . "You will reply as a human teacher would."
            . "Explain clearly with short SQL examples."
            . "Do not discuss unrelated topics. If the question isn't SQL related, just say you cannot answer that."
            . "Return your entire answer as HTML only (using <p>, <strong>, <code>, <pre>, <ul>, <ol>, <li>, <br>)."
            . "Do not use Markdown syntax, especially not triple quotes."
            . "User question: " . $question;

        // Call a suitable model (check README; this is the style they show)
        $result = $client
            ->generativeModel(model: 'gemini-2.0-flash')
            ->generateContent($prompt);

        $text = trim($result->text() ?? '');
        $text = $this->cleanGeminiReply($text);

        if ($text === '') {
            return "I couldn't generate a response. Try rephrasing your SQL question.";
        }

        return $text;
    } catch (\Throwable $e) {
        // Generic error message so real errors aren't leaked
        return "Sorry, I’m having trouble reaching the tutor service right now.";
    }
}
private function cleanGeminiReply(string $text): string
{
    // Remove code block fences like ```html, ```sql, or plain ```
    $text = preg_replace('/^```[a-zA-Z]*\s*/m', '', $text); // remove opening fence
    $text = preg_replace('/```$/m', '', $text);              // remove closing fence
    $text = trim($text);

    return $text;
}
}