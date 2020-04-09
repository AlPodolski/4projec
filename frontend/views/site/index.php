<?php

/* @var $this yii\web\View */
/* @var $city string */
/* @var $title string */
/* @var $des string */
/* @var $h1 string */
/* @var $posts Profile[] */

use frontend\modules\user\models\Profile;
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;
$this->title = $title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);
$this->registerJsFile('/files/js/page_a.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php if (!empty(Yii::$app->view->params['marks'])) : ?>

                <?php echo Yii::$app->view->params['marks'] ?>

            <?php endif; ?>

            <?php echo PopularWidget::widget(['city' => $city]); ?>

        </div>

        <div class="row">


                <?php
                    echo SidebarWidget::Widget()
                ?>



            <div class="col-12 col-xl-9 main-banner-wrap">
                <div class="main-banner">
                    <div class="row">
                        <div class="col-12">
                            <h1><?php echo $h1 ?></h1>
                            <div class="text-main">
                                <p>Если Вы хотите стать счастливым человеком, а в обычной жизни никак не получается найти свою любовь, испытайте удачу и попробуйте познакомиться бесплатно на сайте знакомств 4dosug .  А интернет сближает людей, проживающих на разных краях необъятной родины. Никто за Вас не сделает первый шаг, смелее бесплатно регистрируйтесь и ищите свою вторую половину!  </p>
                            </div>
                        </div>
                    </div>

                    <div class="row banner-wrap">

                        <div class="col-12">
                            <h5>Выберите раздел для поиска секса:</h5>
                        </div>
                        <div class="col-6 main-banner-item">
                            <div class="row">
                                <div class="col-5">
                                    <img class="baner-menu-img" src="/files/img/dandy.png" alt="">
                                </div>
                                <div class="col-7">
                                    <ul class="banner-menu-list small-nav">
                                        <li><a href="/znakomstva/pol-muzhskoj">Ищу мужчину</a></li>
                                        <li><a href="/znakomstva/orientaciya-gei">Ищу гея</a></li>
                                        <li><a href="/znakomstva/pol-muzhskoj/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
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
                                    <ul class="banner-menu-list small-nav">
                                        <li><a href="/znakomstva/pol-zhenskij">Ищу женщину</a></li>
                                        <li><a href="/znakomstva/orientaciya-lesbiyanka">Ищу лесбиянку</a></li>
                                        <li><a href="/znakomstva/pol-zhenskij/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row main-banner-wrap-mobile">

                        <div class="col-12">
                            <h5>Выберите раздел для поиска секса:</h5>
                        </div>
                        <div class="banner-item-wrap">
                            <div class=" main-banner-item">
                                <div class="row">
                                    <div class="col-5">
                                        <img class="baner-menu-img" src="/files/img/dandy.png" alt="">
                                    </div>
                                    <div class="col-7">
                                        <ul class="banner-menu-list small-nav">
                                            <li><a href="/znakomstva/pol-muzhskoj">Ищу мужчину</a></li>
                                            <li><a href="/znakomstva/orientaciya-gei">Ищу гея</a></li>
                                            <li><a href="/znakomstva/pol-muzhskoj/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="main-banner-item">
                                <div class="row">
                                    <div class="col-5">
                                        <img class="baner-menu-img" src="/files/img/canary.png" alt="">
                                    </div>
                                    <div class="col-7">
                                        <ul class="banner-menu-list small-nav">
                                            <li><a href="/znakomstva/pol-zhenskij">Ищу женщину</a></li>
                                            <li><a href="/znakomstva/orientaciya-lesbiyanka">Ищу лесбиянку</a></li>
                                            <li><a href="/znakomstva/pol-zhenskij/materialnoe-polozhenie-gotov-stat-sponsorom">Ищу спонсора</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row content">

                    <?php foreach ($posts as $post) : ?>

                        <?php echo $this->renderFile('@app/views/layouts/article.php', [
                            'post' => $post
                        ]) ?>

                    <?php endforeach; ?>



                </div>

            </div>

            <div class="col-12 pager" data-page="1" data-url="/" data-reqest="<?php echo Yii::$app->request->url ?>"></div>

        </div>

    </div>

</div>
