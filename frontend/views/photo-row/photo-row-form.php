<?php

/* @var $photoRowForm \frontend\modules\user\models\Popular */
/* @var $user array */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'photo-row-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<div class="anket-info">

    <div class="anket-info-content">

        <div class="popular-anket-wrap">
            <div class="img-wrap">
                <?php if (isset($user['avatarRelation']['file']) and file_exists(Yii::getAlias('@webroot') . $user['avatarRelation']['file']) and $user['avatarRelation']['file']) : ?>

                    <?= Yii::$app->imageCache->thumb($user['avatarRelation']['file'], 'popular', ['class' => 'img']) ?>

                <?php else : ?>

                    <?= Yii::$app->imageCache->thumb('/files/uploads/no-photo.jpg', 'popular_big', ['class' => 'img']) ?>

                <?php endif; ?>
            </div>
        </div>

        <p><?php echo $user['username'] ?>, Ваша фотография будет помощена в фотолинию на 1 место по всей стране! При подключении услуги другими людьми,
            Ваше фото будет смещаться на одну позицию до тех пор, пока не будет вытеснено из фотолиии</p>

        <?= $form->field($photoRowForm, 'user_id')->hiddenInput(['value' => $user['id']])->label(false) ?>

        <div class="form-group">

            <?= Html::submitButton('Подключить', ['class' => 'blue-btn']) ?>

        </div>
        <?php ActiveForm::end() ?>
    </div>

    <span class="black-text">к оплате:  <span class="blue-text"> <?php echo Yii::$app->params['photo_row_pay'] ?>руб</span></span>

    <br>

    <div class="bottom">
        <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.1787 18.872C18.3337 18.872 18.4564 18.9954 18.4564 19.1497V19.2925C18.8374 19.3377 19.1603 19.4604 19.4568 19.647C19.5601 19.7052 19.6512 19.802 19.6512 19.957C19.6512 20.1579 19.4897 20.3116 19.2889 20.3116C19.2243 20.3116 19.1603 20.2929 19.0958 20.2535C18.8697 20.1185 18.6508 20.0216 18.4312 19.97V21.21C19.4129 21.4547 19.8314 21.848 19.8314 22.5397C19.8314 23.2501 19.2766 23.7203 18.4564 23.7985V24.186C18.4564 24.341 18.3343 24.4637 18.1787 24.4637C18.023 24.4637 17.8952 24.3416 17.8952 24.186V23.7862C17.4108 23.7345 16.9658 23.5589 16.5718 23.2818C16.462 23.2114 16.3975 23.1074 16.3975 22.9724C16.3975 22.7716 16.5525 22.6166 16.752 22.6166C16.8302 22.6166 16.907 22.6431 16.9651 22.6883C17.2693 22.9078 17.5658 23.0551 17.921 23.1197V21.848C16.9774 21.6033 16.5383 21.2474 16.5383 20.5183C16.5383 19.8285 17.0872 19.35 17.8945 19.286V19.1497C17.8951 18.996 18.0237 18.872 18.1787 18.872ZM17.9216 21.073V19.9312C17.5076 19.9693 17.301 20.1882 17.301 20.4724C17.301 20.7443 17.4243 20.9116 17.9216 21.073ZM18.4312 21.9714V23.1455C18.8439 23.1003 19.0693 22.893 19.0693 22.5843C19.0693 22.3008 18.9278 22.1251 18.4312 21.9714Z" fill="white"/>
            <path d="M30.1546 30.0572H32.8994C33.6124 30.0572 34.1911 29.4786 34.1911 28.7656V14.5546C34.1911 13.8416 33.6124 13.263 32.8994 13.263H3.19108C2.47808 13.263 1.89941 13.8416 1.89941 14.5546V28.7656C1.89941 29.4786 2.47808 30.0572 3.19108 30.0572H26.3604" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.0451 26.6046C20.7759 26.6046 22.9896 24.3909 22.9896 21.6601C22.9896 18.9293 20.7759 16.7156 18.0451 16.7156C15.3143 16.7156 13.1006 18.9293 13.1006 21.6601C13.1006 24.3909 15.3143 26.6046 18.0451 26.6046Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M32.4019 13.2655L29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473L1.89922 13.8345" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M27.6573 10.6138L17.7715 13.263" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19.04 8.12794L30.222 5.13192L31.422 9.60561L29.5387 10.11" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1.66016 12.7844L15.4287 9.09605" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <span class="">Ваш баланс : <?php echo $user['cash'] ?> руб <a href="/user/balance">Пополнить</a></span>
    </div>

</div>


