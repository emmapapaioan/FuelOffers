<?php include 'shared/header.php';?>

    <form id="login-form" action="login_validation.php" method="POST">
        <div id="form-item"><h1 id="user-login">Είσοδος χρήστη</h1></div>
        <label for="username">Όνομα χρήστη</label>
        <div id="form-item"><input type="text" name="username" id="company-name" placeholder="Εισάγετε όνομα χρήστη" required></div></div>

        <label for="password">Κωδικός</label>
        <div id="form-item"><input type="password" name="password" id="password" placeholder="Εισάγετε κωδικό" required></div>

        <div id="form-item"><input type="submit" id="user-login-button" name="submit" value="Είσοδος" class="button"></div>
        
        <!-- A paragraph cited and undrelined that links to create new business-->
        <div id="form-item"><a id="new-register" href="register.php">Εγγραφή νέας επιχείρησης</a></div>

    </form>

    <?php include 'shared/footer.php'; ?>