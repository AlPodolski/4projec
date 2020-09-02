<?php
/* @var $model \frontend\models\forms\BuyPresentForm */
/* @var $giftForUser \frontend\modules\user\models\Profile */
/* @var $present array */
/* @var $from_user_id \common\models\User */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'present-form',
    'action' => '/present/gift',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'present_id')->hiddenInput(['value' => $present['id']])->label(false) ?>
<?= $form->field($model, 'from_id')->hiddenInput(['value' => $from_user_id['id']])->label(false) ?>
<?= $form->field($model, 'to_id')->hiddenInput(['value' => $giftForUser['id']])->label(false) ?>

<?php $giftForUser->getUserAvatar() ?>
<div class="close_present_form" onclick="close_present_form()">
    <i class="fas fa-arrow-left"></i>
</div>
<div class="row">
    <div class="col-12">
        <div class="present-heading">Выбранный подарок</div>
    </div>
    <div class="col-12">
        <img class="present-img" src="<?php echo $present['img'] ?>" alt="">
    </div>
    <div class="col-12">
        <?= $form->field($model, 'message')->textarea(['placeholder' => 'Добавить сообщение...'])->label(false) ?>
    </div>
</div>

<div class="form-group">
    <span class="blue-btn" onclick="send_present(this)">Подтвердить</span>
</div>
<?php ActiveForm::end() ?>
