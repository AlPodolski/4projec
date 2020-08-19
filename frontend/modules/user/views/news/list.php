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

    <div class="col-9 content">

        <h1 class="mb-4">Новости</h1>

        <?php echo \frontend\modules\wall\widgets\WallWidget::widget([
            'user_id' => Yii::$app->user->id,
            'news' => true,
            'wrapCssClass' => 'm-bottom-20'
        ]) ?>

    </div>

    <div class="pager" data-url="/user/news" data-page="1">
    </div>

</div>
