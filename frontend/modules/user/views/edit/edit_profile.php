<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
/* @var $model Profile */

use common\models\Pol;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\widgets\UserSideBarWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->registerJsFile('/files/js/jquery.maskedinput.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->title = 'Редактировать профиль';

$pol = Pol::find()->asArray()->all();
$model->pol = $model->getPol();
?>
<div class="row">

    <div class="col-3">
        <?php echo UserSideBarWidget::Widget()?>

    </div>


    <div class="col-12 col-xl-9">

        <div class="edit-form anket">


            <?php $form = ActiveForm::begin(); ?>

            <div class="row">

                <div class="col-12 col-sm-6 col-lg-4""> <?= $form ->field($model, 'username')->textInput(); ?></div>
                <div class="col-12 col-sm-6 col-lg-4""> <?= $form ->field($model, 'phone')->textInput(['maxlength' => true , 'placeholder' => "+7(999)99 99 999"]); ?></div>
                <div class="col-12 col-sm-6 col-lg-4""> <?= $form ->field($model, 'pol')->dropDownList(ArrayHelper::map($pol, 'id', 'value')); ?></div>

                <div class="col-12 col-sm-6 col-lg-4">

                    <?php $model->formatDate() ?>

                    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Дата рождения'],
                        'value' => date('d.m.Y', $model->birthday),
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ]); ?>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php

                ActiveForm::end();

            ?>



        </div>

    </div>

</div>





