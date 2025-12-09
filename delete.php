<?php
include "./includes/db_connect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: view_customers.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    echo "No ID supplied.";
}
?>
