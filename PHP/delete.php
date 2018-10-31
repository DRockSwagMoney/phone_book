<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);


    $sql = "DELETE FROM second_phonebook WHERE id ='".$_POST["id"]."'";
    $phonenumbersql = "DELETE FROM phone_numbers WHERE phonenumberid ='".$_POST["id"]."'";
    $emailsql = "DELETE FROM emails WHERE emailid ='".$_POST["id"]."'";
    if($conn->query($sql) === TRUE && $conn->query($phonenumbersql) === TRUE && $conn->query($emailsql) === TRUE){
      echo 'Data Deleted'; 
    }
?>