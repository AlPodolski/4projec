<?php /* @var $model \frontend\models\forms\FeedBackForm */

use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;

$form = ActiveForm::begin([
    'id' => 'feedback-form',
    'action' => '/feedback',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'mail') ?>
<?= $form->field($model, 'text')->textarea() ?>

    <div class="form-group">
        <script defer src='https://www.google.com/recaptcha/api.js'></script>
        <div class="g-recaptcha" data-sitekey="6LfjluwUAAAAAOP7w0FozfGwfuIC3FXy1E3Jxf9X"></div>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end() ?>