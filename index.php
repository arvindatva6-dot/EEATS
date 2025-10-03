<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>EarlyEats Canteen</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100%;        /* ensures body can grow */
    height: auto;
    background: url('indexbg.jpg') no-repeat center center fixed; /* fixed for parallax effect */
    background-size: cover;   /* fill page fully */
    background-repeat: no-repeat;
    background-position: center center;
}

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 50px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    header .logo {
        font-weight: 600;
        font-size: 1.5em;
        color: #27ae60;
    }
    nav a {
        text-decoration: none;
        color: #333;
        margin-left: 25px;
        font-weight: 500;
    }
    nav a:hover { color: #27ae60; }

    .hero {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 100px 20px;
        background: url('file_000000003b7c61f6ba43c055f2fc1eb4.png') center/cover no-repeat;
        color: white;
    }
    .hero h1 { font-size: 3em; margin-bottom: 20px; text-shadow: 1px 1px 5px rgba(0,0,0,0.5); }
    .hero p { font-size: 1.2em; margin-bottom: 30px; text-shadow: 1px 1px 5px rgba(0,0,0,0.5); }
    .btn-group a {
        padding: 12px 28px;
        margin: 0 10px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-primary { background-color: #27ae60; color: white; }
    .btn-primary:hover { background-color: #1e8449; }
    .btn-secondary {
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }
    .btn-secondary:hover { background-color: white; color: #27ae60; }

    .categories {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 80px 20px;
        background-color: #f8f9fa;
    }
    .category {
        width: 200px;
        height: 150px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.2em;
        color: white;
        transition: transform 0.3s;
    }
    .category:hover { transform: scale(1.05); }
    .cat-1 { background-color: #27ae60; }
    .cat-2 { background-color: #f39c12; }
    .cat-3 { background-color: #2980b9; }

    /* ===== Menu Table ===== */
    .menu-section {
        padding: 80px 50px;
        background-color: #fff;
        color: #fff;
    }
    .menu-section h2 {
        text-align: center;
        margin-bottom: 40px;
        color: #27ae60;
        font-size: 2.2em;
    }
    table {
        width: 80%;
        margin: 0 auto 50px auto;
        border-collapse: collapse;
        background-color: #000;  /* black table */
        color: #fff;             /* white text */
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid #444;
    }
    th { background-color: #111; font-weight: 600; }
    tr:hover { background-color: #222; }

    footer {
        text-align: center;
        padding: 30px 20px;
        background-color: #222;
        color: #bbb;
    }
</style>
</head>
<body>

<header>
    <div class="logo">🍽️ EarlyEats</div>
    <nav>
        <a href="#">Home</a>
        <a href="#">Contact</a>
    </nav>
</header>

<section class="hero">
    <h1>Fresh College Meals</h1>
    <p>Pre-book your meals and skip the queue. Healthy and delicious food for campus life!</p>
    <div class="btn-group">
        <a href="login.php" class="btn-primary">Login</a>
        <a href="register.php" class="btn-secondary">Register</a>
    </div>
</section>

<section class="categories">
    <div class="category cat-1">Breakfast</div>
    <div class="category cat-2">Lunch</div>
    <div class="category cat-3">Snacks</div>
</section>
<footer>
    &copy; 2025 EarlyEats. Built for campus life.
</footer>

</body>
</html>
