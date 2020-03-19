function showPhone(object){

    var phone = $(object);

    $(phone).html($(object).attr('data-phone'));

}
$(document).ready(function() {

    $('.city-search').bind("input", function() {

        var city = this.value;

        $.ajax({
            type: 'POST',
            url: "/city/search", //Путь к обработчику
            data: 'city='+city,
            response: 'text',
            dataType: "html",
            cache: false,
            success: function(data){
                $(".city-wrap").html(data).fadeIn(); //Выводим полученые данные в списке
            }
        })

    });

});