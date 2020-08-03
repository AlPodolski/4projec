<?php

use frontend\widgets\PhotoWidget;

/* @var $subscriber array */
?>

<div class="friends_user_row clear_fix">

    <div class="friends_photo_wrap ui_zoom_wrap">
        <a href="/user/<?php echo $subscriber['id'] ?>">
            <?php echo PhotoWidget::widget([
                'path' => $subscriber['userAvatarRelations']['file'],
                'size' => '80',
                'options' => [
                    'class' => 'friends_photo_img',
                    'loading' => 'lazy',
                    'alt' => $subscriber['username'],
                ],
            ]); ?>
        </a>
    </div>

    <div class="friends_user_info">
        <div class="friends_field friends_field_title">
            <a href="/user/<?php echo $subscriber['id'] ?> ">  <?php echo $subscriber['username'] ?> </a>
        </div>
    </div>

</div>