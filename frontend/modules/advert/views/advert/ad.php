<?php

use frontend\widgets\UserSideBarWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
?>

<div class="row">
    <?php echo UserSideBarWidget::Widget()  ?>

    <div class="col-9">

            <div class="anket">

            <?php $form = ActiveForm::begin(); ?>

            <div class="col-12">

                <?= $form->field($model, 'text')->textarea(['id' => 'advert-text-add']) ?>

            </div>

            <div class="col-12">

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'in-cabinet']) ?>
                </div>

            </div>

            <?php ActiveForm::end() ?>

        </div>

    </div>

</div>

