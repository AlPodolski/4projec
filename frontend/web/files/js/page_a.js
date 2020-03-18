$(window).scroll(function(){

    var target = $('.pager');
    var targetPos = target.offset().top;
    var winHeight = $(window).height();
    var scrollToElem = targetPos - winHeight;

    var winScrollTop = $(this).scrollTop();

    var page = $(target).attr('data-page');

    var url = $(target).attr('data-url');
    var request = $(target).attr('data-reqest');

    if(winScrollTop > scrollToElem){

        console.log(url)

        $.ajax({
            type: 'POST',
            url: ''+url,
            data: 'page='+page+'&req='+request,
            async:false,
            dataType: "html",
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