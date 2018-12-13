<?php
    //Create Connection
    include '../PHP/connect.php';

    //Used to store the email content when deleting a row in the edit modal
    $deleteid = $_POST["deleteEmailId"];
    $emailsql = $conn->prepare("DELETE FROM $tnemails WHERE id = ? ");
    $emailsql->bind_param("i", $deleteidvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach($deleteid as $deleteidvalue) {
            $emailsql->execute();

        }
    }
?>