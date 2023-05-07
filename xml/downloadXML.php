<?php
// Save the file locally on the pc
// Set headers for file download
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="data_report.xml"');
// Output the XML file contents
readfile('xml/data_report.xml');
?>