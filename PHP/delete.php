<?php
    //Create Connection
    include 'connect.php';


    $sql = "DELETE FROM second_phonebook WHERE id ='".$_POST["id"]."'";
    if($conn->query($sql) === TRUE){
      echo 'Data Deleted'; 
    }
?>