<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
error_reporting(E_ERROR | E_PARSE);
include(__DIR__ . '/dashboard/includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!$name || !$email || !$password || !$role) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            $error = "Registration failed. Email might already be used.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register | EarlyEats</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        margin:0; padding:0;
        background: url('bgl.jpg') no-repeat center center/cover;
        display:flex; align-items:center; justify-content:center;
        min-height:100vh;
    }
    .register-container {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        border-radius: 20px;
        padding: 45px 35px;
        width: 100%;
        max-width: 420px;
        text-align:center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        color: #333;
    }
    h2 {
        margin-bottom: 25px;
        font-weight: 600;
        font-size: 1.8em;
        color: #1e3c72;
    }
    input, select {
        width:100%; padding:14px; margin:10px 0;
        border-radius:10px; border:none; outline:none;
        font-size:1em;
    }
    input::placeholder { color: #666; }
    button {
        width:100%; padding:14px; margin-top:10px;
        background:#1e3c72; color:#fff;
        font-size:1em; border:none; border-radius:10px;
        cursor:pointer; font-weight:600; transition:0.3s;
    }
    button:hover { background:#16325c; }
    .error { color:red; margin-bottom:15px; }
    p { margin-top:15px; }
    a { color:#1e3c72; text-decoration:underline; }
</style>
</head>
<body>
<div class="register-container">
    <h2>Join EarlyEats 🍕</h2>
    <?php if(isset($error)): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST" action="register.php">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        
        <!-- ✅ Submit button -->
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
