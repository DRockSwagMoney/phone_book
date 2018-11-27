$(document).ready(function () {


});

//View modal
$(document).on('click', '#btn_view', function () {
    var id = $(this).data("id3");
    $.ajax({
        url: "View Modal/view.php",
        type: "POST",
        data: { id: id },
        dataType: "text",
        success: function (data) {
            $('#view_data').html(data);
            $('#viewContact').modal('toggle');
        }
    });
});