<?php
    //Create Connection
    include 'connect.php';

    $output = '';
    $sql = "SELECT * FROM $tablename
            ORDER BY firstname ASC";
    $result = $conn->query($sql);
    $output .= '
                <div class="table-responsive table-wrapper-scroll-y">
                    <table class="table" id="phoneBookTable">
                            <thead >
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>';
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $output .=                             
                            '<tr>
                            <td class="first_name" data-id1="'.$row["id"].'">'.$row["firstname"].'</td>
                            <td class="last_name" data-id2="'.$row["id"].'">'.$row["lastname"].'</td>
                            <td><button id="btn_view" class="btn" name="btn_view" data-id3="'.$row["id"].'"><span class="far fa-eye"></span></button>
                            <td><button id="btn_edit" class="btn" name="btn_edit" data-id4="'.$row["id"].'"><span class="far fa-edit"></span></button>
                            <td><button id="btn_delete" class="btn" name="btn_delete" data-id5="'.$row["id"].'"><span class="far fa-trash-alt"></span></button></td>
                            </tr>
                            ';
            }
        } else {
            $output .= '<tr>
                            <td colspan="5" style="text-align: center">Please add a contact</td>
                        </tr>';
        }
        $output .= '</table>
                </div>'; 
        echo $output;         
                
?>