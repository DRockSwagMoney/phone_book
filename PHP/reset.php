<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "TRUNCATE TABLE second_phonebook";
    $phonenumbersql = "TRUNCATE TABLE phone_numbers";
    $emailsql = "TRUNCATE TABLE emails";

    if($conn->query($sql) === TRUE && $conn->query($phonenumbersql) === TRUE && $conn->query($emailsql) === TRUE){
        echo "Tables reset";
    }else {
            echo "Error: " . $conn->error;
    }

?>