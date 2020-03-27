$(document).ready(function() {

    var sliderFor = $('.slider-for');
    var sliderNav =  $('.slider-nav');

    sliderFor.lightGallery();

    sliderFor.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    sliderNav.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });

});
$(document).ready(function() {

    $('.present-btn ').on('click', function(e){

        var present_id = $(this).attr('data-present-id');
        var user_id = $(this).attr('data-user-id');

        $.ajax({
            url: '/present/get-form',
            type: 'POST',
            data: 'present_id='+present_id+'&user_id='+user_id,
            datatype:'json',
            success: function (data) {
                $('.modal-gift-present').html(data);
            },

        });
    });

});
$(document).ready(function() {

    $('.wall-send-btn').on('click', function(e){

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

                $('#wall-form').html('<p class="alert alert-success">Запись добавлена</p>');
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

});
$(document).ready(function() {

    $('.profile_more_info_link ').on('click', function(e){
        $('.profile_label_more ').toggle();
        $('.profile_label_less ').toggle();
        $('.profile_full ').toggle();
    });

});
$(document).ready(function() {

    $('.open-comment-btn').on('click', function(e){

        $('.comment-wall-form-'+$(this).attr('data-id')).toggleClass('d-none');
    });

});

$(document).ready(function() {

    $('.like-btn').on('click', function(e){

        var id = $(this).attr('data-id');
        var object = $(this);

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
                $(object).children().toggleClass('d-none');
            },
        });

    });

});

$(document).ready(function() {

    $('.send-comment-btn').on('click', function(e){

        var formData = new FormData($(".form-wall-comment-"+$(this).attr('data-id'))[0]);

        var id = $(this).attr('data-id');

        $.ajax({
            url: '/wall/comment',
            type: 'POST',
            data: formData,
            datatype:'json',
            // async: false,
            beforeSend: function() {
                $('#w0 .form-text').css('display', 'none');
            },
            success: function (data) {
                $(".comment-wall-form-"+id).html('<p class="alert alert-success">Запись добавлена</p>');
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

});