<?php
session_start();

// Destroy the session to log out the user
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session itself

// Redirect to the login page or any desired page
header("Location: login.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - GameHub</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f7f7f7;">
    <header>
        <nav style="background-color: gray; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 1000;">
            <img src="images/logo.jpg" alt="GameHub Logo" style="width: 100px; height: auto;">
            <ul style="display: flex; list-style-type: none; margin: 0; padding: 0;">
                <li style="margin-left: 20px;"><a href="index.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; display: block;">Home</a></li>
                <li style="margin-left: 20px;"><a href="login.php" style="color: white; text-decoration: none; font-size: 16px; padding: 5px 10px; display: block;">Login</a></li>
            </ul>
        </nav>
    </header>

    <main style="display: flex; justify-content: center; align-items: center; padding: 40px;">
        <div style="background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px; text-align: center;">
            <h1 style="font-size: 24px; margin-bottom: 20px;">You have been logged out</h1>
            <p style="font-size: 16px; margin-bottom: 20px;">Thank you for visiting GameHub!</p>
            <a href="login.php" style="background-color: orange; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 16px;">Login Again</a>
        </div>
    </main>
</body>
</html>
