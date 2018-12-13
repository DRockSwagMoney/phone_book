<?php 
    //Create Connection
    include '../PHP/connect.php';

    $names = $conn->prepare("INSERT INTO $tablename (firstname, lastname)
                            VALUES (?, ?)");
    $names->bind_param("ss", $firstname, $lastname);

    $numbers = $conn->prepare("INSERT INTO $tnnumbers (userid, number)
                            VALUES (?, ?)");
    $numbers->bind_param("is", $last_id, $numvalue);

    $emails = $conn->prepare("INSERT INTO $tnemails (userid, email)
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
            $numbers->execute();
        }

        foreach($email as $emailvalue) {
            $emails->execute();
        }
    echo "Insert Successful";
    } else {
        echo "Error: " . $sql . $conn->error; 
    }

?>