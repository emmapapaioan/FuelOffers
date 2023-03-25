<!-- Execute sql query to get the last 3 announcements -->
<?php
    $sql = 'SELECT * FROM announcement ORDER BY entry_date DESC LIMIT 3';
    $result = mysqli_query($conn, $sql);
    $announcement = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>