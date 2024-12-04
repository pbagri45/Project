<?php
// Include the authenticate file to protect the admin panel
require 'authenticate.php'; // Ensure admin authentication
require 'config.php';       // Include database connection

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add_game'])) {
            $stmt = $pdo->prepare("INSERT INTO games (title, price, image) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['title'], $_POST['price'], $_POST['image']]);
        } elseif (isset($_POST['edit_game'])) {
            $stmt = $pdo->prepare("UPDATE games SET title = ?, price = ?, image = ? WHERE id = ?");
            $stmt->execute([$_POST['title'], $_POST['price'], $_POST['image'], $_POST['id']]);
        } elseif (isset($_POST['delete_game'])) {
            $stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
            $stmt->execute([$_POST['id']]);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch games from the database
$games = $pdo->query("SELECT * FROM games")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - GameHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: gray;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        form {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.add { background-color: orange; color: white; }
        button.edit { background-color: green; color: white; }
        button.delete { background-color: red; color: white; }
    </style>
</head>
<body>
<header>
    <h1>Admin Panel</h1>
    <a href="logout.php" style="color: orange; text-decoration: none;">Logout</a>
</header>
<main style="padding: 20px;">
    <h2>Add Game</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="price" placeholder="Price" required>
        <input type="text" name="image" placeholder="Image URL" required>
        <button type="submit" name="add_game" class="add">Add Game</button>
    </form>

    <h2>Manage Games</h2>
    <?php foreach ($games as $game): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $game['id']; ?>">
            <input type="text" name="title" value="<?= htmlspecialchars($game['title']); ?>">
            <input type="text" name="price" value="<?= htmlspecialchars($game['price']); ?>">
            <input type="text" name="image" value="<?= htmlspecialchars($game['image']); ?>">
            <button type="submit" name="edit_game" class="edit">Edit</button>
            <button type="submit" name="delete_game" class="delete">Delete</button>
        </form>
    <?php endforeach; ?>
</main>
</body>
</html>
