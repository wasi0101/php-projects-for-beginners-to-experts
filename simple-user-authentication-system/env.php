<?php
// env.php - loads key=value pairs from a .env file into environment
// variables. This is how you keep secrets (API keys, passwords, tokens)
// out of your PHP code and out of git: they live in a local .env file
// instead, which .gitignore excludes from version control.
//
// This project has no real secrets today, but db.php reads DB_PATH from
// here as an example of the pattern - use the same approach for any
// future API key: put NAME=value in .env, then read it with getenv().

function load_env(string $path): void
{
    if (!file_exists($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$name, $value] = array_map('trim', explode('=', $line, 2));
        $value = trim($value, '"\'');

        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

load_env(__DIR__ . '/.env');
