<?php
// session_start();
// require '../includes/db.php';
// require '../includes/functions.php';

// if (!isLoggedIn() || !isAdmin()) {
//     redirect('login.php');
// }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <!-- <img src="../assets/images/logo.png" alt="Logo"> -->
        <a href="logout.php" class="logout">Logout</a>
    </header>
    <div style="display: flex;">
        <nav>
            <ul>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="manage_furniture.php">Manage Furniture</a></li>
                <li><a href="manage_customers.php">Manage Customers</a></li>
                <li><a href="receive_order.php">Receive Orders</a></li>
            </ul>
        </nav>
        <main>
            <h1>Welcome, Admin</h1>
            <?php displayFlashMessage(); ?>
            <!-- Main content goes here -->
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
