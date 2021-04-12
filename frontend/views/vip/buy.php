<?php

/* @var $buyForm BuyVipStatusForm */
/* @var $model \frontend\models\forms\ObmenkaPayForm */

use frontend\models\forms\BuyVipStatusForm;
use yii\base\BaseObject;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\widgets\UserSideBarWidget;
use yii\helpers\ArrayHelper;

?>

<div class="row">

    <?php if (!Yii::$app->user->isGuest) : ?>

        <div class="col-3 filter-sidebar">

            <?php echo UserSideBarWidget::Widget()?>

        </div>

    <?php endif; ?>

    <div class="col-9">

        <div class="col-12 col-xl-9 content">

            <h1 class="mb-4"><?php echo $this->title ?></h1>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'action' => '/vip/cust-pay',
                    'options' => ['class' => 'form-horizontal'],
                ]) ?>

                <?= $form->field($model, 'sum')->hiddenInput(['value' => $buyForm->sum])->label(false) ?>


                <?= $form->field($model, 'currency')
                    ->radioList(ArrayHelper::map(\common\models\ObmenkaCurrency::find()->all(), 'id', 'name'),
                        [
                            'item' => function($index, $label, $name, $checked, $value) {
                                $chec = '';
                                $return = '<span>';
                                if ($index == 0) $chec = 'checked';
                                $return .= '<input '.$chec.' id="'.mb_strtolower($label).'_label-id" type="radio" name="' . $name . '" value="' . $value . '" tabindex="'.$index.'">';
                                $return .= '<label for="'.mb_strtolower($label).'_label-id" class="modal-radio '.mb_strtolower($label).'_label img-label-radio">';
                                $return .= '</label>';
                                $return .= '</span>';

                                return $return;
                            }
                        ])
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'type-btn']) ?>
                </div>

                <?php ActiveForm::end() ?>

        </div>

    </div>

</div>


