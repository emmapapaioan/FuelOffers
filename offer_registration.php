<?php 
    include 'shared/header.php'; 
    include 'shared/fuels.php';
?>

<script src="js/functions.js"></script>

<h1 id="register-offer">Καταχώρηση Προσφοράς</h1>

<div id="div-offer-registration">
    <form id="form-offer-registration" name="form-offer-registration" action="offer_registration_validation.php" 
          method="POST" onsubmit="return checkDataOffer()">

        <label for="name">Επωνυμία Επιχείρησης:</label>
        <!-- The company name is retrieved from the database and cannot be changed -->
        <input type="text" name="name" id="company-name" value="<?php echo $_SESSION['name']; ?>" readonly>

        <label for="company-vat">ΑΦΜ:</label>
        <!-- Vat is retrieved from the database and cannot be changed -->
        <input type="number" name="vat" id="company-vat" minlength="9" maxlength="9" name="company-name" value="<?php echo $_SESSION['vat']; ?>" readonly>

        <label for="company-address">Διεύθυνση:</label>
        <!-- Address is retrieved from the database and cannot be changed -->
        <input type="text" name="address" id="company-address" value="<?php echo $_SESSION['address']; ?>" readonly>

        <label for="prefecture">Νομός:</label>
        <!-- Prefecture is retrieved from the database and cannot be changed -->
        <input type="text" name="prefecture" id="prefecture-input" value="<?php echo $_SESSION['prefecture']; ?>" readonly>

        <label for="municipality">Δήμος:</label>
        <!-- Municipality is retrieved from the database and cannot be changed -->
        <input type="text" name="municipality" id="municipality-input" value="<?php echo $_SESSION['municipality']; ?>" readonly>

        <label for="select-fuel-type">Είδος καυσίμου:</label>
        <select name="fuel" id="select-fuel-type" >
            <option hidden>Επιλέξτε είδος καυσίμου</option>
            <?php foreach ($fuel as $item) { ?>
                <option>
                    <?php echo $item['type']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="fuel-price">Τιμή:</label>
        <input type="text" name="price" id="fuel-price" placeholder="Εισάγετε τιμή">
        <!-- <input type="number" min="0" step=.01 name="price" id="fuel-price" placeholder="Εισάγετε τιμή"> -->

        <label for="date">Ημερομηνία λήξης προσφοράς:</label>
        <input type="date" name="date" id="expiration-date" placeholder="Εισάγετε ημερομηνία λήξης προσφοράς">

        <q>*Όλα τα πεδία της φόρμας είναι υποχρεωτικά.</q>

        <input type="submit" name="submit" id="submit-button" value="Καταχώρηση">

    </form>

</div>

<?php include 'shared/footer.php'; ?>