$(document).ready(function() {
    $.uploadPreview({
        input_field: "#addpostform-image",   // Default: .image-upload
        preview_box: ".img-label",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Загрузить основное фото",   // Default: Choose File
        label_selected: "Загрузить основное фото",  // Default: Change File
        no_label: false                 // Default: false
    });
});

$('#addpostform-image').on('change', function(){
/*    files = this.files[0];

    var form_data = new FormData();
    form_data.append('file', files);*/


    var formData = new FormData($("#w0")[0]);
    $.ajax({
        url: '/user/photo/add',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $('#w0 .form-text').css('display', 'none');
        },
        success: function (data) {
            $('.form-info p').text('Фото загружено');
            $('.form-info').css('display', 'block');
        },

        complete: function() {
            // success alerts
        },

        error: function (data) {
            alert("There may a error on uploading. Try again later");
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$(function(){
    $('#my_form').on('submit', function(e){

    });
});