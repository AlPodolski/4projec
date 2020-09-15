<?php

use frontend\widgets\UserSideBarWidget;
use frontend\widgets\PhotoWidget;

/* @var $events array */

$this->title = 'Уведомления';

?>
<div class="row">

    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>
    <div class="col-12 col-xl-9">

        <div class="page-block event-block">
            <p class="blue-text">Уведомления</p>
            <div class="alert-item-wrap">
                <?php if ($events) : ?>

                    <?php foreach ($events as $event) : ?>

                        <?php if ($event['type'] == \frontend\modules\events\models\Events::NEW_SYMPATHY) : ?>

                            <div class="alert-item">

                                <div class="row">

                                    <div class="col-2 col-sm-1">

                                        <a class="position-relative"
                                           href="/user/<?php echo $event['fromProfile']['id'] ?>">

                                            <?php echo PhotoWidget::widget([
                                                'path' => $event['fromProfile']['userAvatarRelations']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $event['profile']['username'],
                                                ],
                                            ]); ?>

                                            <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">


                                        </a>

                                    </div>

                                    <div class="col-10 d-flex align-center">

                                        <div class="blue-text">
                                            1
                                        </div>
                                        <div class="small-text">
                                            новая симпатия
                                        </div>
                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if ($event['type'] == \frontend\modules\events\models\Events::NEW_GUEST) : ?>

                            <div class="alert-item">

                                <div class="row">

                                    <div class="col-2 col-sm-1">

                                        <?php if (Yii::$app->user->identity['vip_status_work'] > time()) : ?>

                                            <a class="position-relative " href="/user/<?php echo $event['fromProfile']['id'] ?>">

                                                <?php echo PhotoWidget::widget([
                                                    'path' => $event['fromProfile']['userAvatarRelations']['file'],
                                                    'size' => 'dialog',
                                                    'options' => [
                                                        'class' => 'img',
                                                        'loading' => 'lazy',
                                                        'alt' => $event['profile']['username'],
                                                    ],
                                                ]); ?>

                                            </a>

                                        <?php else: ?>

                                            <a class="position-relative blur-10">

                                                <?php echo PhotoWidget::widget([
                                                    'path' => $event['fromProfile']['userAvatarRelations']['file'],
                                                    'size' => 'dialog',
                                                    'options' => [
                                                        'class' => 'img',
                                                        'loading' => 'lazy',
                                                        'alt' => $event['profile']['username'],
                                                    ],
                                                ]); ?>

                                            </a>

                                        <?php endif; ?>

                                    </div>

                                    <div class="col-10 d-flex align-center">
                                        <div class="small-text">
                                            Новый гость на странице
                                        </div>
                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if ($event['type'] == \frontend\modules\events\models\Events::MUTUAL_SYMPATHY) : ?>

                            <div class="alert-item mutual-item">

                                <div class="row">

                                    <div class="col-5 col-md-2">

                                        <a class="position-relative" href="/user/<?php echo $event['profile']['id'] ?>">

                                            <?php echo PhotoWidget::widget([
                                                'path' => $event['profile']['userAvatarRelations']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $event['profile']['username'],
                                                ],
                                            ]); ?>

                                            <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">

                                        </a>


                                        <a class=" " href="/user/<?php echo $event['fromProfile']['id'] ?>">

                                            <?php echo PhotoWidget::widget([
                                                'path' => $event['fromProfile']['userAvatarRelations']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $event['profile']['username'],
                                                ],
                                            ]); ?>

                                        </a>
                                    </div>

                                    <div class="col-7 col-md-10 d-flex align-center">

                                        <div class="small-text">
                                            взаимная симпатия
                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>

                        <?php if ($event['type'] == \frontend\modules\events\models\Events::NEW_COMMENT) : ?>

                            <div class="alert-item comment-event-item">

                                <div class="row">

                                    <div class="col-5 col-md-1">

                                        <a class="position-relative"
                                           href="/user/<?php echo $event['fromProfile']['id'] ?>">

                                            <?php echo PhotoWidget::widget([
                                                'path' => $event['fromProfile']['userAvatarRelations']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $event['fromProfile']['username'],
                                                ],
                                            ]); ?>

                                        </a>

                                    </div>

                                    <div class="col-7 col-md-10">

                                        <div class="row">
                                            <div class="small-text col-12">

                                                <a class="position-relative blue-text"
                                                   href="/user/<?php echo $event['fromProfile']['id'] ?>">

                                                    <?php echo $event['fromProfile']['username'] ?>

                                                </a>

                                                оставил<?php if ($event['fromProfile']['polRelation']) {
                                                    if ($event['fromProfile']['polRelation']['pol_id'] == 2) echo 'а';
                                                } else {
                                                    echo '(a)';
                                                }
                                                ?> комментарий к записи:

                                            </div>
                                            <div class="event-item-comment-text col-12">
                                                <?php

                                                $parent = \frontend\modules\events\models\Events::getParent($event['class'], $event['related_id']);

                                                echo mb_substr($parent['text'], 0, 66)

                                                ?>...

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>

        </div>

    </div>

</div>