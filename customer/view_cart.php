<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if (!isLoggedIn() || !isCustomer()) {
    redirect('login.php');
}

$customer_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM cart WHERE customer_id = :customer_id");
$stmt->execute(['customer_id' => $customer_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Cart</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <img src="../assets/images/logo.png" alt="Logo">
        <a href="logout.php" class="logout">Logout</a>
    </header>
    <div style="display: flex;">
        <nav>
            <ul>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="view_furniture.php">View Furniture</a></li>
                <li><a href="search_furniture.php">Search Furniture</a></li>
                <li><a href="make_order.php">Make Order</a></li>
                <li><a href="view_cart.php">View Cart</a></li>
            </ul>
        </nav>
        <main>
            <h1>Your Shopping Cart</h1>
            <ul>
                <?php foreach ($cart_items as $item): ?>
                    <li class="cart-item">
                        <img src="../assets/images/sample_furniture.jpg" alt="Furniture Image">
                        <p>Furniture ID: <?= htmlspecialchars($item['furniture_id']) ?></p>
                        <p>Quantity: <?= htmlspecialchars($item['quantity']) ?></p>
                        <button>Remove</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>