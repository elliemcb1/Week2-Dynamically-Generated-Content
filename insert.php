<?php
// Include database connection
include "./includes/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect and sanitize input
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name  = htmlspecialchars(trim($_POST['last_name']));
    $email      = htmlspecialchars(trim($_POST['email']));
    $phone      = htmlspecialchars(trim($_POST['phone']));
    $address    = htmlspecialchars(trim($_POST['address']));
    $city       = htmlspecialchars(trim($_POST['city']));
    $county     = htmlspecialchars(trim($_POST['county']));
    $postcode   = htmlspecialchars(trim($_POST['postcode']));
    $notes      = htmlspecialchars(trim($_POST['notes']));

    // Insert statement
    $stmt = $conn->prepare("
        INSERT INTO customers 
            (first_name, last_name, email, phone, address, city, county, postcode, notes)
        VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssss",
        $first_name,
        $last_name,
        $email,
        $phone,
        $address,
        $city,
        $county,
        $postcode,
        $notes
    );

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Customer added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
