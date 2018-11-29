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
    numValidate = [];
    emailValidate = [];
    event.preventDefault();
    fnameValidation($('#fname').val());
    lnameValidation($('#lname').val());
    ($('[name^="phonenumber"]').each(function () {
        phoneValidation($(this).val());
    }));
    ($('[name^="email"]').each(function () {
        emailValidation($(this).val());
    }));

    if (fnameValidate === false) {
        return false;
    } else if (lnameValidate === false) {
        return false;
    } else if (numValidate.every(testTrue) === false) {
        return false;
    } else if (emailValidate.forEach === false) {
        return false;
    }
    else /*(fnameValidate === true && lnameValidate === true && numValidate[0] === true && numValidate[1] === true && emailValidate === true)*/ {
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
    $('#insertForm')[0].reset();
    numValidate = [];
});

//Hides extra fields in the Add Contact modal after submission
function removeInputs() {
    $('#removenum').remove();
    $('#removeemail').remove();
}

var fnameValidate = false;
function fnameValidation(inputtxt) {
    fnameValidate = true;
    var fname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = fname.test(inputtxt);

    if (inputtxt == "") {
        event.preventDefault();
        alert("Enter First Name");
        fnameValidate = false;
        return fnameValidate;
    }

    else if (result === false) {
        alert("Enter Valid First Name");
        event.preventDefault();
        fnameValidate = false;
        return fnameValidate;
    }
}
var lnameValidate = false;
function lnameValidation(inputtxt) {
    lnameValidate = true;
    var lname = new RegExp(/[A-Z][a-zA-Z][^#&<>\"~;$^%{}?]{1,20}$/g);
    var result = lname.test(inputtxt);

    if (inputtxt == "") {
        event.preventDefault();
        alert("Enter Last Name");
        lnameValidate = false;
        return lnameValidate;
    }

    else if (result === false) {
        alert("Enter Valid Last Name");
        event.preventDefault();
        lnameValidate = false;
        return lnameValidate;
    }
}

var numValidate = [];
function phoneValidation(inputtxt) {
    var phone = new RegExp(/^(?:\+?1\s*(?:[.-]\s*)?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})?[-. ]?([0-9]{4})$/);
    var result = phone.test(inputtxt); 
    console.log(inputtxt);

    if (inputtxt == "") {
        event.preventDefault();
        alert("Enter Phone Number");
        numValidate.push(false);
        return numValidate;
    }

    else if (result === false) {
        alert("Enter Valid Phone Number");
        event.preventDefault();
        numValidate.push(false);
        return numValidate;
    } else {
        numValidate.push(true);
        }
}

function testTrue(data) {
    for (i = 0; i < data.length; i++) {
        if (data[i] === false) {
            return false;
        } 
     alert(data);
    }
}

var emailValidate = [];
function emailValidation(inputtxt) {
    var email = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    var result = email.test(inputtxt);

    if (inputtxt == "") {
        event.preventDefault();
        alert("Enter Email");
        emailValidate.push(false);
        return emailValidate;
    }

    else if (result === false) {
        alert("Enter Valid Email");
        event.preventDefault();
        emailValidate.push(false);
        return emailValidate;
    }
}