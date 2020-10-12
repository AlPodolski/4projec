<?php

use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $model \frontend\modules\user\models\forms\PrivateSettingsForm */

$params = \frontend\modules\user\models\PrivacySettings::find()->asArray()->all();

$this->title = 'Настройки приватности';

$model->getParams(Yii::$app->user->id);

?>

<div class="row">

    <div class="col-3">

        <?php echo UserSideBarWidget::Widget() ?>

    </div>

    <div class="col-12 col-xl-9">

        <div class="edit-form anket">

            <p class="name heading-anket">Настройки приватности</p>

            <?php

            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>

            <?= $form->field($model, 'params')->checkboxList(ArrayHelper::map($params, 'id', 'name')) ?>

            <?= Html::submitButton('Сохранить', ['class' => 'type-btn']) ?>

            <?php ActiveForm::end() ?>

        </div>

    </div>

</div>