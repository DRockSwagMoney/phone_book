<?php
    //Create Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phone_book"; //Name of database
    $tablename = "contact_names"; //Name of table
    $tnnumbers = "phone_numbers"; //Name of the phone numbers table
    $tnemails = "emails"; //Name of the emails table
    $conn = new mysqli($servername, $username, $password, $dbname);

/*$dbname = "phone_book"; //Name of database
$tablename = "second_phonebook"; //Name of table
$tnnumbers = "phone_numbers"; //Name of the phone numbers table
$tnemails = "emails"; //Name of the emails table*/
?>