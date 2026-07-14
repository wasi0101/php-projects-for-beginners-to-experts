# Simple User Authentication System

A beginner-friendly PHP project: create an account, log in, and see a
"Well done!" page once you're signed in.

No frameworks, no Composer, no database server to install — just plain
PHP and SQLite (a database that lives in a single file).

## How to run it

You need PHP installed (8.0+). From inside this folder, run:

```bash
php -S localhost:8000
```

Then open http://localhost:8000 in your browser. It'll take you to the
login page — click "Sign up" to create your first account.

## Files

| File          | Purpose                                                             |
|---------------|----------------------------------------------------------------------|
| `db.php`      | Connects to the SQLite database and creates the `users` table.       |
| `register.php`| Form to create a new account.                                        |
| `login.php`   | Form to log in with an existing account.                             |
| `welcome.php` | The protected "Well done!" page — only visible when logged in.       |
| `logout.php`  | Clears your session and signs you out.                               |
| `index.php`   | Just redirects to the login page.                                    |
| `style.css`   | Basic styling so the pages don't look bare.                          |

The database file itself (`data/users.sqlite`) is created automatically
the first time you load a page, and is not committed to git (see
`.gitignore`) — everyone who runs the project gets their own fresh copy.

## What this project teaches

- **Sessions** — how `session_start()` and `$_SESSION` let the server
  remember that a specific visitor is logged in as they move between
  pages.
- **Password hashing** — passwords are never stored as plain text.
  `password_hash()` scrambles the password before it's saved, and
  `password_verify()` checks a login attempt against that scrambled
  value. Even if someone stole the database, they wouldn't see anyone's
  actual password.
- **Prepared statements** — every database query uses `?` placeholders
  (via PDO) instead of gluing user input directly into the SQL string.
  This prevents SQL injection, one of the most common web
  vulnerabilities.
- **Protecting a page** — `welcome.php` checks `$_SESSION['user_id']` at
  the very top and redirects to the login page if it's missing. That's
  the basic pattern behind any "you must be logged in" page.
- **Escaping output** — anything printed back into the HTML (like the
  username) goes through `htmlspecialchars()` to prevent XSS (someone
  registering a username like `<script>...</script>`).

## Ideas to extend it (optional, once you're comfortable)

- Add a "remember me" option using a longer-lived cookie.
- Add email verification.
- Add rate limiting on login attempts to slow down password guessing.
- Switch from SQLite to MySQL and see what changes (hint: almost
  nothing, because PDO abstracts the database).
