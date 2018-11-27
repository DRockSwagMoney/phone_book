<?php
    //Create Connection
    include 'connect.php';

    $deleteid = $_POST["deleteEmailId"];
    $emailsql = $conn->prepare("DELETE FROM emails WHERE id = ? ");
    $emailsql->bind_param("i", $deleteidvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach($deleteid as $deleteidvalue) {
            $emailsql->execute();
        }
    }

    echo "These email ids were deleted: ";
    var_dump($deleteid);
?>