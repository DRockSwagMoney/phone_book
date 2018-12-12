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
    resetEditEntries();

    editFnameValidation($('#editfname').val());
    editLnameValidation($('#editlname').val());
    //Number validation
    ($('[name^="editphonenumber"]').each(function () {
        editPhoneValidation($(this).val());
    }));
    console.log(editNumValidate);
    ($('[name^="neweditphonenumber"]').each(function () {
        editPhoneValidation($(this).val());
    }));
    testNumForTrue = editNumValidate.every(testTrue);
    testNewNumForTrue = editNewNumValidate.every(testTrue);
    //Email Validation
    ($('[name^="editemail"]').each(function () {
        editEmailValidation($(this).val());
    }));
    ($('[name^="neweditemail"]').each(function () {
        editEmailValidation($(this).val());
    }));
    console.log(editEmailValidate);
    testEmailForTrue = editEmailValidate.every(testTrue);
    testNewEmailForTrue = editNewEmailValidate.every(testTrue);
    if (editFnameValidate === false || editLnameValidate === false || testNumForTrue === false || testEmailForTrue === false || testNewNumForTrue === false || testNewEmailForTrue === false) {
        editValidation();
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
                number_of_records();
                resetEditCounters();
                resetEditEntries();
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
    resetEntries();
});

//Clears queue when modal disappears in the Edit Contact modal
$(document).on('hidden.bs.modal', '#editContact', function () {
    deleteNumberId = [];
    deleteEmailId = [];
    editNumValidate = [];
    editEmailValidate = [];
    testNumForTrue = true;
    testEmailForTrue = true;
    $('#makeEdits')[0].reset();
});

function resetEditCounters() {
    numcounter = 0;
    emailcounter = 0;
    deleteNumberId = [];
    deleteEmailId = [];
    
}

//first name validation
var editFnameValidate = false;
function editFnameValidation(inputtxt) {
    editFnameValidate = true;
    var fname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = fname.test(inputtxt);

    if (inputtxt == "") {
        editFnameValidate = false;
        //alert("Enter First Name");
        return editFnameValidate;
    }

    else if (result === false) {
        editFnameValidate = false;
        //alert("Enter Valid First Name");
        return editFnameValidate;
    }
}
//Last name validation
var editLnameValidate = false;
function editLnameValidation(inputtxt) {
    editLnameValidate = true;
    var lname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = lname.test(inputtxt);

    if (inputtxt == "") {
        editLnameValidate = false;
        //alert("Enter Last Name");
        return editLnameValidate;
    }

    else if (result === false) {
        editLnameValidate = false;
        //alert("Enter Valid Last Name");
        return editLnameValidate;
    }
}
//Validates the phonenumber whether it is blank or invalid.
var editNumValidate = [];
var editNewNumValidate = [];
function editPhoneValidation(inputtxt) {
    var phone = new RegExp(/^(?:\+?1\s*(?:[.-]\s*)?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})?[-. ]?([0-9]{4})$/);
    var result = phone.test(inputtxt);

    if (inputtxt == "") {
        editNumValidate.push(false);
        //alert("Enter Phone Number");
        return editNumValidate;
    }

    else if (result === false) {
        editNumValidate.push(false);
        //alert("Enter Valid Phone Number");
        return editNumValidate;
    } else {
        editNumValidate.push(true);
    }
}


//Validates the email whether it is blank or invalid.
var editEmailValidate = [];
var editNewEmailValidate = [];
function editEmailValidation(inputtxt) {
    var email = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    var result = email.test(inputtxt);
    console.log(inputtxt);
    if (inputtxt == "") {
        editEmailValidate.push(false);
        //alert("Enter Email");
        return editEmailValidate;
    }

    else if (result === false) {
        editEmailValidate.push(false);
        //alert("Enter Valid Email");
        return editEmailValidate;
    } else {
        editEmailValidate.push(true);
    }
}
//Testing is the phone and email validations are true.
var testNumForTrue = true;
var testEmailForTrue = true;
function testTrue(data) {
    return data == true;
}

function resetEditEntries() {
    editNumValidate = [];
    editNewNumValidate = [];
    editEmailValidate = [];
    editNewEmailValidate = [];
    testNumForTrue = true;
    testNewNumForTrue = true;
    testEmailForTrue = true;
    testNewEmailForTrue = true;
}

function editValidation() {
    'use strict';

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('edit-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

}