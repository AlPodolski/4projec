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
            <a class="<?php if ($_SERVER['REQUEST_URI'] == '/') echo 'selected' ?> main-menu" href="/">Все</a>
            <a class="<?php if ($_SERVER['REQUEST_URI'] == '/znakomstva/pol-zhenskij') echo 'selected' ?> main-menu" href="/znakomstva/pol-zhenskij">Женщины</a>
            <a class="<?php if ($_SERVER['REQUEST_URI'] == '/znakomstva/pol-muzhskoj') echo 'selected' ?> main-menu" href="/znakomstva/pol-muzhskoj">Мужчины</a>
            <div class="mobile-filter-icon open-filter">
                <i class="fas fa-filter"></i>
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

            <div class="col-3 filter-sidebar">



                <?php if (!Yii::$app->user->isGuest) : ?>

                    <?php echo UserSideBarWidget::Widget()?>

                <?php endif; ?>

                <?php
                    echo SidebarWidget::Widget()
                ?>
            </div>


            <div class="col-12 col-xl-9 main-banner-wrap margin-bottom-30">


                <div class="row ">

                    <div data-url="/" class="col-12"></div>

                    <?php foreach ($posts as $post) : ?>

                        <?php echo $this->renderFile('@app/views/layouts/article.php', [
                            'post' => $post,
                            'cityInfo' => $cityInfo,
                        ]) ?>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="col-12 col-xl-12  margin-top-10">

                <div class="row">
                    <div class="col-12">
                        <div class="jasto-ijut start-search open-filter">
                            Начать поиск
                        </div>
                    </div>
                </div>

                <h5>Чаще всего ищут:</h5>
                <div class="row">
                    <div class="col-6"><a class="jasto-ijut" href="/znakomstva/celi-znakomstva-realynyy-seks/pol-zhenskij">Девушку для секса</a></div>
                    <div class="col-6"><a class="jasto-ijut" href="/znakomstva/celi-znakomstva-realynyy-seks/pol-muzhskoj">Мужчину для секса</a></div>
                    <div class="col-6"><a class="jasto-ijut" href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/kogo-ishchu-pyyu-v-kompaniyah-izredka/pol-muzhskoj">Мужчину для отношений</a></div>
                    <div class="col-6"><a class="jasto-ijut" href="/znakomstva/celi-znakomstva-lyubovy-i-otnosheniya/kogo-ishchu-pyyu-v-kompaniyah-izredka/pol-zhenskij">Девушку для отношений</a></div>
                </div>
                <div class="text-main">
                    <p>Если Вы хотите стать счастливым человеком, а в обычной жизни никак не получается найти свою любовь, испытайте удачу и попробуйте познакомиться бесплатно на сайте знакомств 4dosug .  А интернет сближает людей, проживающих на разных краях необъятной родины. Никто за Вас не сделает первый шаг, смелее бесплатно регистрируйтесь и ищите свою вторую половину!  </p>
                </div>
                <h5>Другие города</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="another-city-list">
                            <div class="city-wrap">
                                <ul class="city-list">
                                    <li><a href="https://msk.4dosug.com/">Москва</a></li>
                                    <li><a href="https://sankt-piterburg.4dosug.com">Санкт-Петербург</a></li>
                                    <li><a href="https://novosibirsk.4dosug.com">Новосибирск</a></li>
                                    <li><a href="https://ekaterinburg.4dosug.com">Екатеринбург</a></li>
                                    <li><a href="https://nizhniy-novgorod.4dosug.com">Нижний Новгород</a></li>
                                    <li><a href="https://kazan.4dosug.com">Казань</a></li>
                                    <li><a href="https://chelyabinsk.4dosug.com">Челябинск</a></li>
                                    <li><a href="https://omsk.4dosug.com">Омск</a></li>
                                    <li><a href="https://samara.4dosug.com">Самара</a></li>
                                    <li><a href="https://rostov-na-dony.4dosug.com">Ростов-на-Дону</a></li>
                                    <li><a href="https://ufa.4dosug.com">Уфа</a></li>
                                    <li><a href="https://voronezh.4dosug.com">Воронеж</a></li>
                                    <li><a href="https://perm.4dosug.com">Пермь</a></li>
                                    <li><a href="https://volgograd.4dosug.com">Волгоград</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 margin-top-10">
                <h5>Еще анкеты : </h5>
            </div>

            <div class="col-12 col-xl-12 main-banner-wrap margin-top-10">


                <div class="row content">



                </div>

            </div>

            <div class="col-12 pager" data-page="1" data-url="/"
                 data-reqest="<?php echo Yii::$app->request->url ?>"
                 data-accept="<?php echo Yii::$app->request->headers->get('Accept') ?>"></div>

        </div>

    </div>

</div>
