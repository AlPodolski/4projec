<?php

use frontend\widgets\PhotoWidget;

/* @var $presents array */

?>

<div class="row">
    <?php foreach ($presents as $present) : ?>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="present-item present-btn">

                        <img loading="lazy" src="<?php echo $present['present']['img'] ?>" alt="">

                    </div>
                </div>
                <div class="col-12">
                        <div class="user-info-wrap d-flex">
                            <div class="post_image">
                                <a href="/user/<?php echo $present['author']['id'] ?>">
                                    <?php echo PhotoWidget::widget([
                                        'path' => $present['author']['userAvatarRelations']['file'],
                                        'size' => 'dialog',
                                        'options' => [
                                            'class' => 'img',
                                            'loading' => 'lazy',
                                            'alt' => $present['author']['username'],
                                        ],
                                    ]); ?>
                                </a>
                            </div>
                            <div class="author-info-wrap">
                                <div class="author">
                                    <a href="/user/<?php echo $present['author']['id'] ?>">
                                        <?php echo $present['author']['username'] ?>
                                    </a>
                                </div>
                                <div class="post-text">
                                    <?php echo $present['message'] ? $present['message']  : 'Без комментариев' ?>
                                </div>
                                <div class="post_date">
                                    <?php
                                        echo Yii::$app->formatter->asDate($present['timestamp'])
                                    ?>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
</div>
