<!-- Execute sql query to get all announcements -->
<?php
    $sql = 'SELECT * FROM announcement ORDER BY entry_date DESC';
    $result = mysqli_query($conn, $sql);
    $announcement = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>