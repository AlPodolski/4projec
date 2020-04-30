<?php /* @var $post Profile */

use frontend\modules\user\models\Profile;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\FriendsRequestHelper;
?>


<div class="col-12 col-sm-6 col-md-4 col-lg-4">

    <div class="article-anket-wrap">

        <div class="img-wrap">

            <a href="/user/<?php echo $post->id ?>">

                <?php if (isset($post->userAvatarRelations['file']) and file_exists(Yii::getAlias('@webroot') . $post->userAvatarRelations['file']) and $post->userAvatarRelations['file']) : ?>

                    <?= Yii::$app->imageCache->thumb($post->userAvatarRelations['file'], 'listing', ['class' => 'img']) ?>

                <?php else : ?>

                    <img src="/files/img/nophoto.png" alt="">

                <?php endif; ?>
            </a>
        </div>
        <div class="name">
            <?php echo explode(' ', $post->username)[0]; ?>
            <?php if ($post->birthday) { ?>
                <span class="old">
                   <?php echo \frontend\components\YearHelper::Year((time() - $post->birthday) / 31556926); ?>
                </span>
            <?php } ?>
        </div>

        <div class="like-wrap">
            <div class="row">
                <div class="col-9 message-col">
                    <div class="message-wrap">
                        <div class="message write-message"  onclick="get_message_form(this)" data-user-id="<?php echo $post->id ?>">
                            Написать
                        </div>

                        <?php
                        /*если пользователь не в друзьях и не отправлял заявку в друзья добавляем возможность добавление в друзья*/
                            if (Yii::$app->user->isGuest or
                                (!FriendsHelper::isFiends(Yii::$app->user->id, $post->id)
                                    and !$isFriendsRequestFrom = FriendsRequestHelper::isFiendsRequest($post->id, Yii::$app->user->id)
                                    and !$isFriendsRequestTo = FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id, $post->id))) {
                                $onclick = 'onclick="addToFriendsListing(this)"';
                            } else {
                                $onclick = '';
                            }
                        ?>

                        <div data-id="<?php echo $post->id ?>" class="add-to-friends-listing message"
                             data-message="<?php if (Yii::$app->user->isGuest) echo 'Требуется авторизация' ?>"
                             <?php echo $onclick ?>>
                            <?php if (!Yii::$app->user->isGuest and FriendsHelper::isFiends(Yii::$app->user->id, $post->id) ) : ?>
                                <span class="show-message" data-message="Ваш друг">
                                     <i class="fas fa-user-friends"></i>
                                </span>
                            <?php elseif (!Yii::$app->user->isGuest and isset($isFriendsRequestTo) and $isFriendsRequestTo) : ?>
                            <span class="show-message" data-message="Заявка отправлена">
                                <i class="fas fa-check"></i>
                            </span>
                            <?php elseif (!Yii::$app->user->isGuest and $isFriendsRequestFrom) : ?>
                                <span class="show-message" data-message="Принять заявку" onclick="check_friend_request_listing(this)" data-user-id="<?php echo $post->id ?>">
                                    <i class="fas fa-user-check"></i>
                                </span>
                            <?php else : ?>
                                <i class="fas fa-plus"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-3" >
                    <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

        </div>

    </div>
</div>