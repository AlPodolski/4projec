<?php

/* @var $group array */

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
    <div class="col-12 col-xl-6 dialog">

        <div class="page-block friends-list">
            <div class="row">
                <div class="col-8">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                               href="#nav-all-friends" role="tab" aria-controls="nav-home" aria-selected="true">Мои группы</a>

                        </div>
                    </nav>
                </div>
            </div>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show" id="nav-all-friends" role="tabpanel" aria-labelledby="nav-home-tab">

                    <?php foreach ($group as $groupItem) : ?>

                            <div class="friends_user_row clear_fix">

                            <div class="friends_photo_wrap ui_zoom_wrap">
                                <a href="/group/<?php echo $groupItem['id'] ?>">

                                    <?php echo PhotoWidget::widget([
                                        'path' => $groupItem['avatar']['file'],
                                        'size' => 'dialog',
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
                                    <a href="/group/<?php echo $groupItem['id'] ?> ">  <?php echo $groupItem['name'] ?> </a>
                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>
        </div>

    </div>

    <div class="col-xl-3 back-link back-link-right ">

        <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

            <a class="nav-item nav-link active padding-left-0 small-black-text" id="nav-home-tab" data-toggle="tab"
                role="tab" aria-controls="nav-home" aria-selected="true">Популярные группы</a>

            <div class=" ui_zoom_wrap">
                <a class="post_image" href="/user/23215">

                    <img loading="lazy" class="img" srcset="/thumbs/2c8/photo-23215-9d830ff76a92dbb37877efc8d8865bf31592908192_dialog.webp" alt="">

                </a>
            </div>

            <div class="friends_user_info">

                <div class="friends_field friends_field_title">
                    <a href="/user/23215">
                        Александр                    </a>
                </div>
                <a href="/user/23215" class="friends_field_act small-heading">Назад на страницу</a>
            </div>

        </div>

    </div>
</div>