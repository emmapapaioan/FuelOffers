<?php
// Define database connection constants
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost:4306');
}
if (!defined('DB_USER')) {
    define('DB_USER', 'emma');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', '123456');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'papaioannou');
}

// Create a new mysqli object
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $message = "Connection with the database failed.";
    echo "<script>console.log('$message');</script>";
}else{
    // $message = "Successfull connection with the database.";
    // echo "<script>console.log('$message');</script>";
}