<?php include(__DIR__ . '/includes/auth.php'); ?>
<?php
include(__DIR__ . '/includes/auth.php');
include(__DIR__ . '/includes/db.php');

// Handle new item submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stmt = $conn->prepare("INSERT INTO menu_items (name, price, available) VALUES (?, ?, 1)");
    $stmt->bind_param("sd", $name, $price);
    $stmt->execute();
}


// Fetch menu items
$menu = $conn->query("SELECT * FROM menu_items ORDER BY id DESC");

// Fetch recent orders
$orders = $conn->query("
    SELECT o.id, u.name AS student, m.name AS item, o.quantity, o.pickup_time, o.status
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN menu_items m ON o.item_id = m.id
    ORDER BY o.created_at DESC
    LIMIT 10
");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | EarlyEats</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
    display: flex;
    height: 100vh;
}

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #ecf0f1;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.4em;
        }
        .sidebar a {
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            transition: 0.3s;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: #34495e;
            border-left: 4px solid #e67e22;
        }
        /* Main content */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #fff;
            padding: 15px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 1.6em;
            color: #2c3e50;
        }
        .header .logout {
            background: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .header .logout:hover {
            background: #c0392b;
        }
        .content {
            padding: 30px;
        }
        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card h2 {
            margin-top: 0;
            color: #34495e;
            margin-bottom: 15px;
        }
        .card p {
            color: #555;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🛠️ Admin Panel</h2>
        <a href="#">👥 Manage Users</a>
        <a href="#">📊 Analytics</a>
        <a href="#">🍴 Menu Control</a>
        <a href="#">📦 Orders Overview</a>
        <a href="#">⚙️ Settings</a>
    </div>

    <!-- Main -->
    <div class="main">
        <!-- Header -->
        <div class="header">
            <h1>Welcome, <?= ucfirst($_SESSION['role']); ?>!</h1>
            <a href="../logout.php" class="logout">Logout</a>
        </div>

        <!-- Dashboard Content -->
        <div class="content"><div class="card">
    <h2>🍴 Menu Control</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Food Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price ₹" required>
        <button type="submit" name="add_item">Add Item</button>
    </form>

    <ul>
        <?php while ($item = $menu->fetch_assoc()): ?>
            <li><?= $item['name'] ?> - ₹<?= $item['price'] ?> 
                <?= $item['available'] ? '(Available)' : '(Unavailable)' ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
<div class="card">
    <h2>📦 Orders Overview</h2>
    <ul>
        <?php while ($row = $orders->fetch_assoc()): ?>
            <li>
                Order #<?= $row['id'] ?> | <?= $row['student'] ?> ordered <?= $row['quantity'] ?> x <?= $row['item'] ?> 
                (Pickup: <?= $row['pickup_time'] ?>) - Status: <?= $row['status'] ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

            <div class="card">
                <h2>Dashboard Overview</h2>
                <p>Here you can manage users, check analytics, and control canteen operations.</p>
            </div>

            <div class="card">
                <h2>Quick Actions</h2>
                <p>- Add or remove menu items</p>
                <p>- View daily/weekly reports</p>
                <p>- Manage student and staff accounts</p>
            </div>
        </div>
    </div>
</body>
</html>
