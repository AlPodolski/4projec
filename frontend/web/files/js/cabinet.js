$(document).ready(function() {
    $.uploadPreview({
        input_field: "#addpostform-image",   // Default: .image-upload
        preview_box: ".img-label",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Загрузить основное фото",   // Default: Choose File
        label_selected: "Загрузить основное фото",  // Default: Change File
        no_label: false                 // Default: false
    });
    $.uploadPreview({
        input_field: "#header_form",   // Default: .image-upload
        preview_box: "#w1 .img-label",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Загрузить основное фото",   // Default: Choose File
        label_selected: "Загрузить основное фото",  // Default: Change File
        no_label: false                 // Default: false
    });

});

$(document).ready(function() {
    $("#profile-phone").mask("+7(999)99-99-999");
});

$('#photo-file').on('change', function(){
/*    files = this.files[0];

    var form_data = new FormData();
    form_data.append('file', files);*/
    var formData = new FormData($("#add-gallery-form")[0]);
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
            $('.photo-items').prepend(data);
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
function deletePhotoItem(object){

    var id = $(object).attr('data-id');

    $.ajax({
        url: '/user/photo/delete',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).parent().remove();
        },
    });

    return false;
}

var sock_url = document.getElementById('sock-addr');

var chat = new WebSocket(sock_url.getAttribute('data-url'));

setInterval(function() {
    check_conection();
}, 10000); // каждую секунду

function check_conection(){

    console.log(window.chat.readyState);

    if(window.chat.readyState != 1){

        var sock_url = document.getElementById('sock-addr');

        window.chat.close();

        window.chat = new WebSocket(sock_url.getAttribute('data-url'));

    }
}

function message_sound(){
    var audio = new Audio();
    audio.src = '/files/audio/alarm-clock-button-click_z17d0vno.mp3';
    audio.autoplay = true;
}

chat.onclose = function(event) {
    console.log(event);
    if (event.wasClean) {
        console.log(`[close] Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
    } else {
        // например, сервер убил процесс или сеть недоступна
        // обычно в этом случае event.code 1006
        console.log('[close] Соединение прервано');
    }
};

chat.onerror = function(error) {
    console.log(`[error] ${error.message}`);
};


function add_message(img, name, id, message, class_attr = 'right-message'){
    $('.chat').prepend('<div class="wall-tem '+class_attr+'">\n' +
        '\n' +
        '            <div class="post_header">\n' +
        '\n' +
        '                <a class="post_image" href="/user/" '+ id +' >\n' +
        '\n' +
        '                    \n' +
        '                        <img class="img" src="'+img+'" alt="">\n' +
        '                    \n' +
        '                </a>\n' +
        '\n' +
        '                <div class="post_header_info">\n' +
        '\n' +
        '                    <a href="'+id+'" class="author">\n' +
        '                        '+name+'</a>\n' +
        '                    <span class="post_date"><span class="post_link"><span class="rel_date">Только что</span></span></span>\n' +
        '                    <div class="post-text">\n' +
        '                        '+message+'                    </div>\n' +
        '                </div>\n' +
        '\n' +
        '\n' +
        '            </div>\n' +
        '            <div style="clear: both">\n' +
        '            </div>\n' +
        '\n' +
        '\n' +
        '</div>');
}

function get_message_form(object) {

    var id = $(object).attr('data-user-id');

    $.ajax({
        url: '/user/chat/get',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $('#messageModal .modal-body').html(data);
            $('#messageModal').modal('show');
            $('#messageModal .chat-block').attr('data-to', $(object).attr('data-user-id'));
        },
    });

    $('.user-id-class .form-control').val($(object).attr('data-user-id'));

    $('#message-form .alert-success').remove();

    $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);
}

window.chat.onmessage = function(e) {

    var response = JSON.parse(e.data);
    if (response.type && response.type == 'chat') {

        if($('.chat-block').attr('data-to') == response.from_id){

            var object = $('.message-send-btn');

            var img = $('.user-to').attr('srcset');
            var name = $(object).attr('data-name');
            var id = $(object).attr('data-id');

            add_message(img, name, id, response.message, '');

        }

        message_sound();

        console.log(response);

        $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);


    }
};

function send_message(object){

    var to = $(object).attr('data-user-id-to');
    var message = $(object).siblings('.field-sendmessageform-text').find('#sendmessageform-text').val();
    var dialog_id = $(object).siblings('.field-sendmessageform-chat_id').find('#sendmessageform-chat_id').val();


    var text = $('#message-form textarea').val();
    var img = $('.user-img').attr('srcset');
    var name = $(object).attr('data-name');
    var id = $(object).attr('data-id');


    $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);

    check_conection();

    console.log(window.chat.readyState);

    if(dialog_id != 915){

        var formData = new FormData($("#message-form")[0]);

        console.log(img);

        $('#message-form textarea').val('');

        $.ajax({
            url: '/chat/send',
            type: 'POST',
            data: formData,
            datatype:'json',
            // async: false,
            beforeSend: function() {
                $('#w0 .form-text').css('display', 'none');
            },
            success: function (data) {

                add_message(img, name, id, text);

                $('.chat-wrap').scrollTop($('.chat').height());

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
    }else{

        window.chat.send(JSON.stringify({'action' : 'chat', 'message' : message, 'to' : to, 'dialog_id' : dialog_id}));

        add_message(img, name, id, text);

        $('.chat-wrap').scrollTop($('.chat').height());

    }
}

$(function() {

    window.chat.onopen = function(e) {
        $('#response').text("Connection established! Please, set your username.");
    };
    $('#btnSend').click(function() {
        if ($('#message').val()) {

            window.chat.send( JSON.stringify({'action' : 'chat', 'message' : $('#message').val()}) );
        } else {
            alert('Enter the message')
        }
    })

    $('#btnSetUsername').click(function() {
        if ($('#username').val()) {
            window.chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#username').val()}) );
        } else {
            alert('Enter username')
        }
    })

})