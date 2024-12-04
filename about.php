<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - GameHub</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #333;
            padding: 20px;
            color: white;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
        }
        h2 {
            color: #f60;
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
        }
        .quote {
            background-color: #ffecd1;
            padding: 20px;
            font-size: 1.2em;
            font-style: italic;
            text-align: center;
            margin: 20px 0;
            border-left: 5px solid #f60;
        }
        .quote p {
            margin: 0;
        }
        .quote footer {
            margin-top: 10px;
            font-size: 1em;
            color: #666;
        }
        .about-content {
            margin-top: 30px;
        }
        .about-content p {
            line-height: 1.6;
            font-size: 1.1em;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 50px;
        }
        .back-to-home {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #f60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .back-to-home:hover {
            background-color: #e55a00;
        }
    </style>
</head>
<body>
    <header>
        <h1>GameHub - About Us</h1>
    </header>
    <div class="container">
        <h2>Who We Are</h2>
        <div class="quote">
            <p>"Bringing gamers together through passion, play, and community."</p>
            <footer>- GameHub Team</footer>
        </div>
        <div class="about-content">
            <p>GameHub is the premier online destination for gamers to discover, buy, and experience their favorite games. Whether you’re a casual gamer or a die-hard enthusiast, we provide an immersive gaming experience with a wide selection of titles across multiple platforms.</p>
            <p>Our mission is to offer the best gaming deals, provide a vibrant community for players, and ensure every gamer has the best experience possible, all while being at the forefront of the gaming industry's trends.</p>
            <p>Join us and be part of a community where every game is more than just a game; it's an adventure waiting to be explored!</p>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 GameHub. All rights reserved.</p>
    </footer>
    <button class="back-to-home" onclick="window.location.href='index.php'">Back to Home</button>
</body>
</html>
