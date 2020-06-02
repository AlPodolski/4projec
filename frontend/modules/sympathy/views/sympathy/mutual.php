<?php

/* @var $posts array */
/* @var $likePost integer */
use frontend\widgets\PhotoWidget;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\FriendsRequestHelper;

?>

<div class="row">
    <div class="col-12">
        <div class="no-content-wrap d-flex mutual-block ">
            <div class="row">
                <h1 class="h1 w-100">Ура, это взаимо</h1>
                <div class="w-100 position-relative">

                    <?php foreach ($posts as $post) : ?>

                        <span class="border-radius-50 overflow-hidden">

                        <?php echo PhotoWidget::widget([
                                'path' => $post['userAvatarRelations']['file'],
                                'size' => 'popular',
                                'options' => [
                                        'class' => 'img',
                                        'loading' => 'lazy',
                                        'alt' => $post['username'],
                                ],
                            ]  ); ?>

                        </span>

                    <?php endforeach; ?>

                    <span class="heart-img position-absolute">
                        <img src="/files/img/iconfinder_heart_216238 3.png">
                    </span>

                </div>

                <div class="message-wrap">

                    <div class="message write-message"
                        <?php if (!Yii::$app->user->isGuest and (Yii::$app->user->id != $likePost )) : ?>
                            onclick="get_message_form(this)"
                            data-user-id="<?php echo $likePost ?>"
                        <?php elseif (Yii::$app->user->isGuest) : ?>
                            data-toggle="modal" data-target="#modal-in" aria-hidden="true"
                        <?php endif; ?> >
                        Написать
                    </div>

                    <?php
                    /*если пользователь не в друзьях и не отправлял заявку в друзья добавляем возможность добавление в друзья*/
                    if (Yii::$app->user->isGuest or
                        (!FriendsHelper::isFiends(Yii::$app->user->id, $likePost )
                            and !$isFriendsRequestFrom = FriendsRequestHelper::isFiendsRequest($post['id'] , Yii::$app->user->id)
                            and !$isFriendsRequestTo = FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id, $likePost ))) {
                        $onclick = 'onclick="addToFriendsListing(this)"';
                    } else {
                        $onclick = '';
                    }
                    if (Yii::$app->user->isGuest) {
                        $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                    }
                    ?>

                    <div data-id="<?php echo $likePost  ?>" class="add-to-friends-listing message"
                         data-message="<?php if (Yii::$app->user->isGuest) echo 'Требуется авторизация' ?>"
                        <?php echo $onclick ?>>
                        <?php if (!Yii::$app->user->isGuest and FriendsHelper::isFiends(Yii::$app->user->id, $likePost ) ) : ?>
                            <span class="show-message" data-message="Ваш друг">
                                                         <i class="fas fa-user-friends"></i>
                                                    </span>
                        <?php elseif (!Yii::$app->user->isGuest and isset($isFriendsRequestTo) and $isFriendsRequestTo) : ?>
                            <span class="show-message" data-message="Заявка отправлена">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                        <?php elseif (!Yii::$app->user->isGuest and $isFriendsRequestFrom) : ?>
                            <span class="show-message" data-message="Принять заявку" onclick="check_friend_request_listing(this)" data-user-id="<?php echo $likePost  ?>">
                                                        <i class="fas fa-user-check"></i>
                                                    </span>
                        <?php else : ?>
                            <span class="show-message" data-message="Добавить в друзья" >
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                        <?php endif; ?>
                    </div>

                    <div class="col-4 col-md-3 col-lg-3" onclick="get_presents(this)" data-user-id="<?php echo $likePost ?>">
                        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                </div>

                <div class="col-12">
                    <br>
                    <div class="like-wrap" onclick="add_sympathy(this)" data-id="<?php echo $likePost ?>">
                        <div class="like blue-btn">
                            Продолжить поиск симпатий
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>