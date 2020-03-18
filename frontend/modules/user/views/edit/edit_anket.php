<?php
use common\models\BodyType;
use common\models\EyeColor;
use common\models\HairColor;
use common\models\Rayon;
use common\models\Service;
use common\models\Sexual;
use frontend\models\UserPol;
use frontend\widgets\UserSideBarWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Metro;

?>
<?php
$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Редактировать информация о себе';

$pol = UserPol::find()->where(['user_id' => Yii::$app->user->id])->asArray()->one();

$hair_color = HairColor::find()->asArray()->all();
$body_type = BodyType::find()->asArray()->all();
$eye_color = EyeColor::find()->asArray()->all();
$eye_color = EyeColor::find()->asArray()->all();
$sexualList = Sexual::find()->where(['pol_id' => $pol['pol_id']])->asArray()->all();
$metroList = Metro::find()->asArray()->all();
$rayonList = Rayon::find()->asArray()->all();

$model->getParams(Yii::$app->user->id);

$service_list_sex = Service::find()->asArray()->all();

?>
<div class="row">
    <?php echo UserSideBarWidget::Widget() ?>
    <div class="col-9">
        <div class="edit-form anket">

            <p class="name heading-anket">Редактировать информацию</p>

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">

                <div class="col-4">
                    <?= $form->field($model, 'sexual')
                        ->dropDownList(ArrayHelper::map($sexualList, 'id', 'value')); ?>
                </div>
                <div class="col-4"> <?= $form->field($model, 'hairColor')
                        ->dropDownList(ArrayHelper::map($hair_color, 'id', 'value')); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'rost')->textInput(); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'userVes')->textInput(); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'eyeColor')
                        ->dropDownList(ArrayHelper::map($eye_color, 'id', 'value')); ?> </div>
                <div class="col-4"> <?= $form->field($model, 'body')
                        ->dropDownList(ArrayHelper::map($body_type, 'id', 'value')); ?> </div>

                <?php if ($pol['pol_id'] != 1) : ?>

                    <div class="col-4"> <?= $form->field($model, 'breastSize')->textInput(); ?> </div>

                <?php endif; ?>

                <div class="col-12">

                    <?= $form->field($model, 'service')->widget(\kartik\select2\Select2::classname(), [
                        'data' =>  ArrayHelper::map($service_list_sex, 'id', 'value'),
                        'language' => 'de',
                        'options' => ['placeholder' => 'Выбрать предпочтение ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true,
                        ],
                    ]) ?>

                </div>

                <?php if ($metroList) : ?>

                    <div class="col-12">

                        <?= $form->field($model, 'metro')->widget(\kartik\select2\Select2::classname(), [
                            'data' =>  ArrayHelper::map($metroList, 'id', 'value'),
                            'language' => 'de',
                            'options' => ['placeholder' => 'Выбрать метро ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ],
                        ]) ?>

                    </div>

                <?php endif; ?>

                <?php if ($rayonList) : ?>

                    <div class="col-12">

                        <?= $form->field($model, 'rayon')->widget(\kartik\select2\Select2::classname(), [
                            'data' =>  ArrayHelper::map($rayonList, 'id', 'value'),
                            'language' => 'de',
                            'options' => ['placeholder' => 'Выбрать район ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ],
                        ]) ?>

                    </div>

                <?php endif; ?>

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



