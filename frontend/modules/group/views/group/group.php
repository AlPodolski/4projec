<?php

/* @var $group array */
/* @var $groupItems array */
/* @var $subscribers array */
/* @var $countSubscribes integer */
/* @var $model \frontend\modules\group\models\forms\addGroupRecordItemForm */

/* @var $this \yii\web\View */

use frontend\widgets\UserSideBarWidget;
use frontend\widgets\PhotoWidget;
use yii\widgets\ActiveForm;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $group['name'];

?>
<div class="row">
    <div class="col-xl-3">
        <?php if (!Yii::$app->user->isGuest) : ?>
            <?php echo UserSideBarWidget::Widget() ?>
        <?php endif; ?>
    </div>

    <div class="col-12 col-xl-9 dialog group">

        <div class="row ">
            <div class="col-12 m-bottom-20">

                <div class="page-block friends-list">

                    <div class="post-photo">

                        <div class="row">

                            <div class="col-12 col-md-9 col-lg-7">
                                <div class="row">

                                    <div class="col-3 col-md-2">
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
                                    <div class="col-9 col-md-10">
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
                            <div class="col-12 col-md-3 col-lg-5">
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

                                                <div class="blue-btn"
                                                     data-id="<?php echo $group['id'] ?>" <?php echo $onclickSubscribe; ?>>
                                                    Отписаться
                                                </div>

                                            <?php else : ?>

                                                <div class="blue-btn"
                                                     data-id="<?php echo $group['id'] ?>" <?php echo $onclickSubscribe; ?>>
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
                    <div class="col-12 col-lg-8">

                        <div class="wall-wrapper content">

                            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $group['id']) : ?>

                            <div class="wall-tem page-block m-bottom-20">

                                <?php

                                $form = ActiveForm::begin([
                                    'action' => '#',
                                    'id' => 'wall-form',
                                    'options' => ['class' => 'form-horizontal wall-group-form'],
                                ]) ?>

                                <?php if (!Yii::$app->user->isGuest) : ?>

                                    <div class="row">
                                        <div class="col-9 col-sm-10">
                                            <?= $form->field($model, 'text' , ['options' => ['class' => '']])
                                                ->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>
                                        </div>
                                    </div>

                                    <?= $form->field($model, 'group_id')
                                    ->hiddenInput(['value' => $group['id']])->label(false) ?>

                                    <div class="img-label-wrap">
                                        <label for="add-form-record" class="">

                                            <span> <i class="fas fa-upload"></i> Загрузить фото </span>

                                            <?= $form->field($model, 'file' , ['options' => ['class' => '']])
                                                ->fileInput(['maxlength' => true,
                                                    'accept' => 'image/*',
                                                    'id' => 'add-form-record',
                                                    'class' => ''])
                                                ->label(false) ?>

                                        </label>
                                    </div>

                                <?php endif; ?>

                                    <span class=" btn wall-send-btn wall-group-send-btn">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF"
                                                  fill-opacity="0.13"/>
                                        </svg>
                                    </span>

                                <?php ActiveForm::end() ?>

                            </div>

                            <?php endif; ?>

                            <?php echo \frontend\modules\wall\widgets\WallWidget::widget([
                                'user_id' => $group['id'],
                                'group' => $group,
                                'relatedClass' => \frontend\modules\group\models\Group::class,
                                'wrapCssClass' => 'm-bottom-20'
                            ]) ?>

                        </div>

                        <div class="pager" data-url="/group/<?php echo $group['id'] ?>" data-page="1">

                        </div>

                    </div>

                    <div class=" col-lg-4 group-contact">

                        <div class="row">
                            <div class="col-12">
                                <div class="back-link back-link-right m-bottom-20">

                                    <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

                                        <a class="nav-item nav-link active padding-left-0 small-black-text"
                                           id="nav-home-tab"
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
                            <div class="col-12">
                                <div class="back-link back-link-right ">

                                    <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

                                        <a class="nav-item nav-link active padding-left-0 small-black-text"
                                           href="/group/<?php echo $group['id'] ?>/subscribers"
                                        > Подписчики <?php echo $countSubscribes ?></a>
                                        <div class="user-friends-list">
                                            <div class="row">

                                                <?php if ($subscribers) foreach ($subscribers as $subscriber) : ?>

                                                    <div class="col-4">

                                                        <a class="post_image"
                                                           href="/user/<?php echo $subscriber['id'] ?>">
                                                            <?php echo PhotoWidget::widget([
                                                                'path' => $subscriber['userAvatarRelations']['file'],
                                                                'size' => 'dialog',
                                                                'options' => [
                                                                    'class' => 'img',
                                                                    'loading' => 'lazy',
                                                                    'alt' => $subscriber['username'],
                                                                ],
                                                            ]); ?>
                                                        </a>
                                                        <span class="author"><?php echo $subscriber['username'] ?></span>
                                                    </div>

                                                <?php endforeach; ?>

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

    </div>

</div>