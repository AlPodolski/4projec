<?php
/* @var $advertList Advert[] */
/* @var $this View */

use frontend\modules\advert\models\Advert;
use frontend\widgets\SidebarWidget;
use yii\web\View;
use frontend\widgets\UserSideBarWidget;

$this->title = 'Объявления о знакомствах ';

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Объявления знакомств с девушками, парнями и парами для общения, отношений и секса. Без регистрации! Бесплатно!'
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

        <div class="anket content advert-page">

            <div class="row">
                <h1 class="mb-4">Объявления о знакомствах</h1>
            </div>

            <div class="add-advert-wrap" <?php if (Yii::$app->user->isGuest) : ?>
                data-toggle="modal" data-target="#modal-in"
            <?php else : ?>
                data-toggle="modal" data-target="#addAdvertModal"
            <?php endif; ?>
             >
                <div class="add-advert-btn">
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.1199 7.1875H9.8125V1.88008C9.8125 1.18691 9.22598 0.625 8.5 0.625C7.77402 0.625 7.1875 1.18691 7.1875 1.88008V7.1875H1.88008C1.18691 7.1875 0.625 7.77402 0.625 8.5C0.625 9.22598 1.18691 9.8125 1.88008 9.8125H7.1875V15.1199C7.1875 15.8131 7.77402 16.375 8.5 16.375C9.22598 16.375 9.8125 15.8131 9.8125 15.1199V9.8125H15.1199C15.8131 9.8125 16.375 9.22598 16.375 8.5C16.375 7.77402 15.8131 7.1875 15.1199 7.1875Z" fill="white"/>
                    </svg>
                </div>
            </div>

            <?php foreach ($advertList as $advert) : ?>

                <?php echo  $this->renderFile('@app/modules/advert/views/advert/item.php' , [
                        'advert' => $advert
                ]) ?>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="col-12 pager" data-url="/more-adverds" data-page="1"></div>



</div>


