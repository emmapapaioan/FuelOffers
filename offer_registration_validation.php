<?php
include 'shared/database.php';
session_start();
$name = $vat = $address = $prefecture = $municipality = $fuel = $price = $date = '';

// Form submit
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $vat = filter_input(INPUT_POST, 'vat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = $_POST['address'];
    $prefecture = $_POST['prefecture'];
    $municipality = $_POST['municipality'];
    $fuel = $_POST['fuel'];
    $price = $_POST['price'];
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Retrieve the fuel_id based on the selected fuel type
    $sqlGetFuelId = "SELECT id FROM fuel WHERE type = '$fuel'";
    $result = mysqli_query($conn, $sqlGetFuelId);
    $row = mysqli_fetch_assoc($result);
    $fuel_id = $row['id'];
}

// Check if user has already made the same offer
$sqlFindSame = "SELECT * FROM offer WHERE user_id='" . $_SESSION['id'] . "'
                AND fuel_id='" . $fuel_id . "'";
$count = mysqli_num_rows(mysqli_query($conn, $sqlFindSame));

// Case that the user has already registered for same fuel offer
if ($count !== 0) {
    // Sql query to insert values
    $sqlInsert = "UPDATE offer SET price='" . $price . "', date='" . $date . "'
    WHERE user_id='" . $_SESSION['id'] . "'
    AND fuel_id='" . $fuel_id . "'";
// Case of a new offer insertion
} else {
    // Sql query to insert values
    $sqlInsert = "INSERT INTO offer (date, price, user_id, fuel_id) VALUES
    ('$date', " . (float)$price . ",
    (SELECT id FROM user WHERE name = '$name'),
    (SELECT id FROM fuel WHERE type = '$fuel')) ";
}

if (mysqli_query($conn, $sqlInsert)) {
    // Success message
    echo "<script>alert('Η εγγραφή της προσφοράς ήταν επιτυχής.');</script>";
    // Redirect to the same page after a little
    echo "<script>setTimeout(function(){window.location.href='offer_registration.php';},500);</script>";
} else {
    // Error message
    echo "<script>alert('Αποτυχία καταχώρησης προσφοράς. Σφάλμα: ' . mysqli_error($conn));</script>";
    // Redirect to the same page after a little
    echo "<script>setTimeout(function(){window.location.href='offer_registration.php';},500);</script>";
}
