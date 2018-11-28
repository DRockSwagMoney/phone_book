// JavaScript source code
$(document).ready(function () {
    fetch_data();
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








