$(document).ready(function () {
    //Button to add phone number in add contact function
    $('#addNumBtn').click(function () {
        $('#addNewNumField').append("<div id='removenum'><div class='row'><div class='col-sm-10'><input type='text' name='phonenumber[]' id='phonenumber' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closenum'>&times;</button></div></div><br/></div>");
    });
    //Button to add email in add contact function
    $('#addEmailBtn').click(function () {
        $('#addNewEmailField').append("<div id='removeemail'> <div class='row'><div class='col-sm-10'><input type='email' name='email[]' id='email' class='form-control' /></div><div class='col'><button type='button' class='btn btn-danger' id='closeemail'>&times;</button></div></div><br/></div>");
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
    resetEntries();

    fnameValidation($('#fname').val());
    lnameValidation($('#lname').val());

    ($('[name^="phonenumber"]').each(function () {
        phoneValidation($(this).val());
    }));
    testNumForTrue = numValidate.every(testTrue);
    ($('[name^="email"]').each(function () {
        emailValidation($(this).val());
    }));

    testEmailForTrue = emailValidate.every(testTrue);
    if (fnameValidate === false || lnameValidate === false || testNumForTrue === false || testEmailForTrue === false) {
        addValidation();
        return false;
    } else  {
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
                number_of_records();
                resetEntries();
                return true;
            }
        });
    }
});

//Hides extra fields in the Add Contact modal
$(document).on('hidden.bs.modal', '#addContact', function () {
    $('#removenum').remove();
    $('#removeemail').remove();
    $('#insertForm')[0].reset();
    numValidate = [];
});

//Hides extra fields in the Add Contact modal after submission
function removeInputs() {
    $('#removenum').remove();
    $('#removeemail').remove();
}
//first name validation
var fnameValidate = false;
function fnameValidation(inputtxt) {
    fnameValidate = true;
    var fname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = fname.test(inputtxt);

    if (inputtxt == "") {
        fnameValidate = false;
        //alert("Enter First Name");
        return fnameValidate;
    }

    else if (result === false) {
        fnameValidate = false;
        //alert("Enter Valid First Name");
        return fnameValidate;
    }

}
//Last name validation
var lnameValidate = false;
function lnameValidation(inputtxt) {
    lnameValidate = true;
    var lname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = lname.test(inputtxt);

    if (inputtxt == "") {
        lnameValidate = false;
        //alert("Enter Last Name");
        return lnameValidate;
    }

    else if (result === false) {
        lnameValidate = false;
        //alert("Enter Valid Last Name");
        return lnameValidate;
    }
}
//Validates the phonenumber whether it is blank or invalid.
var numValidate = [];
var error = 0;
function phoneValidation(inputtxt) {
    var phone = new RegExp(/^(?:\+?1\s*(?:[.-]\s*)?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})?[-. ]?([0-9]{4})$/);
    var result = phone.test(inputtxt);

    if (inputtxt == "") {
        numValidate.push(false);
        //alert("Enter Phone Number");
        return numValidate;
    }

    else if (result === false) {
        numValidate.push(false);
       //alert("Enter Valid Phone Number");
        return numValidate;
    } else {
        numValidate.push(true);
    }
}


//Validates the email whether it is blank or invalid.
var emailValidate = [];
function emailValidation(inputtxt) {
    var email = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    var result = email.test(inputtxt);

    if (inputtxt == "") {
        emailValidate.push(false);
        //alert("Enter Email");
        return emailValidate;
    }

    else if (result === false) {
        emailValidate.push(false);
        //alert("Enter Valid Email");
        return emailValidate;
    } else {
        emailValidate.push(true);
    }
}
//Testing is the phone and email validations are true.
var testNumForTrue = true;
var testEmailForTrue = true;
function testTrue(data) {
    return data == true;
}

function resetEntries() {
    numValidate = [];
    emailValidate = [];
    testNumForTrue = true;
    testEmailForTrue = true;
}

function addValidation() {
    'use strict';

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('add-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

}
