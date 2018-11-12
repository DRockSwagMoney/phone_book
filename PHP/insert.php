<?php 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $names = $conn->prepare("INSERT INTO second_phonebook (firstname, lastname)
                            VALUES (?, ?)");
    $names->bind_param("ss", $firstname, $lastname);

    $numbers = $conn->prepare("INSERT INTO phone_numbers (userid, number)
                            VALUES (?, ?)");
    $numbers->bind_param("is", $last_id, $numvalue);

    $emails = $conn->prepare("INSERT INTO emails (userid, email)
                            VALUES (?, ?)");
    $emails->bind_param("is", $last_id, $emailvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phonenumber =  $_POST["phonenumber"];
        $email = $_POST["email"];

        $names->execute();        
            $last_id = $conn->insert_id;
            foreach($phonenumber as $numvalue) {
                $phonenumbersql = "INSERT INTO phone_numbers (userid, number)
                            VALUES ('$last_id', '$numvalue')";
                $numbers->execute();
            }

            foreach($email as $emailvalue) {
                $emailsql = "INSERT INTO emails (userid, email)
                            VALUES ('$last_id', '$emailvalue')";
                $emails->execute();
            }
        echo "Insert Successful";
        } else {
            echo "Error: " . $sql . $conn->error; 
        }

?>