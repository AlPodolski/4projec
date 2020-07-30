$(document).ready(function() {



    var sliderFor1 = $('.slider-items-single');

    sliderFor1.lightGallery();

    console.log($(sliderFor1).slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    })

    );

});
$(document).ready(function() {

    $('#under-avatar-form-input').on('change', function(){
        /*    files = this.files[0];

            var form_data = new FormData();
            form_data.append('file', files);*/


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
                $('.post-photo img').attr('src', data);
                $('.img-label .main-img').attr('src', data);
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
    });

});
$(document).ready(function() {

    $('.profile_more_info_link ').on('click', function(e){
        $('.profile_label_more ').toggle();
        $('.profile_label_less ').toggle();
        $('.profile-full-wrap').toggle();
    });

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