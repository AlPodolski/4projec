$(window).scroll(function(){

    var target = $('.advert-pager');
    var targetPos = target.offset().top;
    var winHeight = $(window).height();
    var scrollToElem = targetPos - winHeight;

    var winScrollTop = $(this).scrollTop();

    var page = $(target).attr('data-page');

    if(winScrollTop > scrollToElem){

        $.ajax({
            type: 'POST',
            url: '/more-adverds',
            data: 'page='+page,
            async:false,
            dataType: "html",
            cache: false,
            success: function (data){

                if(data !== ''){

                    $('.anket').append(data);

                    page = $(target).attr('data-page', Number(page) + 1 );

                }else{

                    $(target).remove();

                }

            }
        })
    }
});