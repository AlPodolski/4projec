<?php

/* @var $this \yii\web\View*/
/* @var $payForm \frontend\modules\user\models\forms\PayForm*/

use frontend\widgets\UserSideBarWidget;
use frontend\widgets\SidebarWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Пополнить баланс';

?>
<div class="row">


    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget()?>

        <?php endif; ?>

        <?php

            echo SidebarWidget::Widget()

        ?>
    </div>

    <div class="col-12 col-xl-9">

        <div class="main-banner">
            <h1><?php echo $this->title ?></h1>

            <?php

            $form = ActiveForm::begin([
                'id' => 'pay-form',
                'options' => ['class' => 'form-horizontal'],
            ])

            ?>

            <?= $form->field($payForm, 'sum')->textInput(['value' => 200]) ?>

            <div class="form-group">

                <?= Html::submitButton('Пополнить', ['class' => 'type-btn']) ?>

            </div>

            <?php ActiveForm::end() ?>

            <p>Если возникли проблемы с оплатой просим обратиться в поддержку</p>

            <?php echo \frontend\widgets\FeedBackFormWidget::widget(); ?>

        </div>

    </div>

</div>