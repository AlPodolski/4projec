<?php

/* @var $form_id string */
/* @var $countNotRead integer */

use frontend\modules\user\models\Photo;
use yii\widgets\ActiveForm;
use frontend\widgets\AdvertWidget;
use yii\helpers\Html;
?>
<div class="user-sidebar">

    <?php

        $photo = new Photo();

        $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data']]);

    ?>

    <?php $avatar = Photo::getAvatar(Yii::$app->user->id); ?>

    <div class="img-label-wrap">
        <span class="plus">
            <i class="fas fa-plus"></i>
        </span>
        <label for="<?php echo $form_id ?>" class="<?php if (isset($avatar->file)) echo 'exist-img' ?> img-label">

            <?php if (isset($avatar->file)) : ?>

                <img class="main-img" src="<?php echo $avatar->file ?>">

            <?php endif; ?>

            <?= $form->field($photo, 'file')->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => $form_id])->label(false) ?>

            <p class="form-text">Загрузите <br> свое фото </p>

        </label>
    </div>



    <div class="form-info">
        <p class="alert alert-success"></p>
    </div>

    <?php ActiveForm::end();

    ?>

    <div class="user-menu">

        <div class="row">
            <div class="col-12 col-xl-9">
                <p class="user-name">
                    <?php echo Yii::$app->user->identity->username ?>
                </p>
            </div>
            <div class="col-3">
                    <span class="user-manu ">
                        <i class="fas fa-bars"></i>
                    </span>
            </div>
        </div>

    </div>

    <div class="user-menu-list">
        <ul class="user-menu-ul">
            <li class="user-menu-item my-page"><i class="fas fa-user"></i> <span class="text "><a href="/user">Моя страница</a></span></li>
            <li class="user-menu-item my-page"><i class="fas fa-sign-out-alt"></i> <span class="text "><a href="/">На сайт</a></span></li>
            <li class="user-menu-item my-message"><i class="fas fa-envelope"></i> <span class="text "><a
                        href="/user/chat">Мои сообщения <?php if ($countNotRead > 0) echo $countNotRead?></a></span></li>
            <!--<li class="user-menu-item my-favorite"><i class="fas fa-heart"></i> <span class="text "><a href="">Избранные</a></span>-->

            <li class="user-menu-item my-advert"><i class="fas fa-comment"></i> <span class="text "><a href="/user/ad">Добавить объявление</a></span>
            </li>
            <li class="user-menu-item my-settings"><i class="fas fa-cog"></i> <span class="text "><a href="/user/setting/profile">Настройки профиля</a></span>
            <li class="user-menu-item my-settings"><i class="far fa-user"></i> <span class="text "><a href="/user/setting/anket">Настройки анкеты</a></span>
            </li>
            <li class="user-menu-item my-logout">
            <?php echo ''
                . Html::beginForm(['/user/logout'], 'post')
                . Html::submitButton(
                '<i class="fas fa-sign-out-alt"></i>
                     Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => ' btn-viiti btn text']
                )
                . Html::endForm()
                . '' ?>
            </li>
        </ul>
    </div>

    <?php

        echo AdvertWidget::widget();

    ?>

</div>