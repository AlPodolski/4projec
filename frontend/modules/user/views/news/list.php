<?php

use frontend\widgets\UserSideBarWidget;
use frontend\widgets\SidebarWidget;

/* @var $this \yii\web\View */

$this->title = 'Новости';

?>

<div class="row">
    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget()?>

        <?php endif; ?>

        <?php echo SidebarWidget::Widget() ?>

    </div>

    <div class="col-9">

        <?php echo \frontend\modules\wall\widgets\WallWidget::widget([
            'user_id' => Yii::$app->user->id,
            'wrapCssClass' => 'm-bottom-20'
        ]) ?>

    </div>

</div>
