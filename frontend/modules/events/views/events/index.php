<?php
use frontend\widgets\UserSideBarWidget;
use frontend\widgets\PhotoWidget;
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

                                <?php if ($event['type'] == \frontend\modules\events\models\Events::NEW_SYMPATHY) : ?>

                                    <div class="col-1">

                                        <a class="position-relative" href="/user/<?php echo $event['profile']['id'] ?>">

                                            <?php echo PhotoWidget::widget([
                                                'path' => $event['profile']['fromProfile']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $event['profile']['username'],
                                                ],
                                            ]  ); ?>

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

                                <?php endif; ?>

                                <?php if ($event['type'] == \frontend\modules\events\models\Events::MUTUAL_SYMPATHY) : ?>

                                        <div class="col-2 ">

                                            <a class="position-relative" href="/user/<?php echo $event['profile']['id'] ?>">

                                                <?php echo PhotoWidget::widget([
                                                    'path' => $event['profile']['userAvatarRelations']['file'],
                                                    'size' => 'dialog',
                                                    'options' => [
                                                        'class' => 'img',
                                                        'loading' => 'lazy',
                                                        'alt' => $event['profile']['username'],
                                                    ],
                                                ]  ); ?>

                                                <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">

                                            </a>


                                            <a class=" " href="/user/<?php echo $event['profile']['id'] ?>">

                                                <?php echo PhotoWidget::widget([
                                                    'path' => $event['profile']['fromProfile']['file'],
                                                    'size' => 'dialog',
                                                    'options' => [
                                                        'class' => 'img',
                                                        'loading' => 'lazy',
                                                        'alt' => $event['profile']['username'],
                                                    ],
                                                ]  ); ?>

                                            </a>
                                        </div>

                                    <div class="col-10 d-flex align-center">

                                            <div class="blue-text">
                                                1
                                            </div>
                                            <div class="small-text">
                                                новая взаимная симпатия
                                            </div>

                                    </div>

                                <?php endif; ?>


                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>
            </div>

        </div>

    </div>

</div>