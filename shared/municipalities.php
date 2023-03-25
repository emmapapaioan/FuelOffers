<!-- Execute sql query to get all municipalities -->
<?php
$sql = 'SELECT * FROM municipality ORDER BY name';
$result = mysqli_query($conn, $sql);
$municipality = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
