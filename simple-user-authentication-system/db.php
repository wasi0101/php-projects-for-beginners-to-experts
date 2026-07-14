<?php
// db.php - opens (or creates) the SQLite database and makes sure the
// "users" table exists. Every other page includes this file first.
//
// SQLite stores the whole database as a single file on disk, so there is
// no separate database server to install or configure - great for
// learning how authentication works without extra setup.

$dbFile = __DIR__ . '/data/users.sqlite';

$pdo = new PDO('sqlite:' . $dbFile);

// Throw exceptions on errors instead of failing silently - much easier
// to debug as a beginner.
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password_hash TEXT NOT NULL,
        created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
    )
');
