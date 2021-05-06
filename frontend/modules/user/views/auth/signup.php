<?php

/* @var $this yii\web\View */

use frontend\modules\user\widgets\RegisterWidget;
use yii\helpers\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните все поля формы :</p>

    <div class="row">
        <div class="col-lg-5">

            <?php echo RegisterWidget::widget(); ?>

        </div>
    </div>
</div>
