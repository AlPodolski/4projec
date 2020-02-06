<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use yii\widgets\ActiveForm;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
 $this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <div class="col-3">

        <?php

        $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <label for="addpostform-image"  class=" img-label">

            <?= $form->field($photo, 'file')->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'addpostform-image' , 'onchange' => 'send_img(this)' ])->label(false) ?>

            <p class="form-text">Загрузите <br> свое фото </p>

        </label>

        <div class="form-info">
            <p class="alert alert-success"></p>
        </div>

        <?php ActiveForm::end();

        ?>

        <div class="user-menu">

            <div class="row">
                <div class="col-9">
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
                <li class="user-menu-item my-page"><i class="fas fa-user"></i> <span class="text "><a href="">Моя страница</a></span></li>
                <li class="user-menu-item my-message"><i class="fas fa-envelope"></i> <span class="text "><a href="">Мои сообщения</a></span></li>
                <li class="user-menu-item my-favorite"><i class="fas fa-heart"></i> <span class="text "><a href="">Избранные</a></span></li>
                <li class="user-menu-item my-settings"><i class="fas fa-cog"></i> <span class="text "><a href="">Настройки</a></span></li>
                <li class="user-menu-item my-logout"><i class="fas fa-sign-out-alt"></i> <span class="text "><a href="">Выйти</a></span></li>
            </ul>
        </div>

        <div class="user-menu">

            <div class="row">
                <div class="col-9">
                    <p class="user-name">
                        интим объявления
                    </p>
                </div>
                <div class="col-3">
                    <span class="user-ab ">
                        <i class="fas fa-bars"></i>
                    </span>
                </div>
            </div>

        </div>

        <div class="user-ab-wrap">

            <div class="user-ab-item">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="col-10">
                        <div class="name">Alexa fexa</div>
                        <div class="text-ab">
                            прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехам
                            и прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехами
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-ab-item">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="col-10">
                        <div class="name">Alexa fexa</div>
                        <div class="text-ab">
                            прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехам
                            и прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехами
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-ab-item">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="col-10">
                        <div class="name">Alexa fexa</div>
                        <div class="text-ab">
                            прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехам
                            и прекрасная девушка ищет при-
                            нца на белом коне и с большой
                            елдой доспехами
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="col-8">

    </div>
</div>
<div class="wrap-avatar">


</div>





