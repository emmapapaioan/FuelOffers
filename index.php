<?php
include './shared/header.php';
include './shared/index_fill.php';
include './shared/get_3announcements.php';
?>

<script src="./js/functions.js"></script>

<!-- Daily prices summary -->
<section id="prices">
    <?php include "./shared/daily_prices.php"; ?>
</section>

<section id="announcements-section">
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