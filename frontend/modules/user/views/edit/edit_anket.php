<?php use common\models\BodyType;
use common\models\EyeColor;
use common\models\HairColor;
use common\models\Service;
use frontend\widgets\UserSideBarWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<?php
$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Редактировать информация о себе';

$hair_color = HairColor::find()->where(['pol' => Yii::$app->user->identity->pol])->asArray()->all();
$body_type = BodyType::find()->asArray()->all();
$eye_color = EyeColor::find()->asArray()->all();

$model->getParams(Yii::$app->user->id);

$service_list_sex = Service::find()->asArray()->all();

?>
<div class="row">
    <?php echo UserSideBarWidget::Widget() ?>
    <div class="col-9">
        <div class="edit-form anket">

            <p class="name heading-anket">Редактировать внешность</p>

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">

                <div class="col-4"> <?= $form->field($model, 'hair_color')
                        ->dropDownList(ArrayHelper::map($hair_color, 'id', 'value')); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'rost')->textInput(); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'ves')->textInput(); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'eye_color')
                        ->dropDownList(ArrayHelper::map($eye_color, 'id', 'value')); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'body')
                        ->dropDownList(ArrayHelper::map($body_type, 'id', 'value')); ?> </div>

                <?php if (Yii::$app->user->identity->pol != 1) : ?>

                    <div class="col-4"> <?= $form->field($model, 'breast_size')->textInput(); ?> </div>

                <?php endif; ?>

                <div class="col-12">

                    <?= $form->field($model, 'service')->checkboxList(ArrayHelper::map($service_list_sex, 'id', 'value'), ['id' => 'addpostform-service']) ?>

                </div>

                <div class="col-12">

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>

            </div>



            <?php ActiveForm::end() ?>

        </div>

    </div>
</div>



