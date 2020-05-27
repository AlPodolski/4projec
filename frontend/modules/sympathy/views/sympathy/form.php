<?php
/* @var $model \frontend\modules\sympathy\models\SympathySetting */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Pol;
use yii\helpers\ArrayHelper;

$pol = Pol::find()->asArray()->all();

$form = ActiveForm::begin([
    'id' => 'sympathy-settings-form',
    'options' => ['class' => 'form-horizontal'],
]);

$age_from = range(18, 80);
$age_to = range(19, 80);
$age_from = array_combine ($age_from, $age_from);
$age_to = array_combine ($age_to, $age_to);
?>

<?= $form->field($model, 'pol_id')->dropDownList(ArrayHelper::map($pol, 'id', 'value')); ?>

<p>Возраст</p>

<div class="row">
    <div class="col-6"><?= $form->field($model, 'age_from')->dropDownList($age_from)->label(false) ?></div>
    <div class="col-6"><?= $form->field($model, 'age_to')->dropDownList($age_to)->label(false) ?></div>
</div>

<div class="form-group">
    <div>
        <span class="blue-btn" onclick="set_sympathy_settings(this)">
            Сохранить
        </span>
    </div>
</div>
<div class="result-text"></div>

<?php ActiveForm::end() ?>