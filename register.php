<?php
include 'shared/header.php';
include 'shared/municipalities.php';
include 'shared/prefectures.php';
include 'shared/fuels.php';
?>
<script src="js/functions.js"></script>

<h1 id="register-business">Εγγραφή Επιχείρησης</h1>

<div id="div-register">
    <form name="register-form" id="register-company" action="register_validation.php" onsubmit="return checkData()" method="POST">
        <label for="company-name">Επωνυμία Επιχείρησης:</label>
        <input type="text" name="name" id="company-name" placeholder="Εισάγετε την επωνυμία της επιχείρησης" required>

        <label for="vat">ΑΦΜ:</label>
        <input type="number" name="vat" id="vat" placeholder="Εισάγετε το ΑΦΜ της επιχείρησης" required>

        <label for="address">Διεύθυνση:</label>
        <input type="text" name="address" placeholder="Εισάγετε τη διεύθυνση της επιχείρησης" required>

        <label for="select-prefecture">Νομός:</label>
        <select name="prefecture" id="select-prefecture" required>
            <option hidden>Επιλέξτε νομό</option>
            <?php foreach ($prefecture as $item) { ?>
                <option>
                    <?php echo $item['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="select-municipality">Δήμος:</label>
        <select name="municipality" id="select-municipality" required>
            <option hidden>Επιλέξτε δήμο</option>
            <?php foreach ($municipality as $item) { ?>
                <option>
                    <?php echo $item['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="select-fuel-type">Είδος καυσίμου:</label>
        <select name="fuel" id="select-fuel-type" required>
            <option hidden>Επιλέξτε είδος καυσίμου</option>
            <?php foreach ($fuel as $item) { ?>
                <option>
                    <?php echo $item['type']; ?>
                </option>
            <?php } ?>
        </select>


        <label for="email">Email:</label>
        <input type="text" name="email" id="email" placeholder="Εισάγετε email" required>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Εισάγετε όνομα χρήστη" required>

        <label for="code">Κωδικός:</label>
        <input type="password" name="password" id="password" placeholder="Εισάγετε κωδικό χρήστη" required>

        <label for="confirm-code">Επιβεβαίωση κωδικού:</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Εισάγετε ξανά τον κωδικό χρήστη" required>

        <input type="submit" name="submit" value="Εγγραφή"  id="register-company-button">

        <!-- <button type="submit" id="register-company-button">Εγγραφή</button> -->

        <q>*Όλα τα πεδία της φόρμας είναι υποχρεωτικά.</q>
    </form>
</div>

<?php include 'shared/footer.php'; ?>