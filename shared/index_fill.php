<?php
include 'shared/fuels.php';

// Create an array of fuel types with the id and type values from the database
$fuelTypes = array();
foreach ($fuel as $typeData) {
    $fuelTypes[] = array('type' => $typeData['type'], 'id' => $typeData['id']);
}

// Fuel prices array
$fuelPrices = array();
// Get the current date and time
$currentDate = date('Y-m-d H:i:s');

// Get MAX, MIN, and AVG prices for each fuel type and store them in the fuel prices array
foreach ($fuelTypes as $type) {
    $fuelId = $type['id'];
    $sql = "SELECT MAX(price), MIN(price), AVG(price) FROM offer WHERE fuel_id = $fuelId AND date >= '$currentDate'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if the values are null, and use a default value of 0 if they are
    $maxPrice = isset($row['MAX(price)']) ? $row['MAX(price)'] : 0;
    $minPrice = isset($row['MIN(price)']) ? $row['MIN(price)'] : 0;
    $avgPrice = isset($row['AVG(price)']) ? $row['AVG(price)'] : 0;

    $fuelPrices[] = array(
        'type' => $type['type'],
        // Round prices to 2 decimal parts
        'max' => round($maxPrice, 2),
        'min' => round($minPrice, 2),
        'avg' => round($avgPrice, 2)
    );
}
