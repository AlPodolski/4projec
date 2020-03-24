function showPhone(object) {

    var phone = $(object);

    $(phone).html($(object).attr('data-phone'));

}
$(document).ready(function() {

    var sliderFor = $('.slider-popular');

    sliderFor.slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

});
$(document).ready(function() {

    var sliderFor = $('.banner-item-wrap');

    sliderFor.slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

});
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