<?php
include 'shared/database.php';

$prefecture = filter_input(INPUT_POST, 'prefecture', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fuel = filter_input(INPUT_POST, 'fuel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (isset($prefecture) && isset($fuel)) {
    // Retrieve from db all offers for the selected prefecture and fuel type
    $sql = "SELECT offer.date, offer.price, user.name, user.address
    FROM offer 
    JOIN fuel ON offer.fuel_id = fuel.id 
    JOIN user ON offer.user_id = user.id
    WHERE fuel.type = '$fuel' AND user.prefecture = '$prefecture' AND offer.date >= CURDATE()
    ORDER BY offer.price ASC";

    $results = mysqli_query($conn, $sql);
}
?>