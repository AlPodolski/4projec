<?php
/* @var $model \frontend\models\forms\BuyPresentForm */
/* @var $giftForUser \frontend\modules\user\models\Profile */
/* @var $present array */
/* @var $from_user_id \common\models\User */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => '/present/gift',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'present_id')->hiddenInput(['value' => $present['id']])->label(false) ?>
<?= $form->field($model, 'from_id')->hiddenInput(['value' => $from_user_id['id']])->label(false) ?>
<?= $form->field($model, 'to_id')->hiddenInput(['value' => $giftForUser['id']])->label(false) ?>
<?php $giftForUser->getAvatar() ?>
<div class="row">
    <div class="col-3">
        <div class="present-profile">
            <div class="img-wrap">

                    <?php if (file_exists(Yii::getAlias('@webroot').$giftForUser->avatar) and $giftForUser->avatar) : ?>

                        <?= Yii::$app->imageCache->thumb($giftForUser->avatar, 'popular', ['class'=>'img']) ?>

                    <?php else : ?>

                        <img src="/files/img/nophoto.png" alt="">

                    <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="col-5">
        <span class="present-recepient">Получатель подарка :</span>
        <span class="present-recepient"><?php echo $giftForUser->username ?></span>
    </div>
    <div class="col-4">
        <img src="<?php echo $present['img'] ?>" alt="">
    </div>
</div>

<div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end() ?>
