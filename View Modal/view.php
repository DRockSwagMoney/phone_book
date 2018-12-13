<?php
    //Create Connection
    include '../PHP/connect.php';

    $output = '';
    $sql = '';
    $sql = "SELECT * FROM $tablename WHERE id ='".$_POST["id"]."'";
    $phonenumbersql = "SELECT * FROM $tnnumbers WHERE userid ='".$_POST["id"]."'";
    $emailsql = "SELECT * FROM $tnemails WHERE userid ='".$_POST["id"]."'";


    $result = $conn->query($sql);
    $resultnum = $conn->query($phonenumbersql);
    $resultemail = $conn->query($emailsql);

    //The Output variable will display inside of the view modal
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
                            <h5><label>Phone Number</label></h5>';
        while($row = $resultnum->fetch_assoc()) {
                $output .= '<div>'.$row["number"].'</div>';
        }
                $output .= '<br/>
                            <h5><label>Email</label></h5>';
        while($row = $resultemail->fetch_assoc()) {
                $output .= '<div>'.$row["email"].'</div>';
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