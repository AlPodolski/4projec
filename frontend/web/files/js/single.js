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