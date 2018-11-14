<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $deleteid = $_GET["id"];
    $phonenumbersql = $conn->prepare("DELETE FROM phone_numbers WHERE id = ? ");
    $phonenumbersql->bind_param("i", $deleteid);

    /*$phonenumbersql = "DELETE FROM phone_numbers WHERE id ='".$_POST["id"]."'";
    if($conn->query($phonenumbersql) === TRUE){
      echo 'Data Deleted'; 
    }*/
    echo $deleteid;
?>