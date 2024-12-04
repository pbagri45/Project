<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare("INSERT INTO games (title, description, price, category_id) VALUES (:title, :description, :price, :category_id)");
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'category_id' => $category_id
    ]);

    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Add Game</title>
</head>
<body>
    <h1>Add New Game</h1>
    <form method="POST" action="add_game.php">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <option value="1">Action</option>
            <option value="2">Adventure</option>
            <option value="3">RPG</option>
            <option value="4">Puzzle</option>
        </select>
        <button type="submit">Add Game</button>
    </form>
</body>
</html>
