<!-- Execute sql query to get all fuel types -->
<?php
    $sql = 'SELECT * FROM fuel';
    $result = mysqli_query($conn, $sql);
    $fuel = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>