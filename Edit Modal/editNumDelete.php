<?php
    //Create Connection
    include '../PHP/connect.php';

    //Used to store the phone number content when deleting a row in the edit modal
    $deleteid = $_POST["deleteNumberId"];
    $phonenumbersql = $conn->prepare("DELETE FROM $tnnumbers WHERE id = ? ");
    $phonenumbersql->bind_param("i", $deleteidvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach($deleteid as $deleteidvalue) {
            $phonenumbersql->execute();
        }
    }
?>