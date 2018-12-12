<?php
/**
 * Created by PhpStorm.
 * User: dambers
 * Date: 12/12/2018
 * Time: 9:10 AM
 */
//connect to database
include 'connect.php';
$output = '';
$sql = 'SELECT COUNT(*) FROM second_phonebook';
$output = ($sql);
if ($conn->query($sql) === TRUE) {
    echo "Number of records = ".$output;
} else {
    echo 'Error: ' . $sql . $conn->error_;
}
