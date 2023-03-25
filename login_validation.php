<?php
// Start the session function, to store data of user, in the server temporarily
session_start();
include 'shared/database.php';

$username = $password = '';

// Submit login data
if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

echo '<script language="javascript">console.log($username+"  "+$password); 
document.location="login.php";</script>';
// Search for the user in db by the username
$sql = "SELECT * FROM user WHERE username='$username'";
$currentUser = mysqli_query($conn, $sql);
$count = mysqli_num_rows($currentUser);

// If user exists in the db
if ($count !== 0) {
    $userData = mysqli_fetch_assoc($currentUser);
    $id  = $userData['id'];
    $name = $userData['name'];
    $vat = $userData['vat'];
    $address = $userData['address'];
    $municipality = $userData['municipality'];
    $prefecture = $userData['prefecture'];
    $email = $userData['email'];
    $role = $userData['role'];
    $username = $userData['username'];
    $currentPassword = $userData['password'];

    // Check for the password
    if ($password !== $currentPassword) {
        echo '<script language="javascript">alert("Λανθασμένος κωδικός.");</script>';
        exit();
    } else {
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['vat'] = $vat;
        $_SESSION['address'] = $address;
        $_SESSION['municipality'] = $municipality;
        $_SESSION['prefecture'] = $prefecture;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['username'] = $username;

        header("Location: index.php");
    }
} else {
    // Case of non existing user
    echo "<script>alert('O χρήστης δεν υπάρχει.');</script>";
    // Redirect to index page after a little
    echo "<script>setTimeout(function(){window.location.href='login.php';},200);</script>";
}
