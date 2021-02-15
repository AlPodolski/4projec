function set_main(object){

    var photo_id  = $(object).attr('data-photo-id');
    var user_id   = $(object).attr('data-user-id');

    $.ajax({
        url: '/photo/set-main',
        data: 'photo_id='+photo_id+'&user_id='+user_id,
        type: 'POST',
        success: function () {


            $( ".main-photo" ).each(function() {
                $(this).html('Сделать главной');
            });

            $(object).html('Главное фото');
        },
    });

}
function hide_photo(object){

    var photo_id  = $(object).attr('data-photo-id');

    $.ajax({
        url: '/photo/hide',
        data: 'photo_id='+photo_id,
        type: 'POST',
        success: function () {
            $(object).html('Фото скрыто');
        },
    });

}
function show_photo(object){

    var photo_id  = $(object).attr('data-photo-id');

    $.ajax({
        url: '/photo/show',
        data: 'photo_id='+photo_id,
        type: 'POST',
        success: function () {
            $(object).html('Фото Открыто');
        },
    });

}