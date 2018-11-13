<?php 
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $x=0;
    $y=0;
    $z=0;
    $output = '';
    $names = $conn->prepare("UPDATE second_phonebook 
                    SET firstname=?, lastname=?
                    WHERE id =?");
    $names->bind_param("ssi", $firstname, $lastname, $id);
    

    $numbers = $conn->prepare("UPDATE phone_numbers
                                SET number=?
                                WHERE id=?");
    $numbers->bind_param("si", $phonenumber[$y], $numid[$x]);

    $emails = $conn->prepare("UPDATE emails 
                            SET email=?
                            WHERE id=?");
    $emails->bind_param("si", $email, $emailid);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["editid"];
        $firstname = $_POST["editfname"];
        $lastname = $_POST["editlname"];

        $numid = $_POST["editnumberid"];
        $numidlength = count($numid);
        $phonenumber = $_POST["editphonenumber"];
        $phonelength = count($phonenumber);        

        $emailid = $_POST["editemailid"];
        $emailidlength = count($emailid);
        $email = $_POST["editemail"];
        $emaillength = count($email);

        $names->execute();

            for($x = 0; $x < $numidlength; $x++) {
                /*$phonenumbersql = "UPDATE phone_numbers
                                    SET number = '$phonenumber[$y]'
                                    WHERE id = '$numid[$x]'";
                $conn->query($phonenumbersql);*/
                $numbers->execute();
                $y++;
                
            }
            if(isset($_POST["neweditphonenumber"]) === TRUE) {
            $newphonenumber = $_POST["neweditphonenumber"];
                foreach($newphonenumber as $newnumvalue) {
                    $phonenumbersql = "INSERT INTO phone_numbers (userid, number)
                                VALUES ('$id', '$newnumvalue')";
                    $conn->query($phonenumbersql);
                    }
            }
            
 
            foreach($emailid as $emailidvalue) {
                    $emailsql = "UPDATE emails 
                                SET email = '$email[$z]'
                                WHERE id = '$emailidvalue'";
                    $conn->query($emailsql);
                    $z++;
            }
            if(isset($_POST["neweditemail"]) === TRUE) {
            $newemail = $_POST["neweditemail"];
                foreach($newemail as $newemailvalue) {
                    $emailsql = "INSERT INTO emails (userid, email)
                                VALUES ('$id', '$newemailvalue')";
                    $conn->query($emailsql);
                }
            }
    echo "Update Successful";
    var_dump($numid);
    } else {
        echo "Error: " . $sql . "<br/>" . $phonenumbersql . "<br/>" . $emailsql . "<br/>" . $conn->error; 
    }

?>