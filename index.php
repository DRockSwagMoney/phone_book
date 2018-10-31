<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Second Phone Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="JavaScript/main.js"></script>
    
</head>
<body>
    <div class="container">
        <h3 align="center">Phone Book</h3>
        <div id="live_data"></div><!--Select.php that forms the table here-->
        <div id="view_data"></div><!--This is where the view modal will pop up-->
        <div id="edit_data"></div><!--This is where the edit modal will pop up-->

        <div class="text-center">
            <button class="btn btn-success" data-target="#addContact" data-toggle="modal" type="button">Add Contact</button>
            <button class="btn btn-danger" id="resetBtn" type="button">Reset</button>
        </div>

        <div id="addContact" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create New Contact</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="insertForm">
                                <label>Enter First Name:</label>
                                <input type="text" name="fname" id="fname" class="form-control" />
                                <br />
                                <label>Enter Last Name:</label>
                                <input type="text" name="lname" id="lname" class="form-control" />
                                <br />
                                <label>Enter Phone Number(s):</label>
                                <div id="addNewNumField">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input type="text" name="phonenumber" id="phonenumber" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" name="addNumBtn" id="addNumBtn">+</button>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                <br/>
                                <label>Enter Email(s):</label>
                                <div id="addNewEmailField">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input type="text" name="email" id="email" class="form-control" />
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" name="addEmailBtn" id="addEmailBtn">+</button>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                
                                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success"/>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!--End of addContact Modal-->            
    </div>
</body>
</html>