<?php

/* @var $model \frontend\modules\user\models\forms\BuyUserHeartForm */
/* @var $userWhoHeartIsBuy integer */
/* @var $ava \frontend\modules\user\models\Photo */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
        'action' => '/user/heart/buy',
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal buy-user-heart-form'],
]) ?>

<?= $form->field($model, 'userWhoHeartIsBuy')->hiddenInput(['value' => $userWhoHeartIsBuy])->label(false) ?>

<div class="row" >
    <div class="col-12">
        <div class="position-relative get-heart"
            <?php if ($ava and file_exists(Yii::getAlias('@webroot') . $ava['file'])) : ?>
                data-img="<?php echo Yii::$app->imageCache->thumbSrc($ava['file'], 'popular'); ?>"
            <?php else : ?>
                data-img="/files/img/nophoto.png"
            <?php endif; ?> >

            <div class="post_image">
                <?php echo \frontend\widgets\PhotoWidget::widget([
                    'path' => $ava['file'],
                    'size' => 'dialog',
                    'options' => [
                        'class' => 'img',
                        'loading' => 'lazy',
                        'alt' => '',
                    ],
                ]); ?>
            </div>

            <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">

        </div>
    </div>
</div>

<div class="form-group">

    <?= Html::submitButton('Занять', ['class' => 'blue-btn']) ?>

</div>

<div class="cost"> Стоимость <?php echo Yii::$app->params['buy_heart_cost'] ?> руб. </div>

<?php ActiveForm::end() ?>
