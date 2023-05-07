<?php
session_start();

// Connect to the database
include './shared/database.php';

// Get the logged-in user's ID from the session
$currentUsername = $_SESSION['username'];

// Fetch data from the database and order results by expiring date descending
$query = "SELECT u.name, u.vat, u.address, u.prefecture, u.municipality, o.fuel_id, o.date, o.price, f.type
          FROM user u
          JOIN offer o ON u.id = o.user_id
          JOIN fuel f ON o.fuel_id = f.id
          WHERE u.username = '$currentUsername'
          ORDER BY o.date DESC , o.fuel_id";

$result = mysqli_query($conn, $query);

// Create the SimpleXML object
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no"?><!DOCTYPE data_report SYSTEM "xml/data_report.dtd"><data_report></data_report>');

// Add user_data element and its childs elements
$user_data = $xml->addChild('user_data');
$row = mysqli_fetch_assoc($result);
if ($row) {
    $user_data->addChild('name', htmlspecialchars($row['name']));
    $user_data->addChild('vat', htmlspecialchars($row['vat']));
    $user_data->addChild('address', htmlspecialchars($row['address']));
    $user_data->addChild('prefecture', htmlspecialchars($row['prefecture']));
    $user_data->addChild('municipality', htmlspecialchars($row['municipality']));

    // Add offers element
    $offers = $xml->addChild('offers');
    do {
        $offer = $offers->addChild("offer");
        $offer->addChild('fuel_type', htmlspecialchars($row['type']));
        $offer->addChild('expiring_date', htmlspecialchars($row['date']));
        $offer->addChild('price', htmlspecialchars($row['price']) . '€');
        $active = (strtotime($row['date']) >= strtotime(date('Y-m-d'))) ? 'True' : 'False';
        $offer->addChild('active', $active);
    } while ($row = mysqli_fetch_assoc($result));
}

// Format xml to be easily readable
$doc = new DOMDocument('1.0', 'UTF-8');
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;
$doc->loadXML($xml->asXML());

// Save the XML file on the server, for the xsl styling later to be achieved there
$xml_filename = "xml/data_report.xml";
$doc->save($xml_filename);

// Load your XSL file
$xsl_file = 'xml/data_report.xsl';

// Validate the XML document based on the DTD file
if ($doc->validate()) {
    // Load the XSL file and transform the XML document
    $xsl = new DOMDocument();
    $xsl->load($xsl_file);
    $proc = new XSLTProcessor();
    $proc->importStylesheet($xsl);

    // Output the transformed XML document
    echo $proc->transformToXML($doc);
} else {
    // If the XML document is not valid, show an alert and redirect the user back
    echo "<script>
     alert('Generated XML file cannot be validated by the given DTD file. Please communicate with the administrator.');
     //window.location.href = '/offer_registration.php';
   </script>";
}
