<?php
// welcome.php - only reachable when logged in. This is the "protected"
// page: it checks $_SESSION['user_id'] before showing anything, and
// bounces visitors back to the login page if it's missing.

session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h1>Well done!</h1>
        <p>You're logged in as <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>.</p>
        <a class="link" href="logout.php">Log out</a>
    </div>
</body>
</html>
