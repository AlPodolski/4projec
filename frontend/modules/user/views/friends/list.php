<?php

use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;

/* @var $this \yii\web\View */
/* @var $userFriends array */
/* @var $city string */
/* @var $userName array */
/* @var $userFriendsRequest array */
/* @var $countFriendsRequest integer */
/* @var $countUserSendFriendsRequest integer */
/* @var $sendUserFriendsRequest array */

$this->title = 'Друзья пользователя ' . $userName['username'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Друзья пользователя ' . $userName['username'],
]);

?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget()?>

        <?php endif; ?>

        <?php
            echo SidebarWidget::Widget()
        ?>
    </div>

    <div class="col-12 back-link-left ">

        <div class="right-column-anket page-block friends-list clear_fix">

            <div class=" ui_zoom_wrap">
                <a class="post_image" href="/user/<?php echo $userName['id']; ?>">
                    <?php if (isset ($userName['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $userName['userAvatarRelations']['file']) and $userName['userAvatarRelations']['file']) : ?>

                        <?= Yii::$app->imageCache->thumb($userName['userAvatarRelations']['file'], 'dialog', ['class' => 'img']) ?>

                    <?php else : ?>

                        <img class="img" src="/files/img/nophoto.png" alt="">

                    <?php endif; ?>
                </a>
            </div>

            <div class="friends_user_info">
                <div class="friends_field friends_field_title">
                    <a href="/user/<?php echo $userName['id']; ?>">
                        <?php echo $userName['username']; ?>
                    </a>
                </div>
                <a href="/user/<?php echo $userName['id']; ?>"
                   class="friends_field_act small-heading">Назад на странцу</a>
            </div>

        </div>

    </div>

    <div class="col-sm-pull-12 col-xl-6 ">

        <div class="page-block friends-list">
            <div class="row">
                <div class="col-8"><nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all-friends"
                               role="tab" aria-controls="nav-home" aria-selected="true">Все друзья</a>

                            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id'] and $userFriendsRequest) : ?>
                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-friends-request"
                                   role="tab" aria-controls="nav-home" aria-selected="true">Заявки в
                                    друзья <?php if ($countFriendsRequest > 0) echo '+' . $countFriendsRequest ?></a>
                            <?php endif; ?>

                            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id'] and $sendUserFriendsRequest) : ?>
                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-friends-send-request"
                                   role="tab" aria-controls="nav-home" aria-selected="true">Исходящие
                                    заявки <?php if ($countUserSendFriendsRequest > 0) echo '+' . $countUserSendFriendsRequest ?></a>
                            <?php endif; ?>

                        </div>
                    </nav>
                </div>
            </div>
            <br>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-all-friends" role="tabpanel" aria-labelledby="nav-home-tab">

                    <?php if ($userFriends) : ?>

                        <?php foreach ($userFriends as $userFriend) : ?>

                            <div class="friends_user_row clear_fix">

                                <div class="friends_photo_wrap ui_zoom_wrap">
                                    <a href="/user/<?php echo $userFriend['id']; ?>">
                                        <?php if (file_exists(Yii::getAlias('@webroot') . $userFriend['userAvatarRelations']['file']) and $userFriend['userAvatarRelations']['file']) : ?>

                                            <?= Yii::$app->imageCache->thumb($userFriend['userAvatarRelations']['file'], '80', ['class' => 'friends_photo_img']) ?>

                                        <?php else : ?>

                                            <img class="friends_photo_img" src="/files/img/nophoto.png" alt="">

                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="friends_user_info">
                                    <div class="friends_field friends_field_title">
                                        <a href="/user/<?php echo $userFriend['id']; ?>">
                                            <?php echo $userFriend['username']; ?>
                                        </a>
                                    </div>
                                    <a onclick="get_message_form(this)"
                                       data-user-id="<?php echo $userFriend['id'] ?>"
                                       class="friends_field_act small-heading">Написать сообщение</a>
                                </div>

                                <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>
                                    <span onclick="remove_friend(this)" class="remove-friend-request"
                                          data-user-id="<?php echo $userFriend['id'] ?>">
                                <i class="fas fa-times"></i>
                            </span>
                                <?php endif; ?>

                            </div>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <p class="alert alert-info">Нет друзей</p>
                    <?php endif; ?>

                </div>

                <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>

                    <div class="tab-pane fade show " id="nav-friends-request" role="tabpanel" aria-labelledby="nav-home-tab">

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
                                            <span onclick="remove_friend_request(this)" class="remove-friend-request"
                                                  data-user-id="<?php echo $userFriendsRequestItem['friendsProfiles']['id'] ?>">
                                <i class="fas fa-times"></i>
                            </span>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>


                        <?php else : ?>
                            <p class="alert alert-info">Нет заявок</p>


                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>

                    <div class="tab-pane fade show " id="nav-friends-send-request" role="tabpanel"
                         aria-labelledby="nav-home-tab">

                        <?php if ($sendUserFriendsRequest) : ?>

                            <?php foreach ($sendUserFriendsRequest as $sendUserFriendsRequestItem) : ?>

                                <div class="friends_user_row clear_fix">

                                    <div class="friends_photo_wrap ui_zoom_wrap">
                                        <a href="/user/<?php echo $sendUserFriendsRequestItem['sendFriendsProfiles']['id']; ?>">
                                            <?php if (file_exists(Yii::getAlias('@webroot') . $sendUserFriendsRequestItem['sendFriendsProfiles']['avatarRelation']['file']) and $sendUserFriendsRequestItem['sendFriendsProfiles']['avatarRelation']['file']) : ?>

                                                <?= Yii::$app->imageCache->thumb($sendUserFriendsRequestItem['sendFriendsProfiles']['avatarRelation']['file'], '80', ['class' => 'friends_photo_img']) ?>

                                            <?php else : ?>

                                                <img class="friends_photo_img" src="/files/img/nophoto.png" alt="">

                                            <?php endif; ?>
                                        </a>
                                    </div>

                                    <div class="friends_user_info">
                                        <div class="friends_field friends_field_title">
                                            <a href="/user/<?php echo $sendUserFriendsRequestItem['sendFriendsProfiles']['id']; ?>">
                                                <?php echo $sendUserFriendsRequestItem['sendFriendsProfiles']['username']; ?>
                                            </a>
                                        </div>
                                        <a onclick="get_message_form(this)"
                                           data-user-id="<?php echo $sendUserFriendsRequestItem['sendFriendsProfiles']['id'] ?>"
                                           class="friends_field_act small-heading">Написать сообщение</a>
                                        <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $userName['id']) : ?>
                                            <a onclick="remove_send_friend_request(this)"
                                               data-user-id="<?php echo $sendUserFriendsRequestItem['sendFriendsProfiles']['id'] ?>"
                                               class="friends_field_act small-heading">Удалить заявку</a>
                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>


                        <?php else : ?>
                            <p class="alert alert-info">Нет заявок</p>

                        <?php endif; ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>

    <div class="col-xl-3 col-sm-push-12 back-link back-link-right ">

        <div class="right-column-anket page-block friends-list clear_fix">

            <div class=" ui_zoom_wrap">
                <a class="post_image" href="/user/<?php echo $userName['id']; ?>">
                    <?php if (file_exists(Yii::getAlias('@webroot') . $userName['userAvatarRelations']['file']) and $userName['userAvatarRelations']['file']) : ?>

                        <?= Yii::$app->imageCache->thumb($userName['userAvatarRelations']['file'], 'dialog', ['class' => 'img']) ?>

                    <?php else : ?>

                        <img class="img" src="/files/img/nophoto.png" alt="">

                    <?php endif; ?>
                </a>
            </div>

            <div class="friends_user_info">
                <div class="friends_field friends_field_title">
                    <a href="/user/<?php echo $userName['id']; ?>">
                        <?php echo $userName['username']; ?>
                    </a>
                </div>
                <a href="/user/<?php echo $userName['id']; ?>"
                   class="friends_field_act small-heading">Назад на странцу</a>
            </div>

        </div>

    </div>

</div>