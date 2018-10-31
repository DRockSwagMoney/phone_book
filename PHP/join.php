<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT second_phonebook.firstname, second_phonebook.lastname, phone_numbers.Number1, emails.email1
            FROM second_phonebook, phone_numbers
            LEFT JOIN phone_numbers
            ON second_phonebook.id = phone_numbers.phonenumberID";
    if($conn->query($sql)) {
        echo "Joined Successfully";
    } else {
        echo "Error: " . $sql . $conn->error;
    }
?>