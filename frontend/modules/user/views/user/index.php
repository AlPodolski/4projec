<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
 $this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">
    <div class="col-3">
        <?php

        $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <label for="addpostform-image"  class=" img-label">

            <?= $form->field($photo, 'file')->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'addpostform-image' , 'onchange' => 'send_img(this)' ])->label(false) ?>

            <p>Загрузите <br> свое фото</p>

        </label>

        <?php ActiveForm::end();

        ?>
    </div>
    <div class="col-8">

    </div>
</div>
<div class="wrap-avatar">


</div>





