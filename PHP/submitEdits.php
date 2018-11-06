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
        $numid = $_POST["editnumberid"];
        $emailid = $_POST["editemailid"];
        $firstname = $_POST["editfname"];
        $lastname = $_POST["editlname"];
        $phonenumber = $_POST["editphonenumber"];
        $email = $_POST["editemail"];

        $sql = "UPDATE second_phonebook 
                    SET firstname='$firstname', lastname='$lastname'
                    WHERE id = '$id'";
        if($conn->query($sql) === TRUE){
            foreach($numid as $numidvalue) {
                foreach($phonenumber as $numvalue) {
                
                $phonenumbersql = "UPDATE phone_numbers
                                    SET number = '$numvalue'
                                    WHERE id = '$numidvalue'";
                $conn->query($phonenumbersql);
                }
            }          
        
            foreach($email as $emailvalue) {
                $emailsql = "UPDATE emails 
                            SET email = '$emailvalue'
                            WHERE id = '$emailid'";
                $conn->query($emailsql);
            }
            echo "Update Successful";
        } else {
            echo "Error: " . $sql . "<br/>" . $phonenumbersql . "<br/>" . $emailsql . "<br/>" . $conn->error; 
        }
    
    }

?>