<?php

use frontend\widgets\SidebarWidget;

/* @var $this \yii\web\View */
/* @var $userFriends array */
/* @var $city string */
/* @var $userName array */

$this->title = 'Друзья пользователя '.$userName['username'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Друзья пользователя '.$userName['username'],
]);

?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <?php

    echo SidebarWidget::Widget() ?>

    <div class="col-12 col-xl-9 page-block friends-list">

        <?php if($userFriends) : ?>

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
                            <?php echo$userFriend['friendsProfiles']['username']; ?>
                        </a>
                    </div>
                    <a onclick="get_message_form(this)" data-user-id="<?php echo $userFriend['friendsProfiles']['id']?>" class="friends_field_act small-heading">Написать сообщение</a>
                </div>

            </div>

            <?php endforeach; ?>

        <?php else : ?>
        <p class="alert alert-info">Нет друзей</p>
        <?php endif; ?>

    </div>

</div>