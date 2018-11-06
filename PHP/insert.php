<?php 
    ini_set('error_log', 'errors.log'); // Logging file 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phonenumber =  $_POST["phonenumber"];
        $email = $_POST["email"];

        $sql = "INSERT INTO second_phonebook (firstname, lastname)
                            VALUES ('$firstname', '$lastname')";
        
        if($conn->query($sql) === TRUE){
            $last_id = $conn->insert_id;
            foreach($phonenumber as $numvalue) {
                $phonenumbersql = "INSERT INTO phone_numbers (userid, number)
                            VALUES ('$last_id', '$numvalue')";
                $conn->query($phonenumbersql);
            }
            foreach($email as $emailvalue) {
            $emailsql = "INSERT INTO emails (userid, email)
                            VALUES ('$last_id', '$emailvalue')";
             $conn->query($emailsql);
            }
            echo "Insert Successful";
        } else {
            echo "Error: " . $sql . $conn->error; 
        }

    
    }

?>