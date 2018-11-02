// JavaScript source code
$(document).ready(function () {
    fetch_data();
    $('#addNumBtn').click(function () {
        $('#addNewNumField').append("<div id='removenum'><div class='row'><div class='col-sm-10'><input type='text' name='phonenumber2' id='phonenumber2' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closenum'>&times;</button></div></div><br/></div>");
    });
    $('#addEmailBtn').click(function () {
        $('#addNewEmailField').append("<div id='removeemail'> <div class='row'><div class='col-sm-10'><input type='text' name='email2' id='email2' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closeemail'>&times;</button></div></div><br/></div>");
    });
});
$(document).on('click', '#closenum', function () {
    $('#removenum').remove();
});
$(document).on('click', '#closeemail', function () {
    $('#removeemail').remove();
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

function join_data() {
    $.ajax({
        url: "PHP/join.php",
        method: "post",
        success: function (data) {
            fetch_data();
        }
    });
}


$(document).on('click', '#btn_delete', function () {
    var id = $(this).data("id5");
    console.log(id);
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
                $('#insertForm')[0].reset();
                $('#addContact').modal('toggle');
                alert(data);
                fetch_data();
                return true;
            }
        });
    }
});

$(document).on('click', '#resetBtn', function () {
    if (confirm("Are you sure you would like to reset all tables?")) {
        $.ajax({
            url: "PHP/reset.php",
            type: "POST",
            dataType: "text",
            success: function (data) {
                alert(data);
                fetch_data();
            }
        });
    }
});

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
                return true;
            }
        });
    }
});

