// JavaScript source code
$(document).ready(function () {
    fetch_data();
    //Button to add phone number in add contact function
    $('#addNumBtn').click(function () {
        $('#addNewNumField').append("<div id='removenum'><div class='row'><div class='col-sm-10'><input type='text' name='phonenumber[]' id='phonenumber' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closenum'>&times;</button></div></div><br/></div>");
    });
    //Button to add email in add contact function
    $('#addEmailBtn').click(function () {
        $('#addNewEmailField').append("<div id='removeemail'> <div class='row'><div class='col-sm-10'><input type='text' name='email[]' id='email' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closeemail'>&times;</button></div></div><br/></div>");
    });

});

//Removes the row for the new number
$(document).on('click', '#closenum', function () {
    $('#removenum').remove();
});
//Removes the row for the new email (blank field)
$(document).on('click', '#closeeditemail', function () {
    $('#removeemail').remove();
});

/*$(document).on('click', '#deleteEditEmail', function () {
    var id = $(this).data("id7");
    $('#' + id).remove();
    $.ajax({
        url: "PHP/editEmailDelete.php",
        method: "get",
        data: { id: id },
        success: function (data) {
            alert(data);
        }
    });
});*/
//Removes the row for the edit new number after clicking add
$(document).on('click', '#closeeditnum', function () {
    $('#removeeditnum').remove();
});
//Removes the row for the edit new number after a submit has been completed
var deleteNumberId = [];
var numcounter = 0;
$(document).on('click', '#deleteEditNumber', function () {
    var id = $(this).data("id6");
    $('#' + id).remove();
    numcounter++;
    $.ajax({
        url: "PHP/getNumId.php",
        method: "get",
        data: { id: id },
        success: function (data) {
            deleteNumberId.push(data);
        }
    });
});
//Removes the row for the edit new email after add button has been clicked
var deleteEmailId = [];
var emailcounter = 0;
$(document).on('click', '#closeeditemail', function () {
    $('#removeeditemail').remove();
});

$(document).on('click', '#deleteEditEmail', function () {
    var id = $(this).data("id7");
    $('#' + id).remove();
    emailcounter++;
    $.ajax({
        url: "PHP/getEmailId.php",
        method: "get",
        data: { id: id },
        success: function (data) {
            deleteEmailId.push(data);
        }
    });
});


function fetch_data() {
    $.ajax({
        url: "PHP/select.php",
        method: "post",
        success: function (data) {
            $('#live_data').html(data);
        }
    });
}

//Delete Button
$(document).on('click', '#btn_delete', function () {
    var id = $(this).data("id5");
    if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url: "PHP/delete.php",
            type: "POST",
            data: { id:id },
            dataType: "text",
            success: function (data) {
                alert(data);
                fetch_data();
            }
        });
    }
});

//Add contact modal
$(document).on('click', '#insert', function () {
    event.preventDefault();
    if ($('#fname').val() == '') {
        alert("Enter First Name");
        return false;
    }
    else if ($('#lname').val() == '') {
        alert("Enter Last Name");
        return false;
    }
    else if ($('#phonenumber').val() == '') {
        alert("Enter Phone Number");
        return false;
    }
    else if ($('#email').val() == '') {
        alert("Enter Email");
        return false;
    }
    else {
        $.ajax({
            url: "PHP/insert.php",
            type: "POST",
            data: $('#insertForm').serialize(),
            success: function (data) {
                console.log($('#insertForm').serialize());
                $('#insertForm')[0].reset();
                $('#addContact').modal('toggle');
                removeInputs();
                alert(data);
                fetch_data();
                return true;
            }
        });
    }
});


//View modal
$(document).on('click', '#btn_view', function () {
    var id = $(this).data("id3");
        $.ajax({
            url: "PHP/view.php",
            type: "POST",
            data: { id:id },
            dataType: "text",
            success: function (data) {
                $('#view_data').html(data);
                $('#viewContact').modal('toggle');
            }
        });
});

//Edit modal
$(document).on('click', '#btn_edit', function () {
    var id = $(this).data("id4");
    $.ajax({
        url: "PHP/edit.php",
        type: "POST",
        data: { id:id },
        dataType: "text",
        success: function (data) {
            $('#edit_data').html(data);
            $('#editContact').modal('toggle');
        }
    });
});

//Submit button for the edit feature
$(document).on('click', '#saveChanges', function () {
    event.preventDefault();
    if ($('#editfname').val() == '') {
        alert("Enter First Name");
        return false;
    }
    else if ($('#editlname').val() == '') {
        alert("Enter Last Name");
        return false;
    }
    else if ($('#editphonenumber').val() == '') {
        alert("Enter Phone Number");
        return false;
    }
    else if ($('#editemail').val() == '') {
        alert("Enter Email");
        return false;
    }
    else {
        if (numcounter > 0) {
            numcounter = 0;
            $.ajax({
                url: "PHP/editNumDelete.php",
                type: "POST",
                data: { deleteNumberId: deleteNumberId },
                success: function (data) {
                    alert(data);
                }
            });
        }
        if (emailcounter > 0) {
            emailcounter = 0;
            $.ajax({
                url: "PHP/editEmailDelete.php",
                type: "POST",
                data: { deleteEmailId: deleteEmailId },
                success: function (data) {
                    alert(data);
                }
            });
        }
        $.ajax({
            url: "PHP/submitEdits.php",
            type: "POST",
            data: $('#makeEdits').serialize(),
            success: function (data) {
                console.log($('#makeEdits').serialize());
                $('#makeEdits')[0].reset();
                $('#editContact').modal('toggle');
                alert(data);
                fetch_data();
                console.log(emailcounter);
                resetEditCounters();
            }
        });
    }
});

//Actual test for edit email button
$(document).on('click', '#addEditEmail', function () {
    $.get('HTML/editemail.html', function (data) {
        $('#newEditEmailField').append(data);
    });
});

//Actual test for edit phone number button
$(document).on('click', '#addEditNumber', function () {
    $.get('HTML/editnumber.html', function (data) {
        $('#newEditPhoneNumberField').append(data);
    });
});
//Hides extra fields in the Add Contact modal after submission
function removeInputs() {
    $('#removenum').remove();
    $('#removeemail').remove();
}
//Hides extra fields in the Add Contact modal
$(document).on('hidden.bs.modal', '#addContact', function() {
    $('#removenum').remove();
    $('#removeemail').remove();
});

$(document).on('click', '#Cancel', function () {
    resetEditCounters();
});

function resetEditCounters() {
    numcounter = 0;
    emailcounter = 0;
}
