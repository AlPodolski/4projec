$(document).ready(function() {

    $('.message-send-btn').on('click', function(e){

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