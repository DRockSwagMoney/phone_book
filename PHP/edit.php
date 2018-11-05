<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    $sql = '';
    $id = $_POST["id"];
    $sql = "SELECT * FROM second_phonebook WHERE id = $id";
    $phonenumbersql = "SELECT * FROM phone_numbers WHERE userid = $id";
    $emailsql = "SELECT * FROM emails WHERE userid = $id";


    $result = $conn->query($sql);
    $resultnum = $conn->query($phonenumbersql);
    $resultemail = $conn->query($emailsql);

    $output .= '<div id="editContact" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form id="makeEdits" method="post">';
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $output .= '<div class="modal-header">
                                <h4 class="modal-title">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" style="display:none" class="form-control" name="editid" value="'.$row["id"].'"/>
                                            <label>First Name: </label>
                                            <input class="form-control" type="text" name="editfname" id="editfname" value="'.$row["firstname"].'"/>
                                        </div>
                                        <div class="col">
                                            <label>Last Name: </label>
                                            <input class="form-control" type="text" name="editlname" id="editlname" value="'.$row["lastname"].'"/>
                                        </div>    
                                    </div>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>';
        }
        $output .=          '<div class="modal-body">
                            <h5><label>Phone Number:</label></h5>';
        while($row = $resultnum->fetch_assoc()) {
                $output .= '<div class="row newEditPhoneNumberField">
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="editphonenumber" id="editphonenumber" value="'.$row["number"].'"/>
                                    </div>
                                    <div class="col">
                                        <button type="button" id="addEditNumber" name="addEditNumber" class="btn btn-primary">+</button>
                                        <button type="button" name="removeNumber" class="btn btn-danger">&times;</button>
                                    </div>
                            </div>';
        }
                $output .= '<h5><label>Email:</label></h5>';
        while($row = $resultemail->fetch_assoc()) {
                $output .= "<div class='newEditEmailField'>
                                <div class='row'>
                                    <div class='col-sm-9'>
                                        <input class='form-control' type='text' name='editemail' id='editemail' value='".$row['email']."'/>
                                    </div>
                                    <div class='col'>
                                        <button type='button' id='addEditEmail' name='addEditEmail' class='btn btn-primary'>+</button>
                                    </div> 
                                </div>
                            </div>";
                            
        }
        $output .=          '</div> 
                            <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                            
                            <input type="submit" name="saveChanges" id="saveChanges" value="Save Changes" class="btn btn-success"/>
                        </form>
                        </div>';
                        
    }else {
        $output .= '<div class="modal-header">
                                <h4 class="modal-title">No data to display</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>';
    }
        $output .=      '</div>
                    </div>
                </div> <!--End of editContact Modal-->';
    echo $output;
?>