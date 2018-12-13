<?php 
    //Create Connection
    include '../PHP/connect.php';

    $x=0;
    $y=0;
    $z=0;
    $output = '';
    $names = $conn->prepare("UPDATE $tablename 
                    SET firstname=?, lastname=?
                    WHERE id =?");
    $names->bind_param("ssi", $firstname, $lastname, $id);
    
    //Phone number preparation
    $numbers = $conn->prepare("UPDATE $tnnumbers
                                SET number=?
                                WHERE id=?");
    $numbers->bind_param("si", $phonenumbervalue, $numidvalue);

    $newnumbers = $conn->prepare("INSERT INTO $tnnumbers (userid, number)
                            VALUES (?, ?)");
    $newnumbers->bind_param("is", $id, $newnumbervalue);

    //Email preparation
    $emails = $conn->prepare("UPDATE $tnemails 
                            SET email=?
                            WHERE id=?");
    $emails->bind_param("si", $emailvalue, $emailidvalue);
    $newemails = $conn->prepare("INSERT INTO $tnemails (userid, email)
                                VALUES (?, ?)");
    $newemails->bind_param("is", $id, $newemailvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["editid"];
        $firstname = $_POST["editfname"];
        $lastname = $_POST["editlname"];

        $numid = $_POST["editnumberid"];
        $numidlength = count($numid);
        $phonenumber = $_POST["editphonenumber"];
        $phonelength = count($phonenumber);        

        $emailid = $_POST["editmailid"];
        $emailidlength = count($emailid);
        $email = $_POST["editemail"];
        $emaillength = count($email);

        //Updates the names
        $names->execute();

        //Each phone number will be updated accordingly
        foreach($numid as $numidvalue) {
            $phonenumbervalue = $phonenumber[$y];
            $numbers->execute();
            $y++;
        }
        if(isset($_POST["neweditphonenumber"]) === TRUE) {
        $newphonenumber = $_POST["neweditphonenumber"];
            foreach($newphonenumber as $newnumbervalue) {
                $newnumbers->execute();
            }
        }

        //Each email will be updated accordingly
        foreach($emailid as $emailidvalue) {
            $emailvalue = $email[$z];
            $emails->execute();
            $z++;
        }
        if(isset($_POST["neweditemail"]) === TRUE) {
        $newemail = $_POST["neweditemail"];
            foreach($newemail as $newemailvalue) {
                $newemails->execute();
            }
        }
    echo 'Data Updated';
    } else {
        echo "Error: " . $sql . $phonenumbersql . $emailsql . $conn->error; 
    }

?>