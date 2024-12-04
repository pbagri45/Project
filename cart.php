<?php
session_start();
require 'config.php';

// If a game is being added to the cart, handle it
if (isset($_GET['add_game'])) {
    $game_id = $_GET['add_game'];

    // Get the game details from the database
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([$game_id]);
    $game = $stmt->fetch();

    // Add the game to the cart in the session
    if ($game) {
        $_SESSION['cart'][] = [
            'id' => $game['id'],
            'title' => $game['title'],
            'price' => $game['price'],
            'image' => $game['image']
        ];
    }

    // Redirect to the cart page
    header('Location: cart.php');
    exit;
}

// If a game is being removed from the cart
if (isset($_GET['remove_game'])) {
    $remove_id = $_GET['remove_game'];

    // Loop through the cart to find the game and remove it
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
            break;
        }
    }

    // Redirect back to the cart page after removing the item
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub - Cart</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image:url('images/ps5.jpg');
            margin: 0;
            padding: 0;
        }
        
        header {
            padding: 10px 0;
            text-align: center;
            
        }
        
        header nav {
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        
        header nav ul li {
            margin: 0 20px;
        }
        
        header nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }
        
        header nav ul li a:hover {
            color: #ffcc00;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: white;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-items ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .cart-items ul li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background-color: cornsilk;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cart-items ul li img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-items ul li h3 {
            flex-grow: 1;
            margin: 0 20px;
            font-size: 1.2rem;
            color: #333;
        }

        .cart-items ul li p {
            font-size: 1.1rem;
            color: #333;
        }

        .btn {
            background-color: orange;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            display: block;
            width: 200px;
            margin: 20px auto;
            font-size: 1.2rem;
        }

        .btn:hover {
            background-color: #e6b800;
        }

        .remove-btn {
            background-color: orange;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }

        .remove-btn:hover {
            background-color: #e60000;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <nav>
        <img src="images/logo.jpg" alt="GameHub Logo" class="logo" style="width: 150px;">
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Your Cart</h1>
            <div class="cart-items">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <ul>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <li>
                                <img src="images/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['title']); ?>" class="cart-item-image">
                                <h3><?= htmlspecialchars($item['title']); ?></h3>
                                <p>$<?= number_format($item['price'], 2); ?></p>
                                <a href="cart.php?remove_game=<?= htmlspecialchars($item['id']); ?>" class="remove-btn">Remove</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="checkout.php" class="btn">Proceed to Checkout</a>
                    <a href="index.php" class="btn">Continue Shopping</a>
                <?php else: ?>
                    <p class="empty-cart">Your cart is empty.</p>
                    <a href="index.php" class="btn">Continue Shopping</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
