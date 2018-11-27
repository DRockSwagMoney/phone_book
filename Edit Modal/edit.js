$(document).ready(function () {


});

//Edit modal
$(document).on('click', '#btn_edit', function () {
    var id = $(this).data("id4");
    $.ajax({
        url: "Edit Modal/edit.php",
        type: "POST",
        data: { id: id },
        dataType: "text",
        success: function (data) {
            $('#edit_data').html(data);
            $('#editContact').modal('toggle');
        }
    });
});


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
        url: "Edit Modal/getNumId.php",
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
        url: "Edit Modal/getEmailId.php",
        method: "get",
        data: { id: id },
        success: function (data) {
            deleteEmailId.push(data);
            console.log(emailcounter);
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
            console.log(deleteNumberId);
            $.ajax({
                url: "Edit Modal/editNumDelete.php",
                type: "POST",
                data: { deleteNumberId: deleteNumberId },
                success: function (data) {
                    alert(data);
                }
            });
        }
        if (emailcounter > 0) {
            emailcounter = 0;
            console.log(deleteEmailId);
            $.ajax({
                url: "Edit Modal/editEmailDelete.php",
                type: "POST",
                data: { deleteEmailId: deleteEmailId },
                success: function (data) {
                    alert(data);
                }
            });
        }
        $.ajax({
            url: "Edit Modal/submitEdits.php",
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


$(document).on('click', '#Cancel', function () {
    resetEditCounters();
    console.log(numcounter);
    console.log(emailcounter);
    deleteNumberId = [];
    deleteEmailId = [];
});

//Clears queue when modal disappears in the Edit Contact modal
$(document).on('hidden.bs.modal', '#editContact', function () {
    deleteNumberId = [];
    deleteEmailId = [];
});

function resetEditCounters() {
    numcounter = 0;
    emailcounter = 0;
    deleteNumberId = [];
    deleteEmailId = [];
}