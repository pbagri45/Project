<?php
// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mock admin credentials (Replace with database validation in production)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'adminpass');

// Function to regenerate session ID to protect against session fixation attacks
function regenerateSession() {
    session_regenerate_id(true);
}

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Check HTTP Basic Authentication credentials
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
        $_SERVER['PHP_AUTH_USER'] !== ADMIN_USERNAME || 
        $_SERVER['PHP_AUTH_PW'] !== ADMIN_PASSWORD) {
        
        // Prompt for credentials if invalid
        header('WWW-Authenticate: Basic realm="Admin Panel"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Access Denied: Valid credentials are required.";
        exit;
    }

    // If credentials are correct, set session variables and regenerate the session ID
    $_SESSION['logged_in'] = true;
    $_SESSION['role'] = 'admin'; // Assign role for admin

    // Regenerate the session ID to prevent session fixation attacks
    regenerateSession();
}

// Optional: Log out functionality (e.g., to allow logging out of the admin panel)
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location: login.php');
    exit;
}

// Optional: Additional session handling logic (e.g., expiration, logging, etc.) can be added here.
?>
