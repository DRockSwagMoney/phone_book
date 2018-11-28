$(document).ready(function () {
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
$(document).on('click', '#closeemail', function () {
    $('#removeemail').remove();
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
            url: "Add Contact Modal/insert.php",
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

//Hides extra fields in the Add Contact modal
$(document).on('hidden.bs.modal', '#addContact', function () {
    $('#removenum').remove();
    $('#removeemail').remove();
});

//Hides extra fields in the Add Contact modal after submission
function removeInputs() {
    $('#removenum').remove();
    $('#removeemail').remove();
}