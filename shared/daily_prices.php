<h1>Ημερήσια σύνοψη τιμών</h1>

    <!--Current date-->
    <h3>
        <div id="current-date">
            <script>
                getCurrentDate();
            </script>
    </h3>
    
<!--List of prices-->
<ul id="price-list" title="Ημερήσια σύνοψη τιμών">
    <!-- We count the list items so we dont input an hr tag at the last record-->
    <?php $count = 0; ?>
    <?php foreach ($fuelPrices as $item) { ?>
        <li>
            <h2><?php echo $item['type']; ?></h2>
        </li>
        <p>
            <?php
            if ($item['max'] == 0 || $item['min'] == 0 || $item['avg'] == 0) {
                // Case of no data for the current date 
                echo '<div id=no-prices>' . '*Δεν υπάρχουν ενεργές προσφορές για την τρέχουσα ημερομηνία.' . '</div>';
            } else {
                echo 'Μέγιστη:' . $item['max'] . '€' .
                    '/Ελάχιστη:' . $item['min'] . '€' .
                    '/Μέση:' . $item['avg'] . '€';
            }
            ?>
        </p>
        <?php $count++; ?>
        <?php if ($count != count($fuelPrices)) { ?>
            <hr>
        <?php } ?>
    <?php } ?>
    <?php if (empty($fuelPrices)) { ?>
        <li>
            <h2><i>Δεν υπάρχουν διαθέσιμες τιμές</i></h2>
        </li>
    <?php } ?>
</ul>
