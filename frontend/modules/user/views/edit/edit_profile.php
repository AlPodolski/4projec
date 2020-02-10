<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = 'Редактировать профиль'

?>
<div class="row">

    <?php echo UserSideBarWidget::Widget()?>

    <div class="col-9">

        <div class="edit-form">

            <div class="row">
            </div>

            <?php $form = ActiveForm::begin(); ?>

                <div class="col-4"> <?= $form ->field($model, 'username')->textInput(); ?></div>

                <div class="col-4"> <?= $form ->field($model, 'birthday')->textInput(); ?> </div>

            <?php

                ActiveForm::end();

            ?>

        </div>

    </div>

</div>





