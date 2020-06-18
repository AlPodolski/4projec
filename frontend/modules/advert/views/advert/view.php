<?php

/* @var $advert array */
/* @var $this yii\web\View */

use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;
use frontend\widgets\PhotoWidget;

$commentsForm = new \frontend\models\forms\AddCommentForm();

$this->registerMetaTag([
        'name' => 'description',
        'content' =>  mb_substr($advert['text'], 0, 255),

]);

?>
<div class="row">

    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget()?>

        <?php endif; ?>

        <?php
        echo SidebarWidget::Widget()
        ?>
    </div>



    <div class="col-12 col-xl-9">

        <div class="anket advert-view advert-item">


            <?php if ($advert['userRelations']) : ?>

                <div class="col-12">
                    <div class="row user-info">
                        <div class="col-3 col-sm-2 col-md-1 ">
                            <div class="dialog-photo">
                                <a class="name" href="/user/<?php echo $advert['userRelations']['id'] ?>">
                                    <?php echo PhotoWidget::widget([
                                        'path' => $advert['userRelations']['userAvatarRelations']['file'],
                                        'size' => 'dialog',
                                        'options' => [
                                            'class' => 'img',
                                            'loading' => 'lazy',
                                            'alt' => $advert['userRelations']['username'],
                                        ],
                                    ]); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-9 col-sm-10 col-md-11">
                            <div class="name">
                                <a class="name" href="/user/<?php echo $advert['userRelations']['id'] ?>">
                                    <?php echo  $advert['userRelations']['username'] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <div class="col-12 advert-item-text">
                <div >
                        <?php echo $advert['title']; ?>
                </div>
                <div class="text-ab">

                        <?php echo $advert['text']; ?>

                </div>
            </div>




        </div>

    </div>

</div>