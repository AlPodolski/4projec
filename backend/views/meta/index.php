<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шаблонымета тегов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-template-index">
<span class="glyphicon glyphicon-music"></span>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить шаблон', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:ntext',
            'title:ntext',
            'des:ntext',
            'h1',

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>
