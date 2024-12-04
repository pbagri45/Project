<?php
session_start();
require 'config.php';

// If the user wants to clear the cart (e.g., after successful checkout)
if (isset($_GET['clear_cart']) && $_GET['clear_cart'] == 1) {
    unset($_SESSION['cart']);
    header('Location: checkout.php');
    exit;
}

// Fetch payment methods from the database
$purchase_methods = $pdo->query("SELECT * FROM purchase_methods")->fetchAll();

// Handle checkout form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simulate the checkout process
    unset($_SESSION['cart']);
    echo "<script>alert('Thank you for your purchase!'); window.location.href = 'index.php';</script>";
    exit;
}

// Calculate total price
$total = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>GameHub - Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image:url('images/ps5.jpg');
            margin: 0;
            padding: 0;
        }

        header {
           
            padding: 10px 0;
        }

        header nav {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        header nav ul {
            list-style: none;
            display: flex;
            padding: 0;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        header nav ul li a:hover {
            color: orange;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: cornsilk;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart-items ul {
            list-style: none;
            padding: 0;
        }

        .cart-items ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .cart-items ul li img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
            object-fit: cover;
        }

        .cart-items ul li h3, .cart-items ul li p {
            margin: 0 10px;
        }

        .btn {
            display: inline-block;
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #cc7a00;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .cart-options {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="checkout.php">Checkout</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="container">
        <h1>Checkout</h1>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <div class="cart-items">
                <h2>Your Order</h2>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li>
                            <img src="images/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['title']); ?>">
                            <h3><?= htmlspecialchars($item['title']); ?></h3>
                            <p>$<?= number_format($item['price'], 2); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h3>Total: $<?= number_format($total, 2); ?></h3>

                <form method="POST">
                    <h3>Billing Information</h3>
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method:</label>
                        <select id="payment_method" name="payment_method" required>
                            <?php foreach ($purchase_methods as $method): ?>
                                <option value="<?= htmlspecialchars($method['id']); ?>"><?= htmlspecialchars($method['method_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn">Complete Purchase</button>
                </form>

                <div class="cart-options">
                    <a href="checkout.php?clear_cart=1" class="btn">Clear Cart</a>
                    <a href="index.php" class="btn">Continue Shopping</a>
                </div>
            </div>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty. Please add items to the cart before proceeding to checkout.</p>
            <a href="index.php" class="btn">Go to Home</a>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
