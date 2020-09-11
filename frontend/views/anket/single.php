<?php

/* @var $this \yii\web\View */
/* @var $model frontend\modules\user\models\Profile */
/* @var $cityInfo array */
/* @var $group array */
/* @var $userHeart array */

/* @var $userFriends array */

use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;

$this->title = \frontend\components\SingleMetaHelper::Title($model, $cityInfo);

$this->registerMetaTag([
    'name' => 'description',
    'content' => \frontend\components\SingleMetaHelper::Description($model)
]);

?>
<div class="row">


    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget() ?>

        <?php endif; ?>

        <?php
        echo SidebarWidget::Widget()
        ?>
    </div>

    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
            [
                'model' => $model,
                'group' => $group,
                'userFriends' => $userFriends,
                'userHeart' => $userHeart,
            ]
        ) ?>

    </div>

</div>