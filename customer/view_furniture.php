<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if (!isLoggedIn() || !isCustomer()) {
    redirect('login.php');
}

$limit = 10; // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$stmt = $db->prepare("SELECT * FROM furniture WHERE name LIKE :search LIMIT $start_from, $limit");
$stmt->execute(['search' => "%$search%"]);
$furniture = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Furniture</title>
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
            <h1>View Furniture</h1>
            <form method="get" action="view_furniture.php">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search furniture...">
                <button type="submit">Search</button>
            </form>
            <ul>
                <?php foreach ($furniture as $item): ?>
                    <li class="furniture-item">
                        <img src="../assets/images/sample_furniture.jpg" alt="<?= htmlspecialchars($item['name']) ?>">
                        <p><?= htmlspecialchars($item['name']) ?> - $<?= number_format($item['price'], 2) ?></p>
                        <p><?= htmlspecialchars($item['description']) ?></p>
                        <button>Add to Cart</button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div>
                <?php
                $stmt = $db->prepare("SELECT COUNT(id) FROM furniture WHERE name LIKE :search");
                $stmt->execute(['search' => "%$search%"]);
                $total_records = $stmt->fetchColumn();
                $total_pages = ceil($total_records / $limit);

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='view_furniture.php?page=$i&search=" . htmlspecialchars($search) . "'>$i</a> ";
                }
                ?>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
