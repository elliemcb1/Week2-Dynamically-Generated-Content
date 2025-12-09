<?php
$page_title = "Form";
include "./includes/header.php";

// Include your DB connection
include "./includes/db_connect.php";

$success = false;
$submitted_data = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect & sanitize form data
    $submitted_data = [
        "first_name" => htmlspecialchars($_POST['first_name']),
        "last_name"  => htmlspecialchars($_POST['last_name']),
        "email"      => htmlspecialchars($_POST['email']),
        "phone"      => htmlspecialchars($_POST['phone']),
        "address"    => htmlspecialchars($_POST['address']),
        "city"       => htmlspecialchars($_POST['city']),
        "county"     => htmlspecialchars($_POST['county']),
        "postcode"   => htmlspecialchars($_POST['postcode']),
        "notes"      => htmlspecialchars($_POST['notes'])
    ];

    // Prepare INSERT statement (now includes notes)
    $stmt = $conn->prepare("
        INSERT INTO customers 
        (first_name, last_name, email, phone, address, city, county, postcode, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssss",
        $submitted_data["first_name"],
        $submitted_data["last_name"],
        $submitted_data["email"],
        $submitted_data["phone"],
        $submitted_data["address"],
        $submitted_data["city"],
        $submitted_data["county"],
        $submitted_data["postcode"],
        $submitted_data["notes"]
    );

    if ($stmt->execute()) {
        $success = true; // Tell the page to show success message
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Details Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main>

    <?php if ($success): ?>
        <section class="success-box" style="background:#e0ffe0; padding:15px; border:1px solid #6c6;">
            <h2>Customer Added Successfully!</h2>

            <p><strong>First Name:</strong> <?= $submitted_data["first_name"] ?></p>
            <p><strong>Last Name:</strong> <?= $submitted_data["last_name"] ?></p>
            <p><strong>Email:</strong> <?= $submitted_data["email"] ?></p>
            <p><strong>Phone:</strong> <?= $submitted_data["phone"] ?></p>
            <p><strong>Address:</strong> <?= $submitted_data["address"] ?></p>
            <p><strong>City:</strong> <?= $submitted_data["city"] ?></p>
            <p><strong>County:</strong> <?= $submitted_data["county"] ?></p>
            <p><strong>Postcode:</strong> <?= $submitted_data["postcode"] ?></p>
            <p><strong>Notes:</strong> <?= nl2br($submitted_data["notes"]) ?></p>
        </section>
        <hr>
    <?php endif; ?>

    <section class="customer-form">
        <h2>Customer Details</h2>

        <form action="" method="post">
            <fieldset>
                <legend>Personal Information</legend>

                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Telephone</label>
                <input type="text" id="phone" name="phone">
            </fieldset>

            <fieldset>
                <legend>Address Details</legend>

                <label for="address">Address</label>
                <input type="text" id="address" name="address">

                <label for="city">City / Town</label>
                <input type="text" id="city" name="city">

                <label for="county">County</label>
                <input type="text" id="county" name="county">

                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode">

                <!-- New Notes field -->
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="4" style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;"></textarea>
            </fieldset>

            <button type="submit">Submit</button>
            <button type="reset">Clear</button>
        </form>
    </section>
</main>

</body>
</html>

<?php include "./includes/footer.php"; ?>
