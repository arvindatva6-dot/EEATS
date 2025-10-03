<?php
include('db.php');

function getMenuItems() {
    global $conn;
    $result = $conn->query("SELECT * FROM menu_items WHERE available = 1");
    return $result->fetch_all(MYSQLI_ASSOC);
}
function getMenuItems() {
    global $conn;
    $result = $conn->query("SELECT * FROM menu_items WHERE available = 1");
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>
