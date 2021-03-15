<?php

/* @var $this yii\web\View */
/* @var $city string */
/* @var $title string */
/* @var $des string */
/* @var $h1 string */
/* @var $posts Profile[] */
/* @var $cityInfo array */

use frontend\modules\user\models\Profile;
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;
$this->title = $title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);

if (isset($yandex_meta['tag'])) $this->registerMetaTag(['name' => 'yandex-verification', 'content' => $yandex_meta['tag']]);
?>

<div class="main-banner">
    <div class="row">
        <div class="col-12">
            <h1><?php echo Yii::$app->params['h1'] ?></h1>
        </div>
        <div class="col-12">
            <div class="main-menu-wrap">

                <span id="women-block-btn" class=" main-menu" >
                    <svg width="20" height="20" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.06828 3.57851C7.06828 1.92189 5.60275 0.578918 3.79488 0.578918C1.98702 0.578918 0.521484 1.92189 0.521484 3.57851C0.521484 5.03217 1.64997 6.24419 3.1479 6.5194V8.64129H1.75932V9.82703H3.1479V11.1052H4.44187V9.82703H5.83045V8.64129H4.44187V6.5194C5.93982 6.24419 7.06828 5.03217 7.06828 3.57851ZM1.75932 3.57851C1.75932 2.54833 2.67066 1.71321 3.79488 1.71321C4.9191 1.71321 5.83045 2.54833 5.83045 3.57851C5.83045 4.60869 4.9191 5.4438 3.79488 5.4438C2.67066 5.4438 1.75932 4.60869 1.75932 3.57851Z" fill="#486BEF"/>
                    </svg> <a href="/znakomstva/pol-zhenskij"> Женщины </a></span>
                <span id="men-block-btn" class=" main-menu " >
                    <svg width="15" height="15" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.32744 0V0.901156H6.46164L4.87744 2.48536C4.36894 2.10811 3.73936 1.88488 3.05758 1.88488C1.36892 1.88488 0 3.25378 0 4.94244C0 6.63108 1.36892 8 3.05756 8C4.7462 8 6.11513 6.63108 6.11513 4.94244C6.11513 4.26066 5.89189 3.63106 5.51464 3.12256L7.09884 1.53838V3.67258H8V0L4.32744 0ZM3.05756 6.993C1.92506 6.993 1.00698 6.07492 1.00698 4.94242C1.00698 3.80992 1.92506 2.89184 3.05756 2.89184C4.19006 2.89184 5.10814 3.80992 5.10814 4.94242C5.10814 6.07494 4.19006 6.993 3.05756 6.993Z" fill="#486BEF"/>
                    </svg>
                    <a href="/znakomstva/pol-muzhskoj">Мужчины</a></span>
                <span class="close-toggle-block d-none">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.71 4.70998L27.29 3.28998L16 14.59L4.71001 3.28998L3.29001 4.70998L14.59 16L3.29001 27.29L4.71001 28.71L16 17.41L27.29 28.71L28.71 27.29L17.41 16L28.71 4.70998Z" fill="#486BEF"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php if (!empty(Yii::$app->view->params['marks'])) : ?>

                <?php echo Yii::$app->view->params['marks'] ?>

            <?php endif; ?>

        </div>

        <div class="row">

            <?php if (!Yii::$app->user->isGuest) : ?>

            <div class="col-3 filter-sidebar">

                    <?php echo UserSideBarWidget::Widget()?>

                <?php
                    echo SidebarWidget::Widget()
                ?>

            </div>

            <?php endif; ?>

            <?php if (!Yii::$app->user->isGuest) : ?>

            <div class="col-12 col-xl-9 main-banner-wrap">

                <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-4' ?>

            <?php else : ?>

                <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-3' ?>

            <div class="col-12 col-xl-12 main-banner-wrap">

            <?php endif; ?>

                <div class="row first-content">

                    <?php foreach ($posts as $post) : ?>

                        <?php echo $this->renderFile('@app/views/layouts/article.php', [
                            'post' => $post,
                            'cityInfo' => $cityInfo,
                            'cssClass' => $class
                        ]) ?>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="col-12 col-xl-12 main-banner-wrap margin-top-10">


                <div class="row content">



                </div>

            </div>

            <svg class="filter" version="1.1">
                <defs>
                    <filter id="gooeyness">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -10" result="gooeyness" />
                        <feComposite in="SourceGraphic" in2="gooeyness" operator="atop" />
                    </filter>
                </defs>
            </svg>
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>

            <div class="col-12 pager" data-page="1" data-url="/"
                 data-reqest="<?php echo Yii::$app->request->url ?>"
                 data-accept="<?php echo Yii::$app->request->headers->get('Accept') ?>"></div>

        </div>

    </div>

</div>
