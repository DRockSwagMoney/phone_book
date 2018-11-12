<?php 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("INSERT INTO second_phonebook (firstname, lastname)
                            VALUES (?, ?)");
    $stmt->bind_param("ss", $firstname, $lastname);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phonenumber =  $_POST["phonenumber"];
        $email = $_POST["email"];

        $stmt->execute();
        /*$sql = "INSERT INTO second_phonebook (firstname, lastname)
                            VALUES ('$firstname', '$lastname')";*/
        
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
            var_dump($phonenumber);
        } else {
            echo "Error: " . $sql . $conn->error; 
        }

?>