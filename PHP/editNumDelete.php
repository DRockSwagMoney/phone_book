<?php
    //Create Connection
    include 'connect.php';

    $phonenumbersql = $conn->prepare("DELETE FROM phone_numbers WHERE id = ? ");
    $phonenumbersql->bind_param("i", $deleteid);

    /*$phonenumbersql = "DELETE FROM phone_numbers WHERE id ='".$_POST["id"]."'";
    if($conn->query($phonenumbersql) === TRUE){
      echo 'Data Deleted'; 
    }*/
    //var_dump($deleteid);
?>