<?php include(__DIR__ . '/includes/auth.php'); ?>
<?php
include(__DIR__ . '/includes/db.php');
$menu = $conn->query("SELECT * FROM menu_items WHERE available = 1")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | EarlyEats</title>
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
        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: 600;
            color: #2c3e50;
            text-align: left;
        }
        select, input, button {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
        }
        button {
            background: #3498db;
            color: #fff;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #2980b9;
        }
        .success {
            color: green;
            font-weight: 600;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🎓 Student Panel</h2>
        <a href="#">🛒 Place Order</a>
        <a href="#">📜 My Orders</a>
        <a href="#">⏰ Pickup Schedule</a>
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
                <h2>Place a New Order</h2>
                <form method="POST" action="student.php">
                    <label for="item">Select Item:</label>
                    <select name="item_id" required>
                        <?php foreach ($menu as $item): ?>
                            <option value="<?= $item['id'] ?>">
                                <?= $item['name'] ?> - ₹<?= $item['price'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" min="1" required>

                    <label for="pickup_time">Pickup Time:</label>
                    <input type="datetime-local" name="pickup_time" required>

                    <button type="submit" name="book">Place Order</button>
                </form>

                <?php
                if (isset($_POST['book'])) {
                    $user_id = $_SESSION['user'];
                    $item_id = $_POST['item_id'];
                    $quantity = $_POST['quantity'];
                    $pickup_time = $_POST['pickup_time'];

                    $stmt = $conn->prepare("INSERT INTO orders (user_id, item_id, quantity, pickup_time) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiis", $user_id, $item_id, $quantity, $pickup_time);

                    if ($stmt->execute()) {
                        echo "<p class='success'>✅ Order placed successfully!</p>";
                    } else {
                        echo "<p class='error'>❌ Error: " . $conn->error . "</p>";
                    }
                }
                ?>
            </div>

            <div class="card">
                <h2>My Recent Orders</h2>
                <p>(This section can display student’s past orders)</p>
            </div>
        </div>
    </div>
</body>
</html>
