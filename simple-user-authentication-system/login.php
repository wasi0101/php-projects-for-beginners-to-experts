<?php
// login.php - checks a username/password against the database and, if
// they match, starts a "session" for that visitor.
//
// A session is how the server remembers you're logged in as you move
// from page to page - PHP gives the browser a small cookie with a
// session ID, and stores your data (like $_SESSION['user_id']) on the
// server, tied to that ID.

session_start();
require __DIR__ . '/db.php';

// Already logged in? No need to log in again.
if (!empty($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // password_verify() checks the typed password against the stored
    // hash. We show the same generic error whether the username was
    // wrong or the password was wrong, so an attacker can't use the
    // error message to guess which usernames exist.
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: welcome.php');
        exit;
    }

    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h1>Log In</h1>

        <?php if (!empty($_GET['registered'])): ?>
            <div class="success">Account created! You can log in now.</div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($username ?? '') ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Log In</button>
        </form>

        <a class="link" href="register.php">Don't have an account? Sign up</a>
    </div>
</body>
</html>
