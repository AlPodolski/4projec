<?php

/* @var $model frontend\modules\user\models\Profile */
/* @var $cityInfo array */
use frontend\widgets\SidebarWidget;

$title = $model->username .' из города '.$cityInfo['city'];

 if (!empty($model['sexual'])) {
     $title .= ' ориентация ';
     foreach ($model['sexual'] as $item) $title .=' '. $item['value'] . ' ' ;
}

if (!empty($model['wantFind'])){
    $title .= ' хочу найти ';
    foreach ($model['wantFind'] as $item) $title .=' '. $item['value'] . ' ' ;
}

$this->title = $title ;

?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <?php

    echo SidebarWidget::Widget() ?>

    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
            [
                'model' => $model,
            ]
        ) ?>

    </div>

</div>