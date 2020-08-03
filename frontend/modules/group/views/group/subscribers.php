<?php

/* @var $subscribers array */
/* @var $group array */
/* @var $countSubscribes integer */

use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Мои группы';

use frontend\widgets\PhotoWidget;

?>

<div class="row">
    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>

    <div class="col-xl-9 col-12">
        <div class="row">

            <div class="col-12 col-xl-8 dialog">

                <div class="page-block friends-list">
                    <div class="row">
                        <div class="col-8">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                       href="#nav-all-friends" role="tab" aria-controls="nav-home" aria-selected="true">Подписчики</a>

                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade active show" id="nav-all-friends" role="tabpanel" aria-labelledby="nav-home-tab">

                            <?php foreach ($subscribers as $subscriber) : ?>

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

                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-4">

                <div class="row">
                    <div class="col-12">

                        <div class="back-link back-link-right m-bottom-20">

                            <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

                                <a class="nav-item nav-link active padding-left-0 small-black-text" id="nav-home-tab" data-toggle="tab" role="tab" aria-controls="nav-home" aria-selected="true">Назад</a>

                                <div class=" ui_zoom_wrap">
                                    <a class="post_image" href="/group/<?php echo $group['id'] ?>">

                                        <?php echo PhotoWidget::widget([
                                            'path' => $group['avatar']['file'],
                                            'size' => 'dialog',
                                            'options' => [
                                                'class' => 'img',
                                                'loading' => 'lazy',
                                                'alt' => $group['name'],
                                            ],
                                        ]); ?>

                                    </a>
                                </div>

                                <div class="friends_user_info">

                                    <div class="friends_field friends_field_title">
                                        <a href="/group/<?php echo $group['id'] ?>"><?php echo $group['name'] ?></a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
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

                                                <a class="post_image" href="/user/<?php echo $subscriber['id']?>">
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
