<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);


    $sql = "DELETE FROM second_phonebook WHERE id ='".$_POST["id"]."'";
    if($conn->query($sql) === TRUE){
      echo 'Data Deleted'; 
    }
?>