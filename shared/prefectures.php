<!-- Execute sql query to get all prefectures -->
<?php
    $sql = 'SELECT * FROM prefecture';
    $result = mysqli_query($conn, $sql);
    $prefecture = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>