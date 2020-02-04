<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use frontend\modules\user\widgets\LoginWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните все поля формы :</p>

    <div class="row">
        <div class="col-lg-5">
            <?php echo LoginWidget::Widget(); ?>
        </div>
    </div>
</div>
