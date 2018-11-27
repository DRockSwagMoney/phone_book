<?php
    //Create Connection
    include 'connect.php';
    
    $deleteid = $_POST["deleteNumberId"];
    $phonenumbersql = $conn->prepare("DELETE FROM phone_numbers WHERE id = ? ");
    $phonenumbersql->bind_param("i", $deleteidvalue);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach($deleteid as $deleteidvalue) {
            $phonenumbersql->execute();
        }
    }

    echo "These number ids were deleted: ";
    var_dump($deleteid);
?>