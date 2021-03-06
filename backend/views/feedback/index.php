<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text',
            'mail',
            'status',
            'created_at',
            [
                'attribute' => 'Пользователь',
                'format' => 'raw',
                'value' => function ($claim) {
                    /* @var $claim \common\models\Feedback */

                    if (isset($claim->user_id) and $claim->user_id)
                        return Html::a($claim->user_id, '/profile/update?id='.$claim->user_id);

                    return '-';

                },
            ],

            ['class' => 'backend\components\ActionColumnExtends'],
        ],
    ]); ?>


</div>
