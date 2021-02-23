<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Сбросить пароль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Введите новый пароль:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Новый пароль') ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
