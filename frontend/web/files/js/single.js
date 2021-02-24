$(document).ready(function() {

    var singleGallery = $('.owl-carousel-main');
    singleGallery.lightGallery();

    singleGallery.owlCarousel({
        items: 1,
        margin: 16,
        loop: true,
        nav: true,
        navText: ['', ''],
        navElement: 'a></a',
    });



});

$(document).ready(function() {

    $('#under-avatar-form-input').on('change', function(){

        var formData = new FormData($("#under-avatar-form")[0]);
        $.ajax({
            url: '/user/photo/add',
            type: 'POST',
            data: formData,
            datatype:'json',
            // async: false,
            beforeSend: function() {
                $('#under-avatar-form .form-text').css('display', 'none');
            },
            success: function (data) {

                $('#under-avatar-form .form-info p').text('Фото загружено');
                $('.post-photo img').attr('srcset', data);
                $('.img-label .main-img').attr('srcset', data);
                $('.post-photo source').attr('srcset', data);
                $('#under-avatar-form .form-info').css('display', 'block');
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

    if($('.anket').length > 0){

        var id = $('.anket').attr('data-id');

        $.ajax({
            url: '/user/get-online',
            type: 'POST',
            data: 'id='+id,
            success: function (data) {

                $('.single-photo-block-'+id+' .online-single').remove();
                $('.single-photo-block-'+id).append(data);

            },
        });

    }

});

function send_wall_item(){

    var formData = new FormData($("#wall-form")[0]);
    $.ajax({
        url: '/wall/add',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $('#w0 .form-text').css('display', 'none');
        },
        success: function (data) {
            $('.wall-wrapper').prepend(data);
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

$(document).ready(function() {

    $('.profile_more_info_link ').on('click', function(e){
        $('.profile_label_more ').toggle();
        $('.profile_label_less ').toggle();
        $('.profile-full-wrap').toggle();
    });

});

$(document).ready(function() {

    if ($(".isGuest").length > 0){

        var target = $('.pager');
        var targetPos = target.offset().top;
        var winHeight = $(window).height();
        var scrollToElem = targetPos - winHeight;

        var winScrollTop = $(this).scrollTop();

        var page = $(target).attr('data-page');

        var url = $(target).attr('data-url');
        var request = $(target).attr('data-reqest');

        var accept = $(target).attr('data-accept');

        changeURL();

        if (winScrollTop > (scrollToElem - 100)) {

            var ids = '';

            if ($(".anket-single-page").length > 0){

                var pol_id = $('.anket-single-page').attr('data-pol');

                $('.anket-single-page').each(function() {

                    ids = ids  + $(this).attr('data-id')+',';

                });

                ids = 'id='+ids;

                var send_data = ids + '&pol='+pol_id;

                url = '/user/more';

                console.log(url);

            } else {

                var send_data = 'page=' + page + '&req=' + request;

            }

            $.ajax({
                type: 'POST',
                url: '' + url,
                data: send_data,
                async: false,
                dataType: "html",
                headers: {
                    "Accept": accept,
                },
                cache: false,
                success: function (data) {

                    if (data !== '') {

                        $('.content').append(data);

                        page = $(target).attr('data-page', Number(page) + 1);

                        var singleGallery = $('.owl-carousel-main');
                        singleGallery.lightGallery();

                        singleGallery.owlCarousel({
                            items: 1,
                            margin: 16,
                            loop: true,
                            nav: true,
                            navText: ['', ''],
                            navElement: 'a></a',
                        });

                    } else {

                        $(target).remove();
                        $('.dots').remove();

                    }

                }
            })
        }

    }

});

function addToFriends(object){

    var id = $(object).attr('data-id');
    var message = $(object).attr('data-message');

    if(message != ''){
        $(object).children().children().text(message);
        return false;
    }

    $.ajax({
        url: '/user/friends/add',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).children().children().text(data);
            $(object).attr('data-message', data);
            $(object).children('.profile_gift_text').html(data);
        },
    });

}
function deleteWallItem(object){

    var id = $(object).attr('data-id');

    $.ajax({
        url: '/wall/item/delete',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).parent().remove();
        },
    });
}

function close_message_event(object){

    $(object).parent().remove();

    $.ajax({
        url: '/invitation/close',
        type: 'POST',
        success: function () {

            $(object).parent().remove();

        },
    });

}

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

function get_invitation(){

    if($('.message-event').length){

        let fruits = [
            "Привет",
            "Напиши мне, хочу узнать тебя ближе",
            "Привет, как дела",
            "Привет, а у тебя есть чувство юмора?",
            "Приветик котик, как твои делишки?",
            "Как насчет флирта?",
            "Привет, научишь варить пельмени?",
            "Привет! Я пишу книгу о том, чего хотят девушки. Не расскажешь?",
            "Приветик не видно моего хомячка? Не пробегал там у тебя?",
        ];

        var text = fruits[getRandomInt(fruits.length)];

        var image = $('.post-image').attr('srcset');

        $('.message-event .img').attr('srcset', image);

        $('.post-photo ')

        message_sound();

        $('.message-event .message-text').html(text);
        $('.message-event').removeClass('d-none');

    }

}

$(function() {

    setTimeout(get_invitation, 3000);

});

function get_invitation_message_form(){

    $('#invitation-dialog .post-text').html($('.message-event .message-text').html());
    $('#invitation-dialog').modal('toggle');


}

function get_invitation_register_form(){

    $('#modal-in').modal('toggle');

    var profile_id = $('#invitation-dialog .chat-wrap').attr('data-id');
    var inv_message = $('#invitation-dialog .post-text').html();
    var message = $('#invitation-dialog #sendmessageform-text').val();

    if(message.length > 0){

        $.ajax({
            url: '/invitation/set-data',
            data: 'profile_id='+profile_id+'&message='+message+'&inv_message='+inv_message,
            type: 'POST',
            success: function () {



            },
        });

    }

}

function add_invision_message(img, name , message ){

    message_sound();

    $('.chat').prepend('<div class="wall-tem ">\n' +
        '\n' +
        '            <div class="post_header">\n' +
        '\n' +
        '                <span class="post_image">\n' +
        '\n' +
        '                    \n' +
        '                        <img class="img" src="'+img+'" alt="">\n' +
        '                    \n' +
        '                </span>\n' +
        '\n' +
        '                <div class="post_header_info">\n' +
        '\n' +
        '                    <span class="author">\n' +
        '                        '+name+'</span>\n' +
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