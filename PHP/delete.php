<?php
    //Create Connection
    include 'connect.php';


    $sql = "DELETE FROM $tablename WHERE id ='".$_POST["id"]."'";
    if($conn->query($sql) === TRUE){
      echo 'Data Deleted'; 
    }
?>