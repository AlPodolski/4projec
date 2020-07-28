<?php

/* @var $group array */

use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;
use frontend\widgets\PhotoWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $group['name'];
?>
<div class="row">
    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>
    <div class="col-12 col-xl-6 dialog">

        <div class="page-block friends-list">

            <div class="post-photo">

                <div class="row">
                    <div class="col-2">
                        <div class="post_image">
                            <?php echo PhotoWidget::widget([
                                'path' => $group['avatar']['file'],
                                'size' => 'dialog',
                                'options' => [
                                    'class' => 'img',
                                    'loading' => 'lazy',
                                    'alt' =>$group['name'],
                                ],
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="author"><?php echo $group['name']?></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 back-link back-link-right ">

        <div class="right-column-anket page-block friends-list clear_fix padding-top-5">

            <a class="nav-item nav-link active padding-left-0 small-black-text" id="nav-home-tab" data-toggle="tab"
               role="tab" aria-controls="nav-home" aria-selected="true">Контакты</a>

            <div class=" ui_zoom_wrap">
                <a class="post_image" href="/user/23215">

                    <img loading="lazy" class="img"
                         srcset="/thumbs/2c8/photo-23215-9d830ff76a92dbb37877efc8d8865bf31592908192_dialog.webp" alt="">

                </a>
            </div>

            <div class="friends_user_info">

                <div class="friends_field friends_field_title">
                    <a href="/user/23215">Александр</a>
                </div>
            </div>

        </div>

    </div>
</div>