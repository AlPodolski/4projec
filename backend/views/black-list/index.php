<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlackList */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Black Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Black List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($item) {
                    /* @var $item \common\models\BlackList */

                    if (isset($item->user_id) and $item->user_id)
                        return Html::a($item->user_id, '/profile/update?id='.$item->user_id);

                    return '-';

                },
            ],

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>
