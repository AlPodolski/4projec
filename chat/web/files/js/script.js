function showPhone(object) {

    var phone = $(object);

    $(phone).html($(object).attr('data-phone'));

}

function get_sympathy_settings_form(object) {

    $('.sympathy-settings-form-wrap').toggleClass('d-none');

    $.ajax({
        url: '/user/sympathy/get-settings',
        type: 'POST',
        success: function (data) {
            $('.sympathy-settings-form-wrap').html(data);
        },

    });
}

function add_sympathy(object) {

    var id = $(object).attr('data-id');
    var action = $(object).attr('data-action');

    $.ajax({
        url: '/user/sympathy/add',
        data: 'id='+id+'&action='+action,
        type: 'POST',
        success: function (data) {
            $('.main-info-anket').html(data);
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

    $.ajax({
        url: '/present/get-form',
        type: 'POST',
        data: 'present_id='+present_id+'&user_id='+user_id,
        datatype:'json',
        success: function (data) {
            $('.present-form').html(data);
        },

    });
}

$('#header_form').on('change', function(){
    /*    files = this.files[0];

        var form_data = new FormData();
        form_data.append('file', files);*/


    var formData = new FormData($("#w1")[0]);
    $.ajax({
        url: '/user/photo/add',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $('#w1 .form-text').css('display', 'none');
        },
        success: function (data) {

            $('#w1 .form-info p').text('Фото загружено');
            $('#w1 .main-img').attr('src', data);
            $('.no-photo img').attr('src', data);
            $('#w1 .form-info').css('display', 'block');
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

function close_present_form(){

    $('#modal-present .modal-content').removeClass('row  present-wrap-with-form');
    $('#modal-present .present-modal-content-wrap').removeClass('col-6 col-md-8');
    $('#modal-present .present-form').removeClass('col-6 col-md-4');
    $('#modal-present .present-modal-content-wrap').removeClass('d-none');

    $('.present-form').addClass('d-none');

}

function get_foto_ryad_form(){

    $.ajax({
        url: '/photo-row/get-form',
        type: 'POST',
        success: function (data) {
            $('#foto-ryad-in .modal-body').html(data);
            $('#foto-ryad-in').modal();
        },
    });

    $('#foto-ryad-in').modal();

}

function get_presents(object){

    $.ajax({
        url: '/present/get-presents',
        type: 'POST',
        datatype:'json',
        success: function (data) {

            $('#modal-present .modal-body').html(data);
            $('#modal-present .present-item').attr('data-user-id', $(object).attr('data-user-id'));
            $('#modal-present').modal()

        },

    });
}

function send_message(object){
    var formData = new FormData($("#message-form")[0]);

    var text = $('#message-form textarea').val();
    var img = $('.user-img').attr('src');
    var name = $(object).attr('data-name');

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
                '                    <span class="post_date"><span class="post_link"><span class="rel_date">Только что</span></span></span>\n' +
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
function get_message_form(object) {



    var id = $(object).attr('data-user-id');

    $.ajax({
        url: '/user/chat/get',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $('#messageModal .modal-body').html(data);
            $('#messageModal').modal('show');
        },
    });

    $('.user-id-class .form-control').val($(object).attr('data-user-id'));

    $('#message-form .alert-success').remove();


}
function check_friend_request(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/check',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).text(data);
        },
    });
}

function check_friend_request_listing(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/check',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).html('<i class="fas fa-user-friends"></i>');
            $(object).attr('data-message', 'Заявка принята');
        },
    });
}

function remove_friend_request(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/request/remove',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).closest('.friends_user_row').remove();
        },
    });
}

function remove_friend(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/remove',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).closest('.friends_user_row').remove();
        },
    });
}
function remove_send_friend_request(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/request/remove-send',
        type: 'POST',
        data: 'id='+id,
        success: function (data) {
            $(object).closest('.friends_user_row').remove();
        },
    });
}
function send_message_form(object) {


        var formData = new FormData($("#message-form")[0]);

        var text = $('#message-form textarea').val();
        var img = $('.user-img').attr('src');
        var name = $(this).attr('data-name');


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

                $('#message-form').append('<p class="alert alert-success">Сообщение отправлено</p>');

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
function set_sympathy_settings(object) {

        var formData = new FormData($(object).closest("#sympathy-settings-form")[0]);

        $(".result-text").html('');

    $.ajax({
            url: '/user/sympathy/set-settings',
            type: 'POST',
            data: formData,
            datatype:'json',
            // async: false,
            beforeSend: function() {
                $('#w0 .form-text').css('display', 'none');
            },
            success: function (data) {

                $(".main-info-anket").html(data);

                $(object).closest('.sympathy-settings-form-wrap').toggleClass('d-none');

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

function send_feedback(object) {

        var formData = new FormData($("#feedback-form")[0]);

        if(object)

        $.ajax({
            url: '/feedback',
            type: 'POST',
            data: formData,
            datatype:'json',
            // async: false,
            beforeSend: function() {
                $('#w0 .form-text').css('display', 'none');
            },
            success: function (data) {
                $('#feedback-form').html('<p class="alert alert-success">Сообщение отправлено</p>');
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
function register_slick(){

    console.log(123);

    var sliderFor = $('.slider-popular');

    sliderFor.slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 430,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
        ]
    });

    var sliderFor = $('.banner-item-wrap');

    sliderFor.slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

}

$( document ).ready( function() {
    if($(window).width() < 1200){

/*
        $( "head" ).append( "<link rel='stylesheet' href='/files/slick/slick-theme.css'>" );
        $( "head" ).append( "<link rel='stylesheet' href='/files/slick/slick.css'>" );

        $( "head" ).append( "<link rel='preload' href='/files/slick/slick-theme.css' as='style'>" );
        $( "head" ).append( "<link rel='preload' href='/files/slick/slick.css' as='style'>" );
        $( "head" ).append( "<link rel='preload' href='/files/slick/fonts/slick.woff' as='font'>" );
*/

        let script = document.createElement('script');

        // мы можем загрузить любой скрипт с любого домена
        script.src = "/files/slick/slick.min.js"

        document.head.append(script);

        script.onload = function() {
            register_slick();
            $('.popular-block-mobile').css('display', 'block');
            $('.main-banner-wrap-mobile').css('display', 'block');
        };

    }
})

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
function addToFriendsListing(object){

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
            $(object).attr('data-message', data);
            $(object).html('<i class="fas fa-check"></i>');
        },
    });

}
$(function(){
    $('.user-manu').on('click', function(e){
        $('.user-menu-list').toggle('slow')
    });
});
$(window).scroll(function(){

    var target = $('.pager');
    var targetPos = target.offset().top;
    var winHeight = $(window).height();
    var scrollToElem = targetPos - winHeight;

    var winScrollTop = $(this).scrollTop();

    var page = $(target).attr('data-page');

    var url = $(target).attr('data-url');
    var request = $(target).attr('data-reqest');

    var accept = $(target).attr('data-accept');

    if(winScrollTop > scrollToElem){

        console.log(url)

        $.ajax({
            type: 'POST',
            url: ''+url,
            data: 'page='+page+'&req='+request,
            async:false,
            dataType: "html",
            headers: {
                "Accept": accept ,
            },
            cache: false,
            success: function (data){

                if(data !== ''){

                    $('.content').append(data);

                    page = $(target).attr('data-page', Number(page) + 1 );

                }else{

                    $(target).remove();

                }

            }
        })
    }
});