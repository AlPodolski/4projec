var chat;

var sock_url = document.getElementById('sock-addr');

chat = new WebSocket(sock_url.getAttribute('data-url'));

function socketCloseListener(){
    check_conection();
}

function return_true(){
    return true;
}


setInterval(function() {
    check_conection();
}, 15000); // каждую 15 секунду

function check_conection(){

    console.log(window.chat.readyState);

    if(window.chat.readyState != 1){

        window.chat = new WebSocket(sock_url.getAttribute('data-url'));

        return true;

    }
}

function sendAnswerSignal(object){

    if ($(object).is(":focus") && $(object).attr('data-is-answer-now') == 0 && window.chat.readyState == 1) {

        var from_id = $(object).attr('data-id');
        var to = $(object).attr('data-user-id-to');

        console.log(JSON.stringify({'action' : 'adminWriteAnswerStart', 'from' : from_id,  'to' : to}));

        window.chat.send(JSON.stringify({'action' : 'adminWriteAnswerStart', 'from' : from_id,  'to' : to}));

        $(object).attr('data-is-answer-now' , 1);

    }



}


function sendStopAnswerSignal(object){
    if ($(object).attr('data-is-answer-now') == 1 && window.chat.readyState == 1) {
        var from_id = $(object).attr('data-id');
        var to = $(object).attr('data-user-id-to');
        window.chat.send(JSON.stringify({'action' : 'adminStopWriteAnswerStart', 'from' : from_id,  'to' : to}));
        $(object).attr('data-is-answer-now' , 0);
    }
}

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

function send_message(object){

    var to = $(object).attr('data-user-id-to');
    var message = $(object).siblings('.field-sendmessageform-text').find('#sendmessageform-text').val();
    var dialog_id = $(object).attr('data-dialog-id');
    var from_id = $(object).attr('data-id');
    var from_name = $(object).attr('data-name');


    var img = $('.user-img').attr('srcset');
    var name = $(object).attr('data-name');
    var id = $(object).attr('data-user-id');

    var text = $('#message-form textarea').val();

    $('.chat-wrap').scrollTop($('.chat-wrap').height() + 99999999);
    check_conection();
    $('#messageModal').modal('hide');
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
            error: function (data) {
                alert("There may a error on uploading. Try again later");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    else{

        window.chat.send(JSON.stringify({'action' : 'chatAdmin', 'from_name' : from_name, 'from_id' : from_id, 'message' : message, 'to' : to, 'dialog_id' : dialog_id}));

        add_message(img, name, id, text);

        $('.chat-wrap').scrollTop($('.chat').height());

        $(object).siblings('.field-sendmessageform-text').find('#sendmessageform-text').val('');

    }

}

function get_message_form(object) {

    var id = $(object).attr('data-user-id');
    var dialog_id = $(object).attr('data-dialog-id');

    $('#messageModal').modal('show');

    $.ajax({
        url: '/user/chat/get',
        type: 'POST',
        data: 'id='+id+'&dialog_id='+dialog_id,
        success: function (data) {
            $('#messageModal .modal-body').html(data);
            $('#messageModal').modal('show');
            $('.dialog-item-'+dialog_id).addClass('read-dialog');
            var now = new Date();
            $('.open-date-'+dialog_id).html(now);
        },
    });

    $('.user-id-class .form-control').val($(object).attr('data-user-id'));

    $('#message-form .alert-success').remove();

    $('.chat-wrap').scrollTop($('.modal-dialog .chat-wrap').height() + 99999999);

}

$('#messageModal').on('shown.bs.modal', function (e) {
    $('.chat-wrap').scrollTop($('.modal-dialog .chat-wrap').height() + 99999999)
});

function send_message_form(object) {


        var formData = new FormData($("#message-form")[0]);

        var text = $('#message-form textarea').val();
        var img = $('.user-img').attr('src');
        var name = $(this).attr('data-name');
        var dialog_id = $(this).attr('data-dialog-id');


    $('#message-form textarea').val('');

    var html = '' +
        '                                            <a target="_blank">\n' +
        '                                                <span class="nim-dialog--who">\n' +
        '                                                    <span class="im-prebody">\n' +
        '\n' +
        '                                                        \n' +
        '                                                    </span>\n' +
        '                                                </span>\n' +
        '                                            </a>\n' +
        '                                            <a>\n' +
        '                                                <span class="nim-dialog--inner-text  ">'+text+'</span>';

    console.log(html);

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




                $('.dialog-item-'+dialog_id+ ' .text-preview').html(html);



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

$(document).ready(function () {

    $('.chat-wrap').scrollTop($('.chat').height());

    $('.city-search').bind("input", function () {

        var city = this.value;

        $.ajax({
            type: 'POST',
            url: "/city/search", //Путь к обработчику
            data: 'city=' + city,
            response: 'text',
            dataType: "html",
            cache: false,
            success: function (data) {
                $(".city-wrap").html(data).fadeIn(); //Выводим полученые данные в списке
            }
        })

    });

    $('.mobile-filter-icon').click(function () {
        $('.sidebar-wrap').toggle(100);
    });
    $('.mobile-icon').click(function () {

        $('.mobile-menu').animate({
            left: '0px'
        }, 200);

        $('.mobile-icon').css('display', 'none');
        $('body').css('overflow', 'hidden');

        $('body').animate({

            left: '0'

        }, 200);
    });

    $('.icon-close').click(function () {

        $('.mobile-icon').css('display', 'block');
        $('body').css('overflow', 'inherit');

        $('.mobile-menu').animate({

            left: '-285px'
        }, 200);

        $('body').animate({

            left: '0px'

        }, 200);
    });

});

$(function(){
    $('.user-manu').on('click', function(e){
        $('.user-menu-list').toggle('slow')
    });
});

function get_presents(object){

    $.ajax({
        url: '/present/get-presents',
        type: 'POST',
        datatype:'json',
        success: function (data) {

            $('#modal-present .modal-body').html(data);
            $('#modal-present .present-item').attr('data-user-id', $(object).attr('data-user-id'));
            $('#modal-present .present-item').attr('data-from-id', $(object).attr('data-from'));
            $('#modal-present').modal()

        },

    });
}

function get_present_form(object){

    $('.present-form').html('');

    if($(window).width() > 574){
        $('#modal-present .modal-content').addClass('row  present-wrap-with-form');
        $('#modal-present .present-modal-content-wrap').addClass('col-6 col-md-8');
        $('#modal-present .present-form').addClass('col-6 col-md-4');
    }else{
        $('#modal-present .modal-content').addClass('row  present-wrap-with-form');
        $('#modal-present .present-modal-content-wrap').addClass('d-none');
        $('#modal-present .present-form').addClass('col-12');
    }

    $('.present-form').removeClass('d-none');

    var present_id = $(object).attr('data-present-id');
    var user_id = $(object).attr('data-user-id');
    var user_from_id = $(object).attr('data-from-id');

    $.ajax({
        url: '/present/get-form',
        type: 'POST',
        data: 'present_id='+present_id+'&user_id='+user_id+'&user_from_id='+user_from_id,
        datatype:'json',
        success: function (data) {
            $('.present-form').html(data);
        },

    });
}

function send_present_to_user(object){

    var from = $(object).attr('data-from');
    var to = $(object).attr('data-to');
    var present_id = $(object).attr('data-present-id');
    var message = $('#buypresentform-message').val();

    $.ajax({
        url: '/present/gift',
        type: 'POST',
        data: 'from='+from+'&to='+to+'&present_id='+present_id+'&message='+message,
        datatype:'json',
        success: function (data) {
            $('.present-form').html(data);
        },

    });

}

function send_photo_to_user(){

    var formData = new FormData($("#send-message-photo-form")[0]);

    var action = $('#send-message-photo-form').attr('data-action')

    $.ajax({
        url: '/chat/send/send-photo',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {

        },
        success: function (data) {

            var result = JSON.parse(data);

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
function add_to_black(object){

    var id = $(object).attr('data-user-id');
console.log(id);
    $.ajax({
        url: '/black/add',
        type: 'POST',
        data: 'user_id='+id,
        datatype:'json',
        success: function (data) {
            $(object).html('ok');
        },

    });

}
function restart(){
    $.ajax({
        url: '/restart',
        type: 'POST',
        // async: false,
        beforeSend: function() {

        },
        success: function (data) {


        },
    });
}

function get_post_gallery_modal(object){

    var id = $(object).attr('data-id');
    var chat_id = $(object).attr('data-chat-id');

    $.ajax({
        url: '/chat/photo/get-gallery',
        data: 'id='+id+'&chat_id='+chat_id,
        type: 'POST',
        success: function (data) {
            $('#modal-photo .modal-body').html(data);
            $('#modal-photo').modal();
        },
    });

}

function send_photo_from_gallery(object){

    var chat_id = $(object).attr('data-chat-id');
    var img_id = $(object).attr('data-img-id');
    var from = $(object).attr('data-from');

    $.ajax({
        url: '/chat/photo/send',
        data: 'chat_id='+chat_id+'&img_id='+img_id+'&from='+from,
        type: 'POST',
        success: function (data) {

            var result = JSON.parse(data);

            var user_img = $('.user-img').attr('srcset');
            var user_name = $('.message-send-btn').attr('data-name');
            var user_id = $('.message-send-btn').attr('data-user-id');

            add_present(result.img, user_img, user_name, user_id );

        },
    });

}

function add_present(presentImg, userImg, name, id, message = '', className = 'right-message') {

    $('.chat').prepend(
        '<div class="wall-tem ' + className + '">\n' +
        '    <div class="post_header">\n' +
        '        <a class="post_image" href="/user/' + id + '">\n' +
        '            <img loading="lazy" class="img"\n' +
        '                 srcset="' + userImg + '" alt="">\n' +
        '        </a>\n' +
        '        <div class="post_header_info">\n' +
        '            <a href="/user/' + id + '" class="author">\n' +
        '                ' + name + ' </a>\n' +
        '            <span class="post_date"><span class="post_link"><span class="rel_date">Только что</span></span></span>\n' +
        '            <div class="post-text">\n' +
        '                <p>' + message + '</p><img src="' + presentImg + '" alt="">\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div style="clear: both">\n' +
        '    </div>\n' +
        '</div>');

}