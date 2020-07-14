<?php
/* @var $model \frontend\models\forms\BuyPresentForm */
/* @var $giftForUser \frontend\modules\user\models\Profile */
/* @var $present array */
/* @var $from_user_id integer */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'present-form',
    'action' => '/present/gift',
    'options' => ['class' => 'form-horizontal'],
]) ?>


<div class="close_present_form" onclick="close_present_form()">
    <i class="fas fa-arrow-left"></i>
</div>
<div class="row">
    <div class="col-12">
        <div class="present-heading">Выбранный подарок</div>
    </div>
    <div class="col-12">
        <img class="present-img" src="http://msk.<?php echo Yii::$app->params['site_name'] ?>/<?php echo $present['img'] ?>" alt="">
    </div>
    <div class="col-12">
        <?= $form->field($model, 'message')->textarea(['placeholder' => 'Добавить сообщение...'])->label(false) ?>
    </div>
</div>

<div class="form-group">
    <span class="blue-btn" onclick="send_present_to_user(this)" data-present-id="<?php echo $present['id'] ?>"
          data-to="<?php echo $giftForUser ?>" data-from="<?php echo $from_user_id ?>">Подтвердить</span>
</div>
<?php ActiveForm::end() ?>
