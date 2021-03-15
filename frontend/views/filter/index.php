<?php
/* @var $this yii\web\View */
/* @var $posts Profile[] */
/* @var $title string */
/* @var $h1 string */
/* @var $des string */
/* @var $cityInfo array */

/* @var $city string */
/* @var $param string */

use frontend\modules\user\models\Profile;
use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;


$this->title = $title;

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);

?>

<div class="site-index">

    <div class="body-content">



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

            <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-4' ?>

            <div class="col-12 col-xl-9 main-banner-wrap margin-bottom-30">

                <?php else : ?>

                <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-3' ?>

                <div class="col-12 col-xl-12 main-banner-wrap margin-bottom-30">

                <?php endif; ?>

                <div class="content-wrap">

                    <?php if (!empty(Yii::$app->view->params['marks'])) : ?>

                        <?php echo Yii::$app->view->params['marks'] ?>

                    <?php endif; ?>

                    <h1><?php echo $h1; ?></h1>

                    <div class="row">
                        <div class="col-12 col-xl-12 fast-links-block">

                            <div class="row">

                                <?php if (strpos(Yii::$app->request->url, 'pol-zhenskij')) : ?>

                                    <div class="col-12">
                                        <div class="main-menu-wrap">
                                            <span onclick="toggle_women_block()" id="women-block-btn" class=" main-menu" >
                                                <svg width="20" height="20" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.06828 3.57851C7.06828 1.92189 5.60275 0.578918 3.79488 0.578918C1.98702 0.578918 0.521484 1.92189 0.521484 3.57851C0.521484 5.03217 1.64997 6.24419 3.1479 6.5194V8.64129H1.75932V9.82703H3.1479V11.1052H4.44187V9.82703H5.83045V8.64129H4.44187V6.5194C5.93982 6.24419 7.06828 5.03217 7.06828 3.57851ZM1.75932 3.57851C1.75932 2.54833 2.67066 1.71321 3.79488 1.71321C4.9191 1.71321 5.83045 2.54833 5.83045 3.57851C5.83045 4.60869 4.9191 5.4438 3.79488 5.4438C2.67066 5.4438 1.75932 4.60869 1.75932 3.57851Z" fill="#486BEF"/>
                                                </svg> Еще</span>
                                        </div>
                                    </div>

                                    <div class="col-12 women-block d-none">

                                        <div class="row">

                                            <div class="col-12 col-xl-5">

                                                <div class="popular-mark">
                                                    <a href="/znakomstva/materialnoe-polozhenie-ishchu-sponsora/pol-zhenskij">любовница/содержанка </a>
                                                </div>
                                                <div class="popular-mark">
                                                    <a href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/pol-zhenskij">для отношений </a>
                                                </div>
                                                <div class="popular-mark">
                                                    <a href="/znakomstva/celi-znakomstva-realynyy-seks/pol-zhenskij">секс без  обязательств </a>
                                                </div>
                                                <div class="popular-mark">
                                                    <a href="/znakomstva/celi-znakomstva-drughba-i-obschenie/pol-zhenskij">для дружбы </a>
                                                </div>

                                            </div>

                                            <div class="col-12 col-xl-3">

                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-20-let">от 20 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-30-let">от 30 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-40-let">от 40 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-45-let">от 45 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-50-let">от 50 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-60-let">от 60 лет</a>
                                                    </div>

                                            </div>

                                            <div class="col-12 col-xl-2">
                                                <div class="popular-mark s-zamyjnimi">
                                                    <a href="/znakomstva/pol-zhenskij/semejnoe-polozhenie-zamughem">с замужними</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                <?php elseif(strpos(Yii::$app->request->url, 'pol-muzhskoj')) : ?>

                                    <div class="col-12">
                                        <div class="main-menu-wrap">
                                            <span onclick="toggle_men_block()" id="men-block-btn" class=" main-menu " >
                                                <svg width="15" height="15" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.32744 0V0.901156H6.46164L4.87744 2.48536C4.36894 2.10811 3.73936 1.88488 3.05758 1.88488C1.36892 1.88488 0 3.25378 0 4.94244C0 6.63108 1.36892 8 3.05756 8C4.7462 8 6.11513 6.63108 6.11513 4.94244C6.11513 4.26066 5.89189 3.63106 5.51464 3.12256L7.09884 1.53838V3.67258H8V0L4.32744 0ZM3.05756 6.993C1.92506 6.993 1.00698 6.07492 1.00698 4.94242C1.00698 3.80992 1.92506 2.89184 3.05756 2.89184C4.19006 2.89184 5.10814 3.80992 5.10814 4.94242C5.10814 6.07494 4.19006 6.993 3.05756 6.993Z" fill="#486BEF"/>
                                                </svg>
                                                Еще</span>
                                        </div>
                                    </div>

                                    <div class="col-12 men-block d-none">
                                        <div class="row">
                                            <div class="col-12 col-xl-5">
                                                    <div class="popular-mark">
                                                        <a href="/znakomstva/materialnoe-polozhenie-gotov-stat-sponsorom/pol-muzhskoj">Ищу спонсора </a>
                                                    </div>
                                                    <div class="popular-mark">
                                                        <a href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/pol-muzhskoj">для отношений </a>
                                                    </div>
                                                    <div class="popular-mark">
                                                        <a href="/znakomstva/celi-znakomstva-realynyy-seks/pol-muzhskoj">для секса без  обязательств </a>
                                                    </div>
                                                    <div class="popular-mark">
                                                        <a href="/znakomstva/celi-znakomstva-drughba-i-obschenie/pol-muzhskoj">для дружбы </a>
                                                    </div>
                                            </div>

                                            <div class="col-12 col-xl-3">
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-20-let">от 20 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-30-let">от 30 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-40-let">от 40 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-45-let">от 45 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-50-let">от 50 лет</a>
                                                    </div>
                                                <div class="popular-mark">
                                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-60-let">от 60 лет</a>
                                                    </div>
                                            </div>

                                            <div class="col-12 col-xl-2">

                                                <div class="popular-mark s-jentatimi">
                                                    <a href="/znakomstva/pol-muzhskoj/semejnoe-polozhenie-ghenat">с женатым</a>
                                                </div>

                                            </div>
                                    </div>
                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>
                    </div>

                    <?php //echo \frontend\widgets\MarkWidget::widget(['url' => Yii::$app->request->url]) ?>

                    <div class="row content first-content">

                        <?php if ($posts) : ?>

                        <?php foreach ($posts as $post) : ?>

                            <?php echo $this->renderFile('@app/views/layouts/article.php', [
                                'post' => $post,
                                    'cityInfo' => $cityInfo,
                                    'cssClass' => $class
                            ]) ?>

                        <?php endforeach; ?>

                            <div data-url="/<?php echo $param ?>" class="col-12"></div>

                        <?php else : ?>

                            <p>Ничего нет</p>

                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-12 pager" data-page="1" data-url="<?php echo Yii::$app->request->url ?>" data-reqest="<?php echo Yii::$app->request->url ?>"></div>

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

    </div>

</div>