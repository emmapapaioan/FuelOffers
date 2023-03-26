<?php
include './shared/header.php';
include './shared/prefectures.php';
include './shared/fuels.php';
?>

<fieldset id="search-container">
    <h1 id="filters-title">Φίλτρα</h1>

    <form id="filters" method="GET">
        <label>Νομός:</label>
        <select name="prefecture" id="prefecture">
            <option hidden id="hidden1">Επιλέξτε νομό</option>
            <?php foreach ($prefecture as $item) { ?>
                <option value="<?php echo $item['name']; ?>" <?php if (isset($_GET['prefecture']) && $_GET['prefecture'] == $item['name']) {
                                                                    echo 'selected';
                                                                } ?>>
                    <?php echo $item['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Είδος καυσίμου:</label>
        <select name="fuel" id="fuel">
            <option hidden id="hidden2">Επιλέξτε τύπο καυσίμου</option>
            <?php foreach ($fuel as $item) { ?>
                <option value="<?php echo $item['type']; ?>" <?php if (isset($_GET['fuel']) && $_GET['fuel'] == $item['type']) {
                                                                    echo 'selected';
                                                                } ?>>
                    <?php echo $item['type']; ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" id="search-button" value="Αναζήτηση">
    </form>

    <h1 id="results-title"><strong>Αποτελέσματα</strong></h1>
    <section id="results">
        <!-- Table of results is displayed only when the user put filters -->
        <?php
        if (isset($_GET['prefecture']) && isset($_GET['fuel'])) { ?>
            <table cellspacing="0" border="1.2" id="results-table">
                <thead id="results-table-header">
                    <tr>
                        <th>α/α</th>
                        <th>Επωνυμία</th>
                        <th>Διεύθυνση</th>
                        <th>Τύπος Καυσίμου</th>
                        <th>Τιμή</th>
                    </tr>
                </thead>
                <tbody id="results-body">
                <?php } ?>
                <?php
                if (isset($_GET['prefecture']) && isset($_GET['fuel'])) {
                    $prefecture = $_GET['prefecture'];
                    $fuel = $_GET['fuel'];

                    // Retrieve from db all offers for the selected prefecture and fuel type
                    $sql = "SELECT offer.date, offer.price, user.name, user.address
                            FROM offer 
                            JOIN fuel ON offer.fuel_id = fuel.id
                            JOIN user ON offer.user_id = user.id
                            WHERE fuel.type = '$fuel' AND user.prefecture = '$prefecture' AND offer.date >= CURDATE()
                            ORDER BY offer.price ASC";

                    $results = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_all($results, MYSQLI_ASSOC);

                    if ($results && mysqli_num_rows($results) > 0) {
                        // Calculate the average price for the selected fuel type on the current date
                        $sql = "SELECT AVG(price) AS avg_price 
                                FROM offer 
                                WHERE fuel_id = (SELECT id FROM fuel WHERE type = '$fuel') 
                                AND date >= CURDATE()";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $avgPrice = $row['avg_price'];

                        // Sort the rows based on the absolute value of the price difference from the average price
                        usort($rows, function ($a, $b) use ($avgPrice) {
                            $diffA = abs($a['price'] - $avgPrice);
                            $diffB = abs($b['price'] - $avgPrice);
                            return $diffA - $diffB;
                        });

                        // Find the minimum absolute price difference
                        $minDiff = abs($rows[0]['price'] - $avgPrice);

                        // Display the table of results
                        $counter = 1;
                        foreach ($rows as $row) {
                            $class = '';
                            $diff = abs($row['price'] - $avgPrice);
                            if ($diff == $minDiff) {
                                $class = 'green-row';
                            }
                            echo "<tr class='" . $class . "'>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td><a 
                                class='address' 
                                href='https://www.google.com/maps/search/?api=1&query="
                                . urlencode($row['address'])
                                . "' target='_blank'>"
                                . $row['address'] . "
                                </a></td>";
                            echo "<td>" . $fuel . "</td>";
                            echo "<td>" . $row['price'] . "€</td>";
                            echo "</tr>";
                            $counter++;
                        }
                    } else {
                        echo '<h1 id="results-title"><strong>Δεν υπάρχουν διαθέσιμα αποτελέσματα.</strong></h1>';
                    }
                } else {
                    echo '<h1 id="results-title"><strong>Εισάγετε κριτήρια αναζήτησης</strong></h1>';
                }
                ?>
                </tbody>
            </table>
    </section>
</fieldset>

<?php include 'shared/footer.php'; ?>