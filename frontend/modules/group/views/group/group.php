<?php

/* @var $group array */
/* @var $groupItems array */

/* @var $this \yii\web\View */

use frontend\widgets\UserSideBarWidget;
use frontend\widgets\PhotoWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $group['name'];
?>
<div class="row">
    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>

    <div class="col-12 col-xl-9 dialog group">

        <div class="row ">
            <div class="col-12 m-bottom-20">
                <div class="page-block friends-list">

                    <div class="post-photo">

                        <div class="row">

                            <div class="col-7">
                                <div class="row">

                                    <div class="col-2">
                                        <div class="post_image">
                                            <?php echo PhotoWidget::widget([
                                                'path' => $group['avatar']['file'],
                                                'size' => 'dialog',
                                                'options' => [
                                                    'class' => 'img',
                                                    'loading' => 'lazy',
                                                    'alt' => $group['name'],
                                                ],
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="author padding-top-5"><?php echo $group['name'] ?></div>
                                            </div>
                                            <div class="col-12">
                                                <div class="about group-about padding-top-5">
                                                    <?php echo $group['description'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="no-content-wrap d-flex">
                                    <div class="row">

                                        <?php if (Yii::$app->user->isGuest) : ?>

                                            <?php $onclickSubscribe = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"'; ?>

                                            <div class="blue-btn" <?php echo $onclickSubscribe; ?>>
                                                Подписаться
                                            </div>

                                        <?php else : ?>

                                            <?php $onclickSubscribe = 'onclick="subscribe_group(this)"'; ?>

                                            <?php if (\frontend\modules\group\components\helpers\SubscribeHelper::isSubscribe(
                                                $group['id'],
                                                Yii::$app->user->id,
                                                Yii::$app->params['group_subscribe_key']
                                            )) : ?>

                                                <div class="blue-btn" data-id="<?php echo $group['id'] ?>" <?php echo $onclickSubscribe; ?>>
                                                    Отписаться
                                                </div>

                                            <?php else : ?>

                                                <div class="blue-btn" data-id="<?php echo $group['id'] ?>" <?php echo $onclickSubscribe; ?>>
                                                    Подписаться
                                                </div>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-8">

                        <div class="wall-wrapper">

                            <?php echo \frontend\modules\wall\widgets\WallWidget::widget([
                                'user_id' => $group['id'],
                                'group' => $group,
                                'relatedClass' => \frontend\modules\group\models\Group::class
                            ]) ?>
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="back-link back-link-right ">

                            <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

                                <a class="nav-item nav-link active padding-left-0 small-black-text" id="nav-home-tab"
                                   data-toggle="tab"
                                   role="tab" aria-controls="nav-home" aria-selected="true">Контакты</a>

                                <div class=" ui_zoom_wrap">
                                    <a class="post_image" href="/user/<?php echo $group['profile']['id'] ?>">

                                        <?php echo PhotoWidget::widget([
                                            'path' => $group['profile']['userAvatarRelations']['file'],
                                            'size' => 'dialog',
                                            'options' => [
                                                'class' => 'img',
                                                'loading' => 'lazy',
                                                'alt' => $group['profile']['username'],
                                            ],
                                        ]); ?>

                                    </a>
                                </div>

                                <div class="friends_user_info">

                                    <div class="friends_field friends_field_title">
                                        <a href="/user/<?php echo $group['profile']['id'] ?>"><?php echo $group['profile']['username'] ?></a>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>