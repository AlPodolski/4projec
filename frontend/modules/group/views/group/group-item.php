<?php

use frontend\widgets\PhotoWidget;
use frontend\modules\group\components\helpers\SubscribeHelper;

/* @var $groupItem array */

?>

<div class="friends_user_row clear_fix">

    <div class="friends_photo_wrap ui_zoom_wrap">
        <a href="/group/<?php echo $groupItem['id'] ?>">

            <?php echo PhotoWidget::widget([
                'path' => $groupItem['avatar']['file'],
                'size' => '80',
                'options' => [
                    'class' => 'friends_photo_img',
                    'loading' => 'lazy',
                    'alt' => $groupItem['name'],
                ],
            ]); ?>
        </a>
    </div>

    <div class="friends_user_info">
        <div class="friends_field friends_field_title">
            <a href="/group/<?php echo $groupItem['id'] ?>"><?php echo $groupItem['name'] ?> </a>
            <br>
            <span class="small-heading">Подписчики :<?php echo SubscribeHelper::countSubscribers($groupItem['id'], Yii::$app->params['group_subscribe_key']); ?></span>
        </div>
    </div>

</div>