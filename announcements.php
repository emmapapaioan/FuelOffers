<?php
include './shared/header.php';
include './shared/get_announcements.php';
?>

<script type="text/javascript" src="./js/functions.js"></script>

<div id="user-container">
    <h1 id="announcements-id">Ανακοινώσεις</h1>

    <!-- A button for inputting a new announcement, only when the admin has logged in-->
    <?php if (isset($_SESSION['username'])) : ?>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <button id="new-announcement" onclick="popupWindow()" target="_blank">Νέα Ανακοίνωση</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- The popup form -->
<div id="popup" class="popup">
    <div class="content">
        <!-- A button for closing the popup form-->
        <button id="close-btn">x</button>
        <h2>Νέα ανακοίνωση</h2>
        <form id="announcement-form" method="POST" action="new_announcement.php" onsubmit="return checkNewAnnouncementData()">
            <label for="title">Τίτλος:</label>
            <input type="text" id="title" name="title">

            <label for="date">Ημερομηνία:</label>
            <input type="date" id="date" name="date">

            <label for="img">Image path:</label>
            <input type="text" id="img" name="img">

            <label for="content">Περιεχόμενο:</label>
            <textarea id="content" name="content"></textarea>

            <label for="source">Πηγή ανακοίνωσης:</label>
            <textarea id="source" name="source"></textarea>

            <div id="div-btn">
                <button type="submit" name="submit" id="submit-btn">Υποβολή</button>
            </div>
        </form>
    </div>
</div>

<section id="announcements-section">
    <!--List of last announcements-->
    <ul id="last-announcements-list">
        <?php foreach ($announcement as $item) : ?>
            <form class="announcement" onsubmit="return deleteConfirmationWindow()" action="delete_announcement.php" method="POST">
                <li>
                    <!-- Format the date to be displayed in format dd/mm/yyyy -->
                    <h3><?php echo date('d/m/Y', strtotime($item['entry_date'])); ?></h3>
                </li>
                <!-- A button for deleting a specicic announcement-->
                <?php if (isset($_SESSION['username'])) : ?>
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                        <button id="new-announcement" type="submit" name="submit">Διαγραφή</button>
                    <?php endif; ?>
                <?php endif; ?>
            </form>
            
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