<?php
session_start();

// Simple PHP session-based authentication
$username = 'rongallant';
$password = 'sRedbilbo73';

// Handle login form submission
if ($_POST['username'] && $_POST['password']) {
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['logged_in'] = true;
        header('Location: ../appBrowser/');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}

// Logout
if ($_GET['logout']) {
    session_destroy();
    header('Location: ../appBrowser/');
    exit;
}

// Check if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../appBrowser/');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Site Menu</title>
    <style>
        body { font-family: arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f5f5f5; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; }
        input { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #005a87; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Required</h2>
        <?php if (isset($error)) echo '<div class="error">' . $error . '</div>'; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
