<?php
// Initialize the message variable
$thankYouMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Here, you would typically process the form, save to database, send email, etc.
    // For now, we'll just simulate a success message

    // Set the thank you message after form submission
    $thankYouMessage = "Thank you for your feedback, $name! We will get back to you shortly.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GameHub</title>
    <style>
       <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        padding: 20px;
        margin: 0;
    }

    header {
        background-color: #222;
        color: white;
        padding: 15px;
        text-align: center;
    }

    header h1 {
        margin: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .form-group textarea {
        height: 150px;
    }

    .btn {
        background-color: orange; /* Changed to orange */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
    }

    .btn:hover {
        background-color: #e87a00; /* Darker orange on hover */
    }

    .thank-you-message {
        color: #4CAF50;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }

    .back-to-home {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: orange; /* Changed to orange */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
    }

    .back-to-home:hover {
        background-color: #e87a00; /* Darker orange on hover */
    }

</style>


    </style>
</head>
<body>

<header>
    <h1>Contact Us</h1>
</header>

<div class="container">
    <?php if ($thankYouMessage): ?>
        <div class="thank-you-message">
            <?= $thankYouMessage; ?>
        </div>
    <?php else: ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="btn">Send Message</button>
        </form>
    <?php endif; ?>
</div>

<!-- Back to Home Button -->
<a href="index.php">
    <button class="back-to-home">Back to Home</button>
</a>

</body>
</html>
