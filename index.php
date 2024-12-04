<?php
session_start(); // Start session to retain cart data
require 'config.php'; // Database connection file

// Fetch games based on search query
$searchQuery = '';
try {
    if (isset($_GET['search']) && trim($_GET['search']) !== '') {
        $searchQuery = trim($_GET['search']);
        $stmt = $pdo->prepare("SELECT * FROM games WHERE title LIKE ?");
        $stmt->execute(['%' . $searchQuery . '%']);
    } else {
        $stmt = $pdo->query("SELECT * FROM games");
    }
    $games = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Handle adding a game to the cart when clicked
if (isset($_GET['game_id'])) {
    $gameId = (int)$_GET['game_id']; // Get the game ID
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([$gameId]);
    $game = $stmt->fetch();

    if ($game) {
        // Game found, add to cart
        $cartItem = [
            'id' => $game['id'],
            'title' => $game['title'],
            'price' => $game['price'],
            'image' => $game['image']
        ];

        // Check if cart session exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Initialize cart if not set
        }

        // Add the game to the cart session
        $_SESSION['cart'][] = $cartItem;

        // Optionally, redirect back to the homepage after adding to cart
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="style.css">
    
    <title>GameHub</title>
</head>
<body>
    <script src="js/scripts.js"></script>

    <header>
        <nav>
            <img src="images/logo.jpg" alt="GameHub Logo" class="logo">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)">Menu</a>
                    <div class="dropdown-content">
                        <a href="about.php">About Us</a>
                        <a href="contact.php">Contact Us</a>
                        
                    </div>
                </li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin.php">Admin</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Search Bar -->
    <section class="search-bar">
        <form method="GET" action="index.php" style="display: flex; justify-content: center; margin: 20px;">
            <input type="text" name="search" value="<?= htmlspecialchars($searchQuery); ?>" placeholder="Search for games..." 
                   style="width: 50%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Search</button>
        </form>
    </section>

    <main>
        
        <div class="container">
            <div class="games-section">
                <h1>Available Games</h1>
                <div class="games-grid">
                    <?php if (!empty($games)): ?>
                        <?php foreach ($games as $game): ?>
                            <div class="game-card">
                                <a href="cart.php?add_game=<?= $game['id']; ?>">
                                    <img src="images/<?= htmlspecialchars($game['image']); ?>" alt="<?= htmlspecialchars($game['title']); ?>">
                                    <h2><?= htmlspecialchars($game['title']); ?></h2>
                                    <p class="price">$<?= number_format($game['price'], 2); ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; color: gray;">No games found for "<?= htmlspecialchars($searchQuery); ?>"</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
