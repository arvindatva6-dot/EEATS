<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
error_reporting(E_ERROR | E_PARSE);
include(__DIR__ . '/dashboard/includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                switch ($user['role']) {
                    case 'student': header("Location: dashboard/student.php"); break;
                    case 'staff': header("Location: dashboard/staff.php"); break;
                    case 'admin': header("Location: dashboard/admin.php"); break;
                    default: header("Location: dashboard/student.php");
                }
                exit;
            } else $error = "Incorrect password.";
        } else $error = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | EarlyEats</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
   body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: url('bgl.jpg') no-repeat center center;
    background-size: cover;  /* Important! makes image cover full screen */
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}


    .login-container {
        background: linear-gradient(135deg, #686663ff 0%, #0c0703ff 100%);
        border-radius: 20px;
        padding: 40px 35px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        color: #fff;
    }
    h2 {
        margin-bottom: 25px;
        font-weight: 600;
        font-size: 1.8em;
    }
    input {
        width: 100%; padding: 14px; margin: 10px 0;
        border-radius: 10px; border: none;
        font-size: 1em;
        outline: none;
    }
    input::placeholder { color: #555; }
    button {
        width: 100%; padding: 14px; margin-top: 15px;
        background: #e09c5bff; color: #ff9900ff;
        font-size: 1em; border: none; border-radius: 10px;
        cursor: pointer; font-weight: 600;
        transition: 0.3s;
    }
    button:hover { background: #000000ff; }
    .success { color: #33302fff; margin-bottom: 15px; }
    .error { color: #000000ff; margin-bottom: 15px; }
    p { margin-top: 15px; color: #fff; }
    a { color: #fff; text-decoration: underline; }
</style>


</head>
<body>
<div class="login-container">
    <h2>Login to EarlyEats 🍔</h2>
    <?php if(isset($_GET['registered'])): ?><div class="success">Registration successful! Please login.</div><?php endif; ?>
    <?php if(isset($error)): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>New user? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
