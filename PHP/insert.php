<?php 
    ini_set('error_log', 'errors.log'); // Logging file 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];

        $sql = "INSERT INTO second_phonebook (firstname, lastname)
                            VALUES ('$firstname', '$lastname')";
        $phonenumbersql = "INSERT INTO phone_numbers (userid, number)
                            VALUES ('$id', '$phonenumber')";
        $emailsql = "INSERT INTO emails (userid, email)
                            VALUES ('$id', '$email')";
        if($conn->query($sql) === TRUE && $conn->query($phonenumbersql) === TRUE && $conn->query($emailsql) === TRUE){
            error_log("Insert Successful");
        } else {
            error_log("Error: " . $sql . $conn->error); 
        }
    
    }

?>