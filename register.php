<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
        if ($stmt->execute([$username, $hashed_password])) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href = 'login.php';</script>";
        } else {
            $error_message = "Registration failed. Please try again.";
        }
    } else {
        $error_message = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GameHub</title>
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
            <h1 style="text-align: center; font-size: 24px; margin-bottom: 20px;">Register</h1>

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
                <div style="margin-bottom: 15px;">
                    <label for="confirm_password" style="display: block; font-weight: bold;">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required style="width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
                </div>
                <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: block; width: 100%; margin-top: 10px;">Register</button>
            </form>

            <a href="login.php" style="display: block; text-align: center; margin-top: 15px; color: #333; font-size: 14px;">Already have an account? Login here</a>
        </div>
    </main>
</body>
</html>
