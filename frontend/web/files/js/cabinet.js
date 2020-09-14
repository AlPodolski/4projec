var chat;

function socketMessageListener(e){
    var response = JSON.parse(e.data);
    console.log(response);
    if (response.type && response.type == 'chat') {

        if(!$('.message-li .position-relative .show-event').length){
            $('.message-li .position-relative').append('<span class="show-event"></span>');
        }

        if($('.chat-block').attr('data-to') == response.from_id){

            var object = $('.message-send-btn');

            var img = $('.user-to').attr('srcset');
            var name = response.from;
            var id = response.from_id;

            add_message(img, name, id, response.message, '', 0);

            $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);

            $('.user-write-'+response.from_id+' .user-write-message-text').addClass('d-none');

            var dialog_id = $('.field-sendmessageform-chat_id #sendmessageform-chat_id').val();
            window.chat.send(JSON.stringify({'action' : 'setRead', 'dialog_id' : dialog_id}));

        }

        message_sound();

        console.log(response);
    }
    if (response.type && response.type == 'writeAnswer') {

        console.log('.user-write-'+response.from);

        if($('.user-write-'+response.from).length){

            $('.user-write-'+response.from+' .user-write-message-text').removeClass('d-none');

        }
    }
    if (response.type && response.type == 'stopWriteAnswer') {

        if($('.user-write-'+response.from).length){

            $('.user-write-'+response.from+' .user-write-message-text').addClass('d-none');

        }
    }

    if (response.type && response.type == 'send_present') {

        var object = $('.message-send-btn');

        if($('.chat-block').attr('data-to') == response.from){
            var name = $(object).attr('data-name-to') ;
            var id = $(object).attr('data-user-id-to') ;
            var className = '';
            var userImg = $('.user-to').attr('srcset');
            message_sound();
        }else{
            var name = $(object).attr('data-name') ;
            var id = $(object).attr('data-user-id') ;
            var className = 'right-message';
            var userImg = $('.user-img').attr('srcset');
        }

        var img = response.img;

        add_present(img, userImg , name, id, response.message, className);

        var dialog_id = $('.field-sendmessageform-chat_id #sendmessageform-chat_id').val();

        if(!$('.message-li .position-relative .show-event').length){
            $('.message-li .position-relative').append('<span class="show-event"></span>');
        }

        $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);
    }
    if (response.type && response.type == 'send_photo_message') {

        var object = $('.message-send-btn');

        if($('.chat-block').attr('data-to') == response.from){
            var name = $(object).attr('data-name-to') ;
            var id = $(object).attr('data-user-id-to') ;
            var className = '';
            var userImg = $('.user-to').attr('srcset');
            message_sound();
        }else{
            var name = $(object).attr('data-name') ;
            var id = $(object).attr('data-user-id') ;
            var className = 'right-message';
            var userImg = $('.user-img').attr('srcset');
        }

        var img = response.img;

        add_present(img, userImg , name, id, response.message, className);

        var dialog_id = $('.field-sendmessageform-chat_id #sendmessageform-chat_id').val();

        if(!$('.message-li .position-relative .show-event').length){
            $('.message-li .position-relative').append('<span class="show-event"></span>');
        }

        $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);
    }

}

function add_present(presentImg, userImg, name, id, message = '', className = 'right-message'){

    $('.chat').prepend(
        '<div class="wall-tem '+className+'">\n' +
        '    <div class="post_header">\n' +
        '        <a class="post_image" href="/user/'+id+'">\n' +
        '            <img loading="lazy" class="img"\n' +
        '                 srcset="'+userImg+'" alt="">\n' +
        '        </a>\n' +
        '        <div class="post_header_info">\n' +
        '            <a href="/user/'+id+'" class="author">\n' +
        '                '+name+' </a>\n' +
        '            <span class="post_date"><span class="post_link"><span class="rel_date">Только что</span></span></span>\n' +
        '            <div class="post-text">\n' +
        '                <p>'+message+'</p><img src="'+presentImg+'" alt="">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div style="clear: both">\n' +
        '    </div>\n' +
        '</div>');

}

function like(object){
    var id = $(object).attr('data-id');

    if($(this).hasClass('guest')){
        $(this).siblings('.like-info').removeClass('d-none');
        $('.like-info').text('Требуется авторизация');
        return true;
    }

    $.ajax({
        url: '/wall/item/like',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).children('span').toggleClass('d-none');
            $(object).children('.like-count').html(data);
        },
    });
}

function open_comment_form(object){
    $('.comment-wall-form-'+$(object).attr('data-id')).toggleClass('d-none');
}

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

chat = new WebSocket(sock_url.getAttribute('data-url'));

chat.addEventListener('message', socketMessageListener);

setInterval(function() {
    check_conection();
}, 10000); // каждую 10 секунду

function check_conection(){

    console.log(window.chat.readyState);

    if(window.chat.readyState != 1){

        window.chat = new WebSocket(sock_url.getAttribute('data-url'));

        window.chat.addEventListener('message', socketMessageListener);

        return true;

    }
}

function send_present(object) {
    var formData = new FormData($(object).closest('form')[0]);
    $.ajax({
        url: '/present/gift',
        type: 'POST',
        data: formData,
        datatype: 'json',
        // async: false,
        beforeSend: function (data) {
            $(object).closest('#modal-present').addClass('blur');
        },
        success: function (data) {

            var result = JSON.parse(data);

            $('#modal-present .present-form').html('');
            $('#modal-present .present-modal-content-wrap').removeClass('col-6 col-md-8');
            $('#modal-present .modal-body').removeClass('col-6 col-md-8');
            $('#modal-present .present-modal-content-wrap').addClass('w-100');
            $('#modal-present .modal-body').html(result.result);

            $('#modal-present').removeClass('blur');

        },
        complete: function () {

        },
        error: function (data) {

        },
        cache: false,
        contentType: false,
        processData: false
    });
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

function add_message(img, name, id, message, class_attr = 'right-message'){
    $('.chat').prepend('<div class="wall-tem '+class_attr+'">\n' +
        '\n' +
        '            <div class="post_header">\n' +
        '\n' +
        '                <a class="post_image" href="/user/ '+ id +'" >\n' +
        '\n' +
        '                    \n' +
        '                        <img class="img" src="'+img+'" alt="">\n' +
        '                    \n' +
        '                </a>\n' +
        '\n' +
        '                <div class="post_header_info">\n' +
        '\n' +
        '                    <a href="/user/'+id+'" class="author">\n' +
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

function send_message(object){

    var to = $(object).attr('data-user-id-to');
    var message = $(object).siblings('.field-sendmessageform-text').find('#sendmessageform-text').val();
    var dialog_id = $(object).siblings('.field-sendmessageform-chat_id').find('#sendmessageform-chat_id').val();


    var text = $('#message-form textarea').val();
    var img = $('.user-img').attr('srcset');
    var name = $(object).attr('data-name');
    var id = $(object).attr('data-user-id');


    $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);

    check_conection();

    if(window.chat.readyState != 1){

        var formData = new FormData($("#message-form")[0]);

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

                $('.chat-wrap').attr('data-read', '0');

                $('#message-form textarea').val('');

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

        $(object).siblings('.field-sendmessageform-text').find('#sendmessageform-text').val('');

    }

}

$( ".wall-group-send-btn" ).click(function() {

    var formData = new FormData($(".wall-group-form")[0]);

    $('#addgrouprecorditemform-text').val('');

    $.ajax({
        url: '/group/item/add',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {

        },
        success: function (data) {
            console.log('ok');
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

function send_message_photo(){
    var formData = new FormData($("#send-message-photo-form")[0]);
    $.ajax({
        url: '/chat/send/send-photo',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {

        },
        success: function (data) {
            var result = JSON.parse(data)

            var user_img = $('.user-img').attr('srcset');
            var user_name = $('.message-send-btn').attr('data-name');
            var user_id = $('.message-send-btn').attr('data-user-id');

            add_present(result.img, user_img, user_name, user_id );

            $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);

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
}

function get_take_heart_form(object){

    var userWhoHeartIsBuy = $(object).attr('data-userWhoHeartIsBuy');

    $.ajax({
        url: '/user/heart/get-form',
        type: 'POST',
        data: 'userWhoHeartIsBuy='+userWhoHeartIsBuy,
        success: function (data) {

            $('#modal-take-heart .get-heart-form-content').html(data);

            $('#modal-take-heart').modal('toggle');

        },
    });
}