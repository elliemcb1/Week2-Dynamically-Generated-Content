<?php
$host = "localhost";
$user = "root";          // XAMPP default user
$pass = "";              // XAMPP default password (empty)
$db   = "customer_db";   // Make sure this database exists in phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
