<?php

/* @var $model frontend\modules\user\models\Profile */
use frontend\widgets\SidebarWidget;
$this->title = $model->username; ?>
<div class="row">

    <?php echo \frontend\widgets\PopularWidget::widget(['city' => $city]); ?>

    <?php

    echo SidebarWidget::Widget() ?>

    <?php $this->title = $model->username; ?>

    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
            [
                'model' => $model,
            ]
        ) ?>

    </div>

</div>