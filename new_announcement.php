<?php
include './shared/database.php';

$title = $date = $img = $content = $source = '';

// Form submit
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img = $_POST['img'];
    $content = $_POST['content'];
    $source = $_POST['source'];

    // Search query to check if a announcement is already stored in the db
    $sqlSearchAnnouncement = "SELECT * FROM announcement WHERE title='$title'";
    $countAnnouncements = mysqli_num_rows(mysqli_query($conn, $sqlSearchAnnouncement));

    if ($countAnnouncements !== 0) {
        echo "<script>alert('Υπάρχει καταχωρημένη ανακοίνωση με το ίδιο όνομα.');</script>";
        // Redirect to the same page    
        header("Location: announcements.php");
    } else {
        // Add values to the database
        $sqlInsert = "INSERT INTO announcement (entry_date, img_path, text, title, source) VALUES
                ('$date','$img','$content','$title', '$source')";

        if (mysqli_query($conn, $sqlInsert)) {
            // Success message
            echo "<script>alert('Η αποθήκευση της ανακοίνωσης ήταν επιτυχής.');</script>";
            // Redirect to the same page    
            echo "<script>setTimeout(function(){window.location.href='announcements.php';}, 1000);</script>";
        } else {
            // Error message
            echo "<script>alert('Αποτυχία αποθήκευσης της ανακοίνωσης. Σφάλμα: ' . mysqli_error($conn));</script>";
            // Redirect to the same page    
            echo "<script>setTimeout(function(){window.location.href='announcements.php';}, 1000);</script>";
        }
    }
}
