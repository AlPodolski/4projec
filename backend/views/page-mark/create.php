<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PageMark */

$this->title = 'Создать метку';
$this->params['breadcrumbs'][] = ['label' => 'Создать метку', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-mark-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
