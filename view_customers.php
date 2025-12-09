<?php
$page_title = "Customer List";
include "./includes/header.php";
include "./includes/db_connect.php";

$sql = "SELECT * FROM customers ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main>
    <h2>Customer Records</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>County</th>
                <th>Postcode</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><?= $row['city']; ?></td>
                <td><?= $row['county']; ?></td>
                <td><?= $row['postcode']; ?></td>
                <td><?= nl2br($row['notes']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    <?php else: ?>
        <p>No customer records found.</p>
    <?php endif; ?>

</main>
</body>
</html>

<?php include "./includes/footer.php"; ?>
