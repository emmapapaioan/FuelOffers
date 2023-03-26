<?php
include './shared/header.php';
include './shared/index_fill.php';
include './shared/get_3announcements.php';
?>

<script src="./js/functions.js"></script>

<!-- Daily prices summary -->
<section id="prices">
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

</section>

<section id="announcements-list">
    <h1>Τελευταίες Ανακοινώσεις</h1>
    <!--List of last announcements-->
    <ul id="last-announcements-list">
        <?php foreach ($announcement as $item) : ?>
            <li>
                <!-- Format the date to be displayed in format dd/mm/yyyy -->
                <h3><?php echo date('d/m/Y', strtotime($item['entry_date'])); ?></h3>
            </li>
            <a href="<?php echo $item['source'] ?>" target="_blank" style="color: black;">
                <img src="<?php echo $item['img_path'] ?>" id="img-announcements1" title="<?php echo $item['title'] ?>" alt="Image not found">
                <h2 id="announcements-list1"><?php echo $item['title'] ?></h2>
            </a>

            <div id="announcement-text-source">
                <div id="announcement-index-div">
                    <?php echo $item['text'] ?>
                </div>

                <div id="anouncement-source">
                    <a href="<?php echo $item['source'] ?>" target="_blank">
                        Πηγή ανακοίνωσης</a>
                </div>
            </div>
        <?php endforeach; ?>
    </ul>
</section>

<?php include 'shared/footer.php'; ?>