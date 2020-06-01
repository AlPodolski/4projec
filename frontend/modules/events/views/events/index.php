<?php
use frontend\widgets\UserSideBarWidget;
/* @var $events array */

$this->title = 'Уведомления';

?>
<div class="row">

    <div class="col-3">
        <?php echo UserSideBarWidget::Widget()?>
    </div>
    <div class="col-9">

        <div class="page-block event-block">
            <p class="blue-text">Уведомления</p>
            <div class="alert-item-wrap">
                <?php if ($events) : ?>

                    <?php foreach ($events as $event) : ?>

                        <div class="alert-item">
                            <div class="row">
                                <div class="col-1">
                                    <?php if (file_exists(Yii::getAlias('@webroot') . $event['profile']['userAvatarRelations']['file'])
                                        and $event['profile']['userAvatarRelations']['file']) : ?>

                                        <picture>
                                            <source srcset="<?= Yii::$app->imageCache->thumbSrc($event['profile']['userAvatarRelations']['file'], 'dialog') ?>" >
                                            <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($event['profile']['userAvatarRelations']['file'], 'dialog') ?>" alt="">
                                        </picture>

                                    <?php else : ?>

                                        <div class="img">
                                            <img src="/files/img/nophoto.png" alt="">
                                        </div>

                                    <?php endif; ?>
                                </div>
                                <div class="col-10 d-flex align-center">

                                    <?php if ($event['type'] == \frontend\modules\events\models\Events::NEW_SYMPATHY) : ?>

                                        <div class="blue-text">
                                            1
                                        </div>
                                        <div class="small-text">
                                            новая симпатия
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>

        </div>

    </div>

</div>