<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    $sql = '';
    $sql = "SELECT * FROM second_phonebook WHERE id ='".$_POST["id"]."'";
    $phonenumbersql = "SELECT * FROM phone_numbers WHERE userid ='".$_POST["id"]."'";
    $emailsql = "SELECT * FROM emails WHERE userid ='".$_POST["id"]."'";


    $result = $conn->query($sql);
    $resultnum = $conn->query($phonenumbersql);
    $resultemail = $conn->query($emailsql);

    $output .= '<div id="viewContact" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">';
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $output .= '<div class="modal-header">
                                <h4 class="modal-title">'.$row["firstname"].' '.$row["lastname"].'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>';
        }
        $output .=          '<div class="modal-body">
                            <label>Phone Number</label>';
        while($row = $resultnum->fetch_assoc()) {
                $output .= '<h5>'.$row["number"].'</h5>';
        }
                $output .= '<label>Email</label>';
        while($row = $resultemail->fetch_assoc()) {
                $output .= '<h5>'.$row["email"].'</h5>';
        }
        $output .=          '</div> 
                            <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                        </div>';
    }else {
        $output .= '<div class="modal-header">
                                <h4 class="modal-title">No data to display</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>';
    }
        $output .=      '</div>
                    </div>
                </div> <!--End of view Contact Modal-->';
    echo $output;
?>