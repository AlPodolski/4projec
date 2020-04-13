<?php

use frontend\widgets\SidebarWidget;

/* @var $this \yii\web\View */
/* @var $userFriends array */
/* @var $city string */
/* @var $userName array */
/* @var $userFriendsRequest array */
/* @var $countFriendsRequest integer */

$this->title = 'Друзья пользователя ' . $userName['username'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Друзья пользователя ' . $userName['username'],
]);

?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <?php

    echo SidebarWidget::Widget() ?>

    <div class="col-12 col-xl-9 page-block friends-list">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all-friends"
                   role="tab" aria-controls="nav-home" aria-selected="true">Все друзья</a>
                <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id'] and $userFriendsRequest) : ?>
                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-friends-request"
                       role="tab" aria-controls="nav-home" aria-selected="true">Заявки в друзья <?php if ($countFriendsRequest > 0) echo '+'. $countFriendsRequest ?></a>
                <?php endif; ?>
            </div>
        </nav>
        <br>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-all-friends" role="tabpanel" aria-labelledby="nav-home-tab">

                <?php if ($userFriends) : ?>

                    <?php foreach ($userFriends as $userFriend) : ?>

                        <div class="friends_user_row clear_fix">

                            <div class="friends_photo_wrap ui_zoom_wrap">
                                <a href="/user/<?php echo $userFriend['friendsProfiles']['id']; ?>">
                                    <?php if (file_exists(Yii::getAlias('@webroot') . $userFriend['friendsProfiles']['avatarRelation']['file']) and $userFriend['friendsProfiles']['avatarRelation']['file']) : ?>

                                        <?= Yii::$app->imageCache->thumb($userFriend['friendsProfiles']['avatarRelation']['file'], '80', ['class' => 'friends_photo_img']) ?>

                                    <?php else : ?>

                                        <img class="friends_photo_img" src="/files/img/nophoto.png" alt="">

                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="friends_user_info">
                                <div class="friends_field friends_field_title">
                                    <a href="/user/<?php echo $userFriend['friendsProfiles']['id']; ?>">
                                        <?php echo $userFriend['friendsProfiles']['username']; ?>
                                    </a>
                                </div>
                                <a onclick="get_message_form(this)"
                                   data-user-id="<?php echo $userFriend['friendsProfiles']['id'] ?>"
                                   class="friends_field_act small-heading">Написать сообщение</a>
                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else : ?>
                    <p class="alert alert-info">Нет друзей</p>
                <?php endif; ?>

            </div>

            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>

                <div class="tab-pane fade show " id="nav-friends-request" role="tabpanel" aria-labelledby="nav-home-tab" >

            <?php if ($userFriendsRequest) : ?>

                <?php foreach ($userFriendsRequest as $userFriendsRequestItem) : ?>

                    <div class="friends_user_row clear_fix">

                        <div class="friends_photo_wrap ui_zoom_wrap">
                            <a href="/user/<?php echo $userFriendsRequestItem['friendsProfiles']['id']; ?>">
                                <?php if (file_exists(Yii::getAlias('@webroot') . $userFriendsRequestItem['friendsProfiles']['avatarRelation']['file']) and $userFriendsRequestItem['friendsProfiles']['avatarRelation']['file']) : ?>

                                    <?= Yii::$app->imageCache->thumb($userFriendsRequestItem['friendsProfiles']['avatarRelation']['file'], '80', ['class' => 'friends_photo_img']) ?>

                                <?php else : ?>

                                    <img class="friends_photo_img" src="/files/img/nophoto.png" alt="">

                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="friends_user_info">
                            <div class="friends_field friends_field_title">
                                <a href="/user/<?php echo $userFriendsRequestItem['friendsProfiles']['id']; ?>">
                                    <?php echo $userFriendsRequestItem['friendsProfiles']['username']; ?>
                                </a>
                            </div>
                            <a onclick="get_message_form(this)"
                               data-user-id="<?php echo $userFriendsRequestItem['friendsProfiles']['id'] ?>"
                               class="friends_field_act small-heading">Написать сообщение</a>
                            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>
                                <a onclick="check_friend_request(this)"
                                   data-user-id="<?php echo $userFriendsRequestItem['friendsProfiles']['id'] ?>"
                                   class="friends_field_act small-heading">Принять заявку</a>
                            <?php endif; ?>
                        </div>

                    </div>

                <?php endforeach; ?>


            <?php else : ?>
                <p class="alert alert-info">Нет заявок</p>

                </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>

    </div>

</div>