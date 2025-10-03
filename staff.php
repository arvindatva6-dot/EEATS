<?php include(__DIR__ . '/includes/auth.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard | EarlyEats</title>
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
            border-left: 4px solid #3498db;
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
        <h2>👨‍🍳 Staff Panel</h2>
        <a href="#">📦 Manage Orders</a>
        <a href="#">📅 Booking Schedule</a>
        <a href="#">🍴 Update Menu</a>
        <a href="#">📊 Reports</a>
    </div>

    <!-- Main -->
    <div class="main">
        <!-- Header -->
        <div class="header">
            <h1>Welcome, <?= ucfirst($_SESSION['role']); ?>!</h1>
            <a href="../logout.php" class="logout">Logout</a>
        </div>

        <!-- Dashboard Content -->
        <div class="content">
            <div class="card">
                <h2>Dashboard Overview</h2>
                <p>Here you can manage orders, check today’s bookings, and update the canteen menu.</p>
            </div>

            <div class="card">
                <h2>Quick Actions</h2>
                <p>- View pending orders</p>
                <p>- Add new menu item</p>
                <p>- Check pickup schedules</p>
            </div>
        </div>
    </div>
</body>
</html>
