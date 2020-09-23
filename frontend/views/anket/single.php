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


    <?php if (!Yii::$app->user->isGuest) : ?>

        <div class="col-3 filter-sidebar">

            <?php echo UserSideBarWidget::Widget()?>

            <?php
            echo SidebarWidget::Widget()
            ?>

        </div>

    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest) : ?>

    <div class="col-12 col-xl-9">

        <?php else : ?>

        <div class="col-12 col-xl-12">

            <?php endif; ?>



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