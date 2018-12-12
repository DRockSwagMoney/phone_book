<?php
/**
 * Created by PhpStorm.
 * User: dambers
 * Date: 12/12/2018
 * Time: 9:10 AM
 */
//connect to database
include 'connect.php';

$sql = "SELECT * FROM second_phonebook";
$result = $conn->query($sql);
$output = $result->num_rows;
echo "Number of contacts: <strong>$output</strong> \n";
echo $conn->error;

