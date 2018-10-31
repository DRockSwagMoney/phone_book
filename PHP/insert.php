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
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];

        $sql = "INSERT INTO second_phonebook (firstname, lastname)
                            VALUES ('$firstname', '$lastname')";
        $phonenumbersql = "INSERT INTO phone_numbers (number)
                            VALUES ('$phonenumber')";
        $emailsql = "INSERT INTO emails (email)
                            VALUES ('$email')";
        if($conn->query($sql) === TRUE && $conn->query($phonenumbersql) === TRUE && $conn->query($emailsql) === TRUE){
            error_log("Insert Successful");
        } else {
            error_log("Error: " . $sql . $conn->error); 
        }
    
    }

?>