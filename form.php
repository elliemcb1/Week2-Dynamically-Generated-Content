<?php
$page_title = "Form";
include "./includes/header.php";

// --- PROCESS FORM SUBMISSION ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form values safely
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name  = htmlspecialchars($_POST['last_name']);
    $email      = htmlspecialchars($_POST['email']);
    $phone      = htmlspecialchars($_POST['phone']);
    $address    = htmlspecialchars($_POST['address']);
    $city       = htmlspecialchars($_POST['city']);
    $county     = htmlspecialchars($_POST['county']);
    $postcode   = htmlspecialchars($_POST['postcode']);

    // --- Database insert example ---
    /*
    include 'db_connect.php';

    $stmt = $conn->prepare("INSERT INTO customers 
        (first_name, last_name, email, phone, address, city, county, postcode)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssss",
        $first_name, $last_name, $email, $phone,
        $address, $city, $county, $postcode
    );

    if ($stmt->execute()) {
        echo "<p>Customer added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    */
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
            </fieldset>

            <button type="submit">Submit</button>
        </form>
    </section>
</main>

</body>
</html>

<?php include "./includes/footer.php"; ?>
