<?php
// Start session only if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Optional: Hide non-critical warnings
error_reporting(E_ERROR | E_PARSE);

// Check if user is logged in
if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

// Role-based access control
$currentFile = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'];

if ($currentFile === 'admin.php' && $role !== 'admin') {
    header("Location: student.php");
    exit;
}

if ($currentFile === 'staff.php' && $role !== 'staff') {
    header("Location: student.php");
    exit;
}
?>

