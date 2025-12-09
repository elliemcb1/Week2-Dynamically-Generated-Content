<?php
include "./includes/db_connect.php";

if (!isset($_GET['id'])) {
    die("No ID supplied.");
}

$id = (int) $_GET['id'];
$success = false;

// Load existing data
$stmt = $conn->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    die("Customer not found.");
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name  = htmlspecialchars($_POST['last_name']);
    $email      = htmlspecialchars($_POST['email']);
    $phone      = htmlspecialchars($_POST['phone']);
    $address    = htmlspecialchars($_POST['address']);
    $city       = htmlspecialchars($_POST['city']);
    $county     = htmlspecialchars($_POST['county']);
    $postcode   = htmlspecialchars($_POST['postcode']);

    $update = $conn->prepare("UPDATE customers 
        SET first_name=?, last_name=?, email=?, phone=?, address=?, city=?, county=?, postcode=? 
        WHERE id=?");
    $update->bind_param(
        "ssssssssi",
        $first_name, $last_name, $email, $phone,
        $address, $city, $county, $postcode, $id
    );

    if ($update->execute()) {
        $success = true;
        // Reload updated data
        $customer = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'phone'      => $phone,
            'address'    => $address,
            'city'       => $city,
            'county'     => $county,
            'postcode'   => $postcode
        ];
    } else {
        echo "Error updating record: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
</head>
<body>
<h2>Edit Customer #<?= $id; ?></h2>

<?php if ($success): ?>
    <p style="color:green;">Customer updated successfully!</p>
<?php endif; ?>

<form method="post">
    <label>First Name</label>
    <input type="text" name="first_name" value="<?= $customer['first_name']; ?>" required><br>

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?= $customer['last_name']; ?>" required><br>

    <label>Email</label>
    <input type="email" name="email" value="<?= $customer['email']; ?>" required><br>

    <label>Phone</label>
    <input type="text" name="phone" value="<?= $customer['phone']; ?>"><br>

    <label>Address</label>
    <input type="text" name="address" value="<?= $customer['address']; ?>"><br>

    <label>City</label>
    <input type="text" name="city" value="<?= $customer['city']; ?>"><br>

    <label>County</label>
    <input type="text" name="county" value="<?= $customer['county']; ?>"><br>

    <label>Postcode</label>
    <input type="text" name="postcode" value="<?= $customer['postcode']; ?>"><br>

    <button type="submit">Save Changes</button>
    <a href="view_customers.php">Back to list</a>
</form>
</body>
</html>
