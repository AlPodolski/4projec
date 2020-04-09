<?php

/* @var $this \yii\web\View */
/* @var $model frontend\modules\user\models\Profile */
/* @var $cityInfo array */
/* @var $userFriends array */
use frontend\widgets\SidebarWidget;

$this->title = \frontend\components\SingleMetaHelper::Title($model, $cityInfo) ;

$this->registerMetaTag([
        'name' => 'description',
        'content' => \frontend\components\SingleMetaHelper::Description($model)
]);

?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <?php

    echo SidebarWidget::Widget() ?>

    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
            [
                'model' => $model,
                'userFriends' => $userFriends,
            ]
        ) ?>

    </div>

</div>