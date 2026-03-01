<?php
session_start();

// Check if logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: auth/login.php');
    exit;
}

// Redirect to appBrowser after successful login
header('Location: appBrowser/');
exit;
?>