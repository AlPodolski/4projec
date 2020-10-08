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

                <?php if (!Yii::$app->user->isGuest) : ?>

                <div class="mobile-filter-icon open-filter">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.01919 8.9423H9.7273C10.1145 10.4368 11.4626 11.5486 13.0765 11.5486C14.6904 11.5486 16.0385 10.4368 16.4257 8.9423H27.9807C28.4585 8.9423 28.8461 8.55468 28.8461 8.07692C28.8461 7.59916 28.4585 7.21154 27.9807 7.21154H16.4257C16.0385 5.71704 14.6904 4.60524 13.0765 4.60524C11.4626 4.60524 10.1145 5.71704 9.7273 7.21154H2.01919C1.54143 7.21154 1.15381 7.59916 1.15381 8.07692C1.15381 8.55468 1.54143 8.9423 2.01919 8.9423ZM13.0765 6.33601C14.0365 6.33601 14.8174 7.11688 14.8174 8.07692C14.8174 9.03696 14.0365 9.81783 13.0765 9.81783C12.1165 9.81783 11.3356 9.03696 11.3356 8.07692C11.3356 7.11688 12.1165 6.33601 13.0765 6.33601Z" fill="#486BEF"/>
                        <path d="M27.9807 14.1346H26.1275C25.7403 12.6401 24.3922 11.5283 22.7783 11.5283C21.1643 11.5283 19.8163 12.6401 19.4291 14.1346H2.01919C1.54143 14.1346 1.15381 14.5222 1.15381 15C1.15381 15.4778 1.54143 15.8654 2.01919 15.8654H19.4291C19.8163 17.3599 21.1643 18.4717 22.7783 18.4717C24.3922 18.4717 25.7403 17.3599 26.1275 15.8654H27.9807C28.4585 15.8654 28.8461 15.4778 28.8461 15C28.8461 14.5222 28.4585 14.1346 27.9807 14.1346ZM22.7783 16.7409C21.8182 16.7409 21.0374 15.96 21.0374 15C21.0374 14.04 21.8182 13.2591 22.7783 13.2591C23.7383 13.2591 24.5192 14.04 24.5192 15C24.5192 15.96 23.7383 16.7409 22.7783 16.7409Z" fill="#486BEF"/>
                        <path d="M27.9807 21.0577H11.2132C10.8261 19.5632 9.47806 18.4514 7.86505 18.4514C6.25111 18.4514 4.90303 19.5632 4.51584 21.0577H2.01919C1.54143 21.0577 1.15381 21.4453 1.15381 21.9231C1.15381 22.4008 1.54143 22.7884 2.01919 22.7884H4.51584C4.90303 24.2829 6.25111 25.3947 7.86505 25.3947C9.47806 25.3947 10.8261 24.2829 11.2132 22.7884H27.9807C28.4585 22.7884 28.8461 22.4008 28.8461 21.9231C28.8461 21.4453 28.4585 21.0577 27.9807 21.0577ZM7.86505 23.664C6.90501 23.664 6.12414 22.8831 6.12414 21.9231C6.12414 20.963 6.90501 20.1822 7.86505 20.1822C8.82396 20.1822 9.60483 20.963 9.60483 21.9231C9.60483 22.8831 8.82396 23.664 7.86505 23.664Z" fill="#486BEF"/>
                    </svg>
                    Фильтр
                </div>

                <?php endif; ?>

                <span onclick="toggle_women_block()" class=" main-menu" >Женщины</span>

                <span onclick="toggle_men_block()" class=" main-menu" >Мужчины</span>

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
            <div class="col-12 col-xl-12 fast-links-block">

                <div class="row">

                    <div class="col-12 women-block">
                        <div class="row">
                            <div class="col-12 col-xl-2">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="hide-mobile">Я хочу найти:</p>
                                    </div>
                                    <div class="col-12">
                                        <a href="/znakomstva/pol-zhenskij" class="blue-text blue-border">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5594 4.55937C12.5594 2.04131 10.5181 0 8.00002 0C5.48192 0 3.44064 2.04131 3.44064 4.55937C3.44064 6.76894 5.01246 8.61122 7.09886 9.02953V12.2548H5.16477V14.0571H7.09886V16H8.90118V14.0571H10.8353V12.2548H8.90118V9.02953C10.9876 8.61122 12.5594 6.76894 12.5594 4.55937ZM5.16477 4.55937C5.16477 2.9935 6.43414 1.72413 8.00002 1.72413C9.56589 1.72413 10.8353 2.9935 10.8353 4.55937C10.8353 6.12525 9.56589 7.39463 8.00002 7.39463C6.43414 7.39463 5.16477 6.12525 5.16477 4.55937Z" fill="#486BEF"/>
                                            </svg>
                                            Девушку
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-5">
                                <div class="col-12">
                                    <p class="hide-mobile">цель:</p>
                                </div>
                                <div class="col-12">
                                    <div class="popular-mark">
                                        <a href="/znakomstva/materialnoe-polozhenie-ishchu-sponsora/pol-zhenskij">любовница/содержанка </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/pol-zhenskij">для серьезных отношений </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-realynyy-seks/pol-zhenskij">для секса без  обязательств </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-drughba-i-obschenie/pol-zhenskij">для общения и дружбы </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-3">
                                <div class="col-12">
                                    <p class="hide-mobile">Параметры:</p>
                                </div>
                                <div class="col-12">
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-20-let">20+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-30-let">30+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-40-do-50-let">40-50+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-50-let">50+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-zhenskij/vozrast-ot-60-let">60+</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-2">
                                <div class="popular-mark s-zamyjnimi">
                                    <a href="/znakomstva/pol-zhenskij/semejnoe-polozhenie-zamughem">с замужними</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 men-block">
                        <div class="row">
                            <div class="col-12 col-xl-2">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="/znakomstva/pol-muzhskoj" class="blue-text blue-border margin-top-35">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.03209 0V1.46438H10.5002L7.92584 4.03871C7.09952 3.42568 6.07646 3.06292 4.96856 3.06292C2.2245 3.06292 0 5.2874 0 8.03146C0 10.7755 2.2245 13 4.96854 13C7.71258 13 9.93708 10.7755 9.93708 8.03146C9.93708 6.92357 9.57432 5.90048 8.96129 5.07416L11.5356 2.49986V5.96794H13V0L7.03209 0ZM4.96854 11.3636C3.12823 11.3636 1.63635 9.87175 1.63635 8.03144C1.63635 6.19112 3.12823 4.69925 4.96854 4.69925C6.80885 4.69925 8.30073 6.19112 8.30073 8.03144C8.30073 9.87177 6.80885 11.3636 4.96854 11.3636Z" fill="#486BEF"/>
                                            </svg>
                                            Мужчину
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-5">
                                <div class="col-12 margin-top-10 ">
                                    <div class="popular-mark">
                                        <a href="/znakomstva/materialnoe-polozhenie-gotov-stat-sponsorom/pol-muzhskoj">богатого спонсора </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/pol-muzhskoj">для серьезных отношений </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-realynyy-seks/pol-muzhskoj">для секса без  обязательств </a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/celi-znakomstva-drughba-i-obschenie/pol-muzhskoj">для общения и дружбы </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-3">
                                <div class="col-12 margin-top-10 ">
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-20-let">20+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-30-let">30+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-40-do-50-let">40-50+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-50-let">50+</a>
                                    </div>
                                    <div class="popular-mark">
                                        <a href="/znakomstva/pol-muzhskoj/vozrast-ot-60-let">60+</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-2">
                                <div class="popular-mark s-jentatimi">
                                    <a href="/znakomstva/pol-muzhskoj/semejnoe-polozhenie-ghenat">с женатым</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
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


                <div class="row ">

                    <div data-url="/" class="col-12"></div>

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
