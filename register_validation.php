<?php
include 'shared/database.php';

$name = $vat = $address = $prefectureName = $municipality = $fuel = $username = $password = '';

// Form submit
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $vat = filter_input(INPUT_POST, 'vat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = $_POST['address'];
    $prefecture = $_POST['prefecture'];
    $municipality = $_POST['municipality'];
    $fuel = filter_input(INPUT_POST, 'fuel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // Search query to check if the vat is already stored in the db
    $sqlSearchVat = "SELECT * FROM user WHERE vat='$vat'";
    $countVat = mysqli_num_rows(mysqli_query($conn, $sqlSearchVat));

    // Search query to check if the username already exists
    $sqlSearchUsername = "SELECT * FROM user WHERE username='$username'";
    $countUsername = mysqli_num_rows(mysqli_query($conn, $sqlSearchUsername));

    if ($countVat !== 0) {
        echo "<script>alert('Το ΑΦΜ είναι ήδη καταχωρημένο. Επικοινωνήστε με το διαχειριστή για περισσότερες πληροφορίες. empap@outlook.com');</script>";
        // Redirect to the same page    
        echo "<script>setTimeout(function(){window.location.href='register.php';}, 1000);</script>";
        exit();
    }

    if ($countUsername !== 0) {
        echo "<script>alert('Το username υπάρχει ήδη. Δοκιμάστε ξανά.');</script>";
        // Redirect to the same page 
        echo "<script>setTimeout(function(){window.location.href='register.php';}, 1000);</script>";
        exit();
    }

    // Add values to the database
    $sqlInsert = "INSERT INTO user (name, vat, address, prefecture, municipality, email, role, username, password) VALUES
                ('$name','$vat','$address','$prefecture','$municipality','$email','user','$username','$password')";

    if (mysqli_query($conn, $sqlInsert)) {
        // Success message
        echo "<script>alert('Η εγγραφή της επιχείρησης ήταν επιτυχής. Τώρα μπορείτε να συνδεθείτε.');</script>";
        // Redirect to login page after a little
        echo "<script>setTimeout(function(){window.location.href='login.php';},500);</script>";
    } else {
        // Error message
        echo "<script>alert('Αποτυχία εγγραφής επιχείρησης. Σφάλμα: ' . mysqli_error($conn));</script>";
        // Redirect to the same page after a little
        echo "<script>setTimeout(function(){window.location.href='register.php';},3000);</script>";
    }
}
