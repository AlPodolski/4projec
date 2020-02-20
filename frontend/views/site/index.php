<?php

/* @var $this yii\web\View */
/* @var $city string */
/* @var $posts Profile[] */

use frontend\modules\user\models\Profile;
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;
$this->title = 'Знакомства';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php echo PopularWidget::widget(['city' => $city]); ?>

        </div>

        <div class="row">
            <?php

                echo SidebarWidget::Widget()

            ?>

            <div class="col-9 main-banner-wrap">
                <div class="main-banner">
                    <div class="row">
                        <div class="col-12">
                            <h1>Секс знакомства Москва</h1>
                            <div class="text-main">
                                <p>Привет мой похотливый друг! Мы рады видеть тебя на сайте Intim DOSUG, здесь ты найдешь
                                    для себя самые интересные анкеты  </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Выберите раздел для поиска секса:</h5>
                        </div>
                        <div class="col-6 main-banner-item">
                            <div class="row">
                                <div class="col-5">
                                    <img class="baner-menu-img" src="/files/img/dandy.png" alt="">
                                </div>
                                <div class="col-7">
                                    <ul class="banner-menu-list">
                                        <li><a href="/pol-muzhskoj">Ищу мужчину</a></li>
                                        <li><a href="/orientaciya-gei">Ищу гея</a></li>
                                        <li><a href="/pol-muzhskoj/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 main-banner-item">
                            <div class="row">
                                <div class="col-5">
                                    <img class="baner-menu-img" src="/files/img/canary.png" alt="">
                                </div>
                                <div class="col-7">
                                    <ul class="banner-menu-list">
                                        <li><a href="/pol-zhenskij">Ищу женщину</a></li>
                                        <li><a href="/orientaciya-lesbiyanka">Ищу лесбиянку</a></li>
                                        <li><a href="/pol-zhenskij/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 main-banner-item">
                            <div class="row">
                                <div class="col-5">
                                    <img class="baner-menu-img" src="/files/img/catwoman.png" alt="">
                                </div>
                                <div class="col-7">
                                    <ul class="banner-menu-list">
                                        <li><a href="/usluga-bdsm">Ищу BDSM</a></li>
                                        <li><a href="/usluga-gospogha">Ищу госпажу</a></li>
                                        <li><a href="/usluga-rabynya">Ищу рабыню</a></li>
                                        <li><a href="/usluga-gospodin">Ищу господина</a></li>
                                        <li><a href="/usluga-rab">Ищу раба</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 main-banner-item">
                            <div class="row">
                                <div class="col-5">
                                    <img class="baner-menu-img" src="/files/img/nick.png" alt="">
                                </div>
                                <div class="col-7">
                                    <ul class="banner-menu-list">
                                        <li><a href="/prostitutki">Ищу проститутку</a></li>
                                        <li><a href="/prostitutki/usluga-eroticheskiy">Ищу массажистку</a></li>
                                        <li><a href="/prostitutki/usluga-striptiz">Ищу стриптизершу</a></li>
                                        <li><a href="/prostitutki/usluga-eskort">Ищу эскорт девушку</a></li>
                                        <li><a href="/zhigalo">Ищу жигало</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">



                    <?php foreach ($posts as $post) : ?>

                        <?php echo $this->renderFile('@app/views/layouts/article.php', [
                            'post' => $post
                        ]) ?>

                    <?php endforeach; ?>


                </div>

            </div>


        </div>

    </div>

</div>
