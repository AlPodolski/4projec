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
}, 15000); // каждую 10 секунду

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
    console.log(window.chat.readyState );
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

/*

function send_message(object){

    var formData = new FormData($("#message-form")[0]);

    var text = $('#message-form textarea').val();
    var img = $('.user-img').attr('src');
    var name = $(object).attr('data-name');

    $('#message-form textarea').val('');

    var dialog_id = $(object).attr('data-dialog-id');


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

            $('.chat').prepend('<div class="wall-tem">\n' +
                '\n' +
                '            <div class="post_header">\n' +
                '\n' +
                '                <a class="post_image" href="/user/1">\n' +
                '\n' +
                '                    \n' +
                '                        <img class="img" src="'+img+'" alt="">\n' +
                '                    \n' +
                '                </a>\n' +
                '\n' +
                '                <div class="post_header_info">\n' +
                '\n' +
                '                    <a  class="author">\n' +
                '                        '+name+'</a>\n' +
                '                    <span class="post_date"><span class="post_link"><span class="rel_date">Ð¢Ð¾Ð»ÑŒÐºÐ¾ Ñ‡Ñ‚Ð¾</span></span></span>\n' +
                '                    <div class="post-text">\n' +
                '                        '+text+'                    </div>\n' +
                '                </div>\n' +
                '\n' +
                '\n' +
                '            </div>\n' +
                '            <div style="clear: both">\n' +
                '            </div>\n' +
                '\n' +
                '\n' +
                '        </div>');

            $('.chat-wrap').scrollTop($('.chat').height());

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

*/

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
