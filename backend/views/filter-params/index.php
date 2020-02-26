<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Параметры фильтров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filter-params-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать фильтр', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url',
            'class_name',
            'relation_class',
            'column_param_name',

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>
