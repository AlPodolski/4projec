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
use common\models\Place;
use common\models\National;
use kartik\date\DatePicker;

?>
<?php
$this->registerJsFile('/files/js/jquery.maskedinput.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Редактировать информация о себе';

$pol = UserPol::find()->where(['user_id' => Yii::$app->user->id])->asArray()->one();

$hair_color = HairColor::find()->asArray()->all();
$body_type = BodyType::find()->asArray()->all();
$eye_color = EyeColor::find()->asArray()->all();
$sexualList = Sexual::find()->where(['pol_id' => $pol['pol_id']])->asArray()->all();
$metroList = Metro::find()->asArray()->all();
$rayonList = Rayon::find()->asArray()->all();
$place = Place::find()->asArray()->all();
$nacionalnost = National::find()->asArray()->all();
$financialSituation = \common\models\FinancialSituation::find()->asArray()->all();
$interesting = \common\models\Interesting::find()->asArray()->all();
$professionals = \common\models\Professionals::find()->asArray()->all();
$children = \common\models\Children::find()->asArray()->all();
$family = \common\models\Family::find()->asArray()->all();
$wantFind = \common\models\WantFind::find()->asArray()->all();
$celiZnakomstvamstva = \common\models\CeliZnakomstvamstva::find()->asArray()->all();
$haracter = \common\models\Haracter::find()->asArray()->all();
$lifeGoals = \common\models\LifeGoals::find()->asArray()->all();
$smoking = \common\models\Smoking::find()->asArray()->all();
$alcogol = \common\models\Alcogol::find()->asArray()->all();
$education = \common\models\Education::find()->asArray()->all();
$intimHair = \common\models\IntimHair::find()->asArray()->all();
$sferaDeyatelnosti = \common\models\SferaDeyatelnosti::find()->asArray()->all();
$zhile = \common\models\Zhile::find()->asArray()->all();
$transport = \common\models\Transport::find()->asArray()->all();


$model->getParams(Yii::$app->user->id);

$service_list_sex = Service::find()->asArray()->all();

$cityList = \common\models\City::find()->asArray()->select('url, city')->all();

?>
<div class="row">
    <div class="col-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>
    <div class="col-12 col-xl-9">
        <div class="edit-form anket">

            <p class="name heading-anket">Редактировать информацию</p>

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">

                <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'username')->textInput(); ?></div>
            <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => "+7(999)99 99 999", 'id' => 'profile-phone']); ?>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">

            <?php $model->formatDate() ?>

            <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Дата рождения'],
                'value' => date('d.m.Y', $model->birthday),
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ]); ?>
        </div>

        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'city')
                ->dropDownList(ArrayHelper::map($cityList, 'url', 'city')); ?> </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <?= $form->field($model, 'sexual')
                ->dropDownList(ArrayHelper::map($sexualList, 'id', 'value')); ?>
        </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'hairColor')
                ->dropDownList(ArrayHelper::map($hair_color, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'rost')->textInput(); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'userVes')->textInput(); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'eyeColor')
                ->dropDownList(ArrayHelper::map($eye_color, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'body')
                ->dropDownList(ArrayHelper::map($body_type, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'national')
                ->dropDownList(ArrayHelper::map($nacionalnost, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'financialSituation')
                ->dropDownList(ArrayHelper::map($financialSituation, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'professionals')
                ->dropDownList(ArrayHelper::map($professionals, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'children')
                ->dropDownList(ArrayHelper::map($children, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'family')
                ->dropDownList(ArrayHelper::map($family, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'education')
                ->dropDownList(ArrayHelper::map($education, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'intimHair')
                ->dropDownList(ArrayHelper::map($intimHair, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'sferaDeyatelnosti')
                ->dropDownList(ArrayHelper::map($sferaDeyatelnosti, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'zhile')
                ->dropDownList(ArrayHelper::map($zhile, 'id', 'value')); ?> </div>

        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'transport')
                ->dropDownList(ArrayHelper::map($transport, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'smoking')
                ->dropDownList(ArrayHelper::map($smoking, 'id', 'value')); ?> </div>
        <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'alcogol')
                ->dropDownList(ArrayHelper::map($alcogol, 'id', 'value')); ?>
        </div>

        <?php if ($pol['pol_id'] != 1) : ?>

            <div class="col-12 col-sm-6 col-lg-4"> <?= $form->field($model, 'breastSize')->textInput(); ?> </div>

        <?php endif; ?>

        <div class="col-12">

            <?= $form->field($model, 'service')->widget(\kartik\select2\Select2::classname(), [
                'data' => ArrayHelper::map($service_list_sex, 'id', 'value'),
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
                    'data' => ArrayHelper::map($metroList, 'id', 'value'),
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
                    'data' => ArrayHelper::map($rayonList, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Выбрать район ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <?php if ($place) : ?>

            <div class="col-12">

                <?= $form->field($model, 'place')->widget(\kartik\select2\Select2::classname(), [
                    'data' => ArrayHelper::map($place, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Выбрать место ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <?php if ($interesting) : ?>

            <div class="col-12">

                <?= $form->field($model, 'interesting')->widget(\kartik\select2\Select2::classname(), [
                    'data' => ArrayHelper::map($interesting, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Выбрать интересы ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <?php if ($wantFind) : ?>

            <div class="col-12">

                <?= $form->field($model, 'wantFind')->widget(\kartik\select2\Select2::classname(), [
                    'data' => ArrayHelper::map($wantFind, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Хочу найти ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <?php if ($celiZnakomstvamstva) : ?>

            <div class="col-12">

                <?= $form->field($model, 'celiZnakomstvamstva')->widget(\kartik\select2\Select2::classname(), [
                    'data' => ArrayHelper::map($celiZnakomstvamstva, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Цели знакомства ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <?php if ($haracter) : ?>

            <div class="col-12">

                <?= $form->field($model, 'haracter')->widget(\kartik\select2\Select2::classname(), [
                    'data' => ArrayHelper::map($haracter, 'id', 'value'),
                    'language' => 'de',
                    'options' => ['placeholder' => 'Характер ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]) ?>

            </div>

        <?php endif; ?>

        <div class="col-12 "> <?= $form->field($model, 'about')
                ->textarea(); ?>
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



