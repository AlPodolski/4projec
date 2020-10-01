<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Метки для страниц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-mark-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать метку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'page_url:url',
            'text',
            'url:url',

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>
