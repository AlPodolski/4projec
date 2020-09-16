<?php

/* @var $message string */
/* @var $img string */
/* @var $name string */

?>
<div class="modal fade" id="invitation-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 15.75L15.75 2.25" stroke="black" stroke-width="2"/>
                                <path d="M2.25 2.25L15.75 15.75" stroke="black" stroke-width="2"/>
                            </svg>
                        </span>
                </button>
            </div>
            <div class="modal-body modal-city-search">
                <div class="page-block chat-block " >
                    <div class="chat-wrap-overlow overflow-hidden">
                        <div class="chat-wrap " data-img="<?php echo $img ?>" data-name="<?php echo $name ?>">
                            <div class="chat ">
                                <div class="wall-tem first-message">
                                    <div class="post_header">
                                        <a class="post_image">
                                            <?php echo \frontend\widgets\PhotoWidget::widget([
                                                'path' => $img,
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => '',
                                                ],
                                            ]); ?>
                                        </a>
                                        <div class="post_header_info">
                                            <span class="author"><?php echo $name ?> </span>
                                            <div class="post-text">
                                                <?php echo $message ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-wall-form page-block comment-wall-form-">
                    <form id="send-message-photo-form" class="form-horizontal">
                        <div class="img-label-wrap send-message-photo">
                            <label data-toggle="modal" data-target="#modal-in" aria-hidden="true">
                                <i class="fas fa-camera"></i>
                            </label>
                        </div>
                    </form>
                    <form id="message-form" class="form-horizontal" action="#" method="post">

                        <div class="show-message"  data-toggle="modal" data-target="#modal-in" aria-hidden="true" data-message="Отправить подарок">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"></path>
                                <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"></path>
                                <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"></path>
                                <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="form-otvet field-sendmessageform-text">
                            <textarea id="sendmessageform-text" class="form-control" name="SendMessageForm[text]" placeholder="Напишите что то"></textarea>
                            <div class="help-block"></div>
                        </div>

                        <span data-toggle="modal" data-target="#modal-in" aria-hidden="true" class="message-send-btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF"></path>
                            </svg>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

