<?php
session_start();
require 'config.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
        exit;
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameHub</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f7f7f7;">
    <header>
        <nav style="background-color: gray; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000;">
            <img src="images/logo.jpg" alt="GameHub Logo" style="width: 100px; height: auto;">
            <ul style="display: flex; list-style-type: none; margin: 0; padding: 0;">
                <li style="margin-left: 20px;"><a href="index.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; display: block;">Home</a></li>
                <li style="margin-left: 20px;"><a href="login.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; display: block;">Login</a></li>
                <li style="margin-left: 20px;"><a href="register.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; display: block;">Register</a></li>
            </ul>
        </nav>
    </header>

    <main style="display: flex; justify-content: center; align-items: center; padding: 40px;">
        <div style="background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
            <h1 style="text-align: center; font-size: 24px; margin-bottom: 20px;">Login</h1>

            <?php if (isset($error_message)): ?>
                <p style="color: red; font-size: 14px; margin-bottom: 10px;"><?= htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <form method="POST">
                <div style="margin-bottom: 15px;">
                    <label for="username" style="display: block; font-weight: bold;">Username</label>
                    <input type="text" id="username" name="username" required style="width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="password" style="display: block; font-weight: bold;">Password</label>
                    <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                </div>
                <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: block; width: 100%; margin-top: 10px;">Login</button>
            </form>

            <a href="register.php" style="display: block; text-align: center; margin-top: 15px; color: #333; font-size: 14px;">Don't have an account? Register here</a>
        </div>
    </main>
</body>
</html>
