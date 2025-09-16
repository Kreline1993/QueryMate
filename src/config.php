<?php
// .env loader
function env(string $key, $default = null) {
    static $vars;
    if($vars === null) {
        $file = __DIR__ . '/../.env';
        if(file_exists($file)) {
            foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                if (strpos($line, '#') === 0) continue;
                [$name, $value] = array_map('trim', explode('=', $line, 2));
                $vars[$name] = $value;
            }
        }
    }
    return $vars[$key] ?? $default;
}

?>