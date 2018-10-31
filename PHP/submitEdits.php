<?php 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["editid"];
        $firstname = $_POST["editfname"];
        $lastname = $_POST["editlname"];
        $phonenumber = $_POST["editphonenumber"];
        $email = $_POST["editemail"];

        $sql = "UPDATE second_phonebook 
                    SET firstname='$firstname', lastname='$lastname'
                    WHERE id = '$id'";
                    
        $phonenumbersql = "UPDATE phone_numbers
                                SET number = '$phonenumber'
                                WHERE phonenumberid = $id";
        $emailsql = "UPDATE emails 
                        SET email = '$email'
                        WHERE emailid = $id";
        if($conn->query($sql) === TRUE && $conn->query($phonenumbersql) === TRUE && $conn->query($emailsql) === TRUE){
            echo "Update Successful";
        } else {
            echo "Error: " . $sql . "<br/>" . $phonenumbersql . "<br/>" . $emailsql . "<br/>" . $conn->error; 
        }
    
    }

?>