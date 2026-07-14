<?php
// logout.php - clears the session so the visitor is signed out.

session_start();
$_SESSION = [];
session_destroy();

header('Location: login.php');
exit;
