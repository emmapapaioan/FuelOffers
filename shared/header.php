<?php
//Connect to the database 
include 'shared/database.php';
// Start the session function, to store data of user, in the server temporarily
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαχείριση Προσφορών Πώλησης Υγρών Καυσίμων - Ανακοινώσεις</title>
</head>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

<body>
    <!--Header-->
    <header>
        <nav>
            <ul>
                <!-- Link type <a> that leads to the home page. If picture is not found, the text "Αρχική Σελίδα" will be shown to user. -->
                <li><a href="index.php"> <img id="logo-image-td" class="logo-image" src="images/logo5.3.png" alt="Αρχική σελίδα"></a></li>

                <!--Home page link-->
                <li><a href="index.php">
                        <b id="index">Αρχική</b></a></li>

                <!--Search link-->
                <li><a href="search.php">
                        <b id="search">Αναζήτηση</b></a></li>

                <!--Display register offers link, only when user is logged in-->
                <?php if (isset($_SESSION['username'])) : ?>
                <!-- Output the link register-->
                <li><a href="offer_registration.php"><b id="register">Καταχώρηση</b></a></li>
                <?php endif; ?>

                <!--Announcements link-->
                <li><a href="announcements.php">
                        <b id="announcements">Ανακοινώσεις</b></a></li>

                <!--Login and Logout Buttons-->
                <?php if (isset($_SESSION['username'])) : ?>
                    <li><a href="logout.php"><button class="login-button">
                                <b id="logout">Logout</b></button></a></li>
                <?php else : ?>
                    <li><a href="login.php"><button class="login-button">
                                <b id="login">Login</b></button></a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>

    <!-- If user is logged in, welcome user by username, else welcome the guest -->
    <?php if (isset($_SESSION['username'])) : ?>
        <div id="welcome-user">
            <h3>Καλώς ήρθες, <?php echo $_SESSION['username']; ?>!</h3>
        </div>
    <?php else : ?>
        <div id="welcome-user">
            <h3>Καλώς ήρθες, Guest!</h3>
        </div>
    <?php endif; ?>