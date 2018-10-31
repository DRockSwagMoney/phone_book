<?php
    //Create Connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "phone_book";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $output = '';
    $sql = "SELECT * FROM second_phonebook";
    $result = $conn->query($sql);
    $output .= '
                <div class="table-responsive">
                    <table class="table" id="phoneBookTable">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>';
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $output .=                             
                            '<tr>
                            <td class="first_name" data-id="'.$row["id"].'">'.$row["firstname"].'</td>
                            <td class="last_name" data-id="'.$row["id"].'">'.$row["lastname"].'</td>
                            <td><button id="btn_view" class="btn" name="btn_view" data-id="'.$row["id"].'"><span class="far fa-eye"></span></button>
                            <td><button id="btn_edit" class="btn" name="btn_edit" data-id="'.$row["id"].'"><span class="far fa-edit"></span></button>
                            <td><button id="btn_delete" class="btn" name="btn_delete" data-id="'.$row["id"].'"><span class="far fa-trash-alt"></span></button></td>
                            </tr>
                            ';
            }
        } else {
            $output .= '<tr>
                            <td colspan="5">Data Not Found</td>
                        </tr>';
        }
        $output .= '</table>
                </div>'; 
        echo $output;         
                
?>