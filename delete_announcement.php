<?php
include 'shared/database.php';
$id = '';

// Form submit
if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    $sqlDelete= "DELETE FROM announcement WHERE id = '$id'";
    $result = mysqli_query($conn, $sqlDelete);
    
    if ($result) {
        // Success message
        echo "<script>alert('Η διαγραφή της ανακοίνωσης ήταν επιτυχής.');</script>";
        // Redirect to the same page after the deletion
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Error message
        echo "<script>alert('Αποτυχία διαγραφής ανακοίνωσης. Σφάλμα: ' . mysqli_error($conn));</script>";
        // Redirect to the same page after the deletion
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}