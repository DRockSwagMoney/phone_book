<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);


    $emailsql = "DELETE FROM emails WHERE id ='".$_POST["id"]."'";
    if($conn->query($emailsql) === TRUE){
      echo 'Data Deleted'; 
    }
?>