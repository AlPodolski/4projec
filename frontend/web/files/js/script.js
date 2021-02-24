function showPhone(object) {

    var phone = $(object);

    $(phone).html($(object).attr('data-phone'));

}

function message_sound(){
    var audio = new Audio( '/files/audio/alarm-clock-button-click_z17d0vno.mp3');
    audio.play();
}

function get_all_user_presents(object) {

    var id = $(object).attr('data-id');

    $.ajax({
        url: '/present/get-user-presents',
        'data': 'id=' + id,
        type: 'POST',
        success: function (data) {
            $('#modal-user-present .modal-body').html(data);
            $('#modal-user-present').modal();
        },
    });

}

function subscribe_group(object){

    var id = $(object).attr('data-id');

    $.ajax({
        url: '/group/subscribe',
        data: 'group_id='+id,
        type: 'POST',
        success: function (data) {
            $(object).text(data);
        },
    });

}

function wall_photo_items(){

    $('.wall-tem').each(function(i,elem) {

        if($(this).find( '.files').length ){

            var files = $(this).find( '.files').attr('data-files').split(',');
            console.log(files);

            $(this).find( '.files').imagesGrid({
                images: files
        });
        }



    });

}

$(function() {

    wall_photo_items();

});

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
        data: 'id=' + id + '&action=' + action,
        type: 'POST',
        success: function (data) {
            $('.main-info-anket').html(data);
        },

    });

}

function get_present_form(object) {

    $('.present-form').html('');

    if ($(window).width() > 574) {
        $('#modal-present .modal-content').addClass('row  present-wrap-with-form');
        $('#modal-present .present-modal-content-wrap').addClass('col-6 col-md-8');
        $('#modal-present .present-form').addClass('col-6 col-md-4');
    } else {
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
        data: 'present_id=' + present_id + '&user_id=' + user_id,
        datatype: 'json',
        success: function (data) {
            $('.present-form').html(data);
        },

    });
}

$('#header_form').on('change', function () {
    /*    files = this.files[0];

        var form_data = new FormData();
        form_data.append('file', files);*/


    var formData = new FormData($("#w1")[0]);
    $.ajax({
        url: '/user/photo/add',
        type: 'POST',
        data: formData,
        datatype: 'json',
        // async: false,
        beforeSend: function () {
            $('#w1 .form-text').css('display', 'none');
        },
        success: function (data) {

            $('#w1 .form-info p').text('Фото загружено');
            $('#w1 .main-img').attr('src', data);
            $('.no-photo img').attr('src', data);
            $('#w1 .form-info').css('display', 'block');
        },

        complete: function () {
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

function close_present_form() {

    $('#modal-present .modal-content').removeClass('row  present-wrap-with-form');
    $('#modal-present .present-modal-content-wrap').removeClass('col-6 col-md-8');
    $('#modal-present .present-form').removeClass('col-6 col-md-4');
    $('#modal-present .present-modal-content-wrap').removeClass('d-none');

    $('.present-form').addClass('d-none');

}

function get_foto_ryad_form() {

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

function get_presents(object) {

    $.ajax({
        url: '/present/get-presents',
        type: 'POST',
        datatype: 'json',
        success: function (data) {

            $('#modal-present .modal-body').html(data);
            $('#modal-present .present-item').attr('data-user-id', $(object).attr('data-user-id'));
            $('#modal-present').modal()

        },

    });
}

function check_friend_request(object) {
    var id = $(object).attr('data-user-id');
    $.ajax({
        url: '/user/friends/check',
        type: 'POST',
        data: 'id=' + id,
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
        data: 'id=' + id,
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
        data: 'id=' + id,
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
        data: 'id=' + id,
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
        data: 'id=' + id,
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
        datatype: 'json',
        // async: false,
        beforeSend: function () {
            $('#w0 .form-text').css('display', 'none');
        },
        success: function (data) {

            $('#message-form').append('<p class="alert alert-success">Сообщение отправлено</p>');

        },

        complete: function () {
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
        datatype: 'json',
        // async: false,
        beforeSend: function () {
            $('#w0 .form-text').css('display', 'none');
        },
        success: function (data) {

            $(".main-info-anket").html(data);

            $(object).closest('.sympathy-settings-form-wrap').toggleClass('d-none');

        },

        complete: function () {
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

    if (object)

        $.ajax({
            url: '/feedback',
            type: 'POST',
            data: formData,
            datatype: 'json',
            // async: false,
            beforeSend: function () {
                $('#w0 .form-text').css('display', 'none');
            },
            success: function (data) {
                $('#feedback-form').html('<p class="alert alert-success">Сообщение отправлено</p>');
            },
            complete: function () {
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

function register_slick() {

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

$(document).ready(function () {
    if ($(window).width() < 1200) {

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

        script.onload = function () {
            register_slick();
            $('.popular-block-mobile').css('display', 'block');
            $('.main-banner-wrap-mobile').css('display', 'block');
        };

    }
})

function delete_dialog(object){

    var id  = $(object).attr('data-id');

    $.ajax({
        url: '/chat/delete',
        data: 'id='+id,
        type: 'POST',
        success: function () {
            $(object).closest('.dialog_item').remove();
        },
    });

}

$(document).ready(function () {

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

    $('.open-filter').click(function () {
        $('.sidebar-wrap').toggle(100);
    });

    $('.mobile-icon').click(function () {

        if($('.mobile-icon').hasClass('icon-close')){
            $('.mobile-icon').removeClass('icon-close');
            $('.mobile-icon').css('display', 'block');
            $('body').css('overflow', 'inherit');
            $('.mobile-menu').animate({

                left: '-285px'
            }, 200);

            $('body').animate({

                left: '0px'

            }, 200);
        }else{
            $('.mobile-icon').addClass('icon-close');
            $('.mobile-menu').animate({
                left: '0px'
            }, 200);

            $('body').css('overflow', 'hidden');

            $('body').animate({

                left: '0'

            }, 200);
        }


    });

});

function addToFriendsListing(object) {

    var id = $(object).attr('data-id');
    var message = $(object).attr('data-message');

    if (message != '') {
        $(object).children().children().text(message);
        return false;
    }

    $.ajax({
        url: '/user/friends/add',
        type: 'POST',
        data: 'id=' + id,
        success: function (data) {
            $(object).attr('data-message', data);
            $(object).html('<i class="fas fa-check"></i>');
        },
    });

}

$(function () {
    $('.user-manu').on('click', function (e) {
        $('.user-menu-list').toggle('slow')
    });
});

$(window).scroll(function () {

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

                    wall_photo_items();

                    if ($(".anket-single-page").length > 0){

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

                    }

                } else {

                    $(target).remove();
                    $('.dots').remove();

                }

            }
        })
    }
});

function send_comment(object) {

    var formData = new FormData($(".form-wall-comment-" + $(object).attr('data-id'))[0]);

    var id = $(object).attr('data-id');

    $.ajax({
        url: '/comment',
        type: 'POST',
        data: formData,
        datatype: 'json',
        // async: false,
        beforeSend: function () {
            $('#w0 .form-text').css('display', 'none');
        },
        success: function (data) {
            $(object).closest('.comment-wall-form').siblings('.comments-list').append(data);
        },

        complete: function () {
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

$(function () {

    window.chat.onopen = function (e) {
        $('#response').text("Connection established! Please, set your username.");
    };
    $('#btnSend').click(function () {
        if ($('#message').val()) {

            window.chat.send(JSON.stringify({'action': 'chat', 'message': $('#message').val()}));
        } else {
            alert('Enter the message')
        }
    })

    $('#btnSetUsername').click(function () {
        if ($('#username').val()) {
            window.chat.send(JSON.stringify({'action': 'setName', 'name': $('#username').val()}));
        } else {
            alert('Enter username')
        }
    })

})

function get_gift_vip_modal(object){

    var id = $(object).attr('data-id');
    var img = $(object).attr('data-img');

    $('#modal-gift-vip .gift-user-img img').attr('src' , img);
    $('#modal-gift-vip #giftvipstatusform-touser').val(id);

    $('#modal-gift-vip').modal('toggle');
}

function getFeedBackForm(){

    $.ajax({
        url: '/get-feed-back-form',
        type: 'POST',
        success: function (data) {
            $('#modal-feed-back .modal-body').html(data);
            $('#modal-feed-back ').modal('toggle');
        },
    });

}

function by_vip_for_photo(){

    $('#modal-buy-vip-for-photo').modal('toggle');

}



var changeURL = debounce(function() {
    $('[data-adress]').each(function() {
        if (inView($(this))) {

            if(window.location.pathname != $(this).attr('data-adress')){

                window.history.pushState('', document.title, $(this).attr('data-adress'));

                console.log(window.location.pathname);

                yaCounter57612607.hit($(this).attr('data-adress'));

            }
        }
    });
}, 1);

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

function inView($elem) {
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

$(function () {

    $('.mobile-close-menu').click(function () {
        $('.sidebar-wrap').hide(100);
    })

})

function toggle_women_block(){
    $('.women-block').toggleClass('d-none');
    $('.close-toggle-block').toggleClass('d-none');
    $('#men-block-btn').toggleClass('d-none');
}
function toggle_men_block(){
    $('#women-block-btn').toggleClass('d-none');
    $('.men-block').toggleClass('d-none');
    $('.close-toggle-block').toggleClass('d-none');
}

$( ".close-toggle-block" ).click(function() {

    if(!$( ".women-block" ).hasClass( "d-none" )){

        toggle_women_block();

    }
    if(!$( ".men-block" ).hasClass( "d-none" )){

        toggle_men_block();

    }

    $('.close-toggle-block').addClass('d-none');

});
