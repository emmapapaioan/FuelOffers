# Fuel-Offers

https://user-images.githubusercontent.com/108992250/227786804-4388f28f-6f5a-4660-b239-f6549894138f.mp4

Fuel-Offers is a web application built using PHP, HTML, CSS, JavaScript, and MySQL. The project was built as an assignment for the Hellenic Open University. 
It allows users to browse and compare fuel offers from different gas stations and moreover to read announcements uploaded by the admin. 
The offers are uploaded by users at any time, after their registration.

## Prerequisites
To run this application, you will need to have the following software installed on your machine:

<ul>
<li>PHP 7.0 or later </li>
<li> MySQL 5.7 or later</li>
<li>Apache web server</li>
<li>phpMyAdmin (optional, but recommended)</li>
</ul>

## Run the project
To run the Fuel-Offers application, follow these steps:

Clone the repository: <br>
```git clone https://github.com/emmapapaioan/Fuel-Offers.git``` <br>
Create a new database in MySQL using phpMyAdmin or the command line: <br>
```CREATE DATABASE papaioannou;``` <br>
Import the database schema from the papaioannou.sql file into the newly created database: <br> 
```mysql -u [username] -p papaioannou < ./papaioannou.sql``` <br> 
Update the database connection settings in the config.php file with username "emma" and password 123456 or with your MySQL username and password.<br> 
If you choose to use your username etc, you must update the shared/database.php <br> 
Start the Apache web server and navigate to the index.php file in your web browser.

## Usage
Once the application is up and running, users can browse the fuel offers and moreover view announcements uploaded by the admin.
The unregistered users can view fuel offers and the announcements. The registered users can also upload fuel offers.
The application also includes an admin panel where authorized users can add and delete announcements.
