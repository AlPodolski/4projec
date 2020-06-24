<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\LoginForm;

use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\assets\FontAwesomeAsset;
use common\widgets\Alert;
use frontend\modules\user\widgets\RegisterWidget;
use frontend\modules\user\widgets\LoginWidget;
use frontend\widgets\CityWidget;
use frontend\widgets\MetricaWidget;
use frontend\widgets\PopularWidget;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;
AppAsset::register($this);
FontAwesomeAsset::register($this);

$login = new LoginForm();



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="/files/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/files/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/files/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/files/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/files/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/files/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/files/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/files/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/files/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/files/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/files/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/files/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/files/favicons/favicon-16x16.png">
    <link rel="manifest" href="/files/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170464939-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-170464939-1');
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <header>
        <div class="container">
            <div class="mobile-header">
                <div class="row">
                    <div class="col-5 col-sm-4 col-md-4">
                        <div class="logo">
                            <a href="/">
                                <img src="/files/img/DOSUG.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-5 col-sm-6 col-md-6">
                        <?php echo CityWidget::widget() ?>
                    </div>
                    <div class="col-2">
                        <div class="mobile-icon">
                            <i class="fas fa-bars"></i>
                        </div>

                        <div class="mobile-menu">
                            <ul class="mobile-nav">
                                <div class="icon-close">
                                    <i class="fas fa-times"></i>
                                </div>
                                <?php if (!Yii::$app->user->isGuest) : ?>

                                    <?php echo UserSideBarWidget::Widget(['form_id' => 'header_form'])?>

                                <?php else : ?>

                                <li><a href="/znakomstva/pol-muzhskoj">Ищу мужчину</a></li>
                                <li><a href="/znakomstva/pol-zhenskij">Ищу женщину</a></li>
                                <li><a href="/polzovatelskoe-soglashenie">Пользовательское соглашение</a></li>
                                <li><a href="/adverts">Объявления</a></li>
                                <li data-toggle="modal" data-target="#modal-feed-back" aria-hidden="true"><a href="#">Обратная связь</a></li>
                                <!--<li><a href="/novosti">Новости сайта</a></li>-->

                                <li>
                                    <?php if (Yii::$app->user->isGuest) : ?>

                                        <a class="in-cabinet" data-toggle="modal" data-target="#modal-in" aria-hidden="true">
                                            <i class="fa fa-user"></i>
                                            Вход
                                        </a>

                                    <?php else : ?>

                                        <a href="/user" class="in-cabinet" >
                                            <i class="fa fa-user"></i>
                                            Кабинет
                                        </a>

                                    <?php endif; ?>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="top-menu">
                <div class="row">
                    <div class="col-2">
                        <?php echo CityWidget::widget() ?>
                    </div>
                    <div class="col-7">
                        <ul class="top-nav">
                            <li><a href="/polzovatelskoe-soglashenie">Пользовательское соглашение</a></li>
                            <li><a href="/adverts">Объявления</a></li>
                            <li data-toggle="modal" data-target="#modal-feed-back" aria-hidden="true"><a href="#">Обратная связь</a></li>
                            <!--<li><a href="/novosti">Новости сайта</a></li>-->
                        </ul>
                    </div>


                        <?php if (Yii::$app->user->isGuest) : ?>
                            <div class="col-3 cabinet-btn" >
                                <a class="type-btn" data-toggle="modal" data-target="#modal-in" aria-hidden="true">
                                    Вход
                                </a>
                            </div>

                        <?php else : ?>

                                <div class="col-3 cabinet-btn" >

                                    <a href="/user" class="type-btn" >
                                        Кабинет
                                    </a>
                                </div>

                        <?php endif; ?>

                </div>
            </div>
            <div class="bottom-menu">
                <div class="row">
                    <div class="col-2">
                        <div class="logo">
                            <a href="/">
                                <img src="/files/img/DOSUG.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-7">
                        <ul class="top-nav">
                            <li><a href="/znakomstva/pol-muzhskoj">Ищу мужчину</a></li>
                            <li><a href="/znakomstva/pol-zhenskij">Ищу женщину</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </header>

    <?php echo PopularWidget::widget(); ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <img src="//www.free-kassa.ru/img/fk_btn/18.png">
</footer>

<!-- Modal -->
<div class="modal fade" id="modal-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Войти</h5>
            </div>
            <div class="modal-body">

                <?php echo LoginWidget::widget(); ?>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="foto-ryad-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">



            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Регистрация</h5>
            </div>
            <div class="modal-body">

                <?php echo RegisterWidget::widget(); ?>

            </div>
        </div>
    </div>
</div>

<div id="cityModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Выбрать город</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-city-search">

                <input type="text" name="city" class="form-control city-search" placeholder="Ввидите название города:">

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

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php if (!Yii::$app->user->isGuest) : ?>

<div id="messageModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.25 14.75L14.75 1.25" stroke="black" stroke-width="2"/>
                        <path d="M1.25 1.25L14.75 14.75" stroke="black" stroke-width="2"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body modal-city-search">

                <?php echo \frontend\modules\chat\widgets\SendMessageFormWidget::widget(); ?>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="addAdvertModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.25 14.75L14.75 1.25" stroke="black" stroke-width="2"/>
                        <path d="M1.25 1.25L14.75 14.75" stroke="black" stroke-width="2"/>
                    </svg>
                </button>
            </div>

            <div class="modal-body modal-city-search">

                <?php $advertForm = ActiveForm::begin(); ?>

                <?php $modelAdvert = new \frontend\modules\advert\models\Advert() ?>

                <div class="col-12">

                    <p class="name heading-anket">Создать обьявление</p>

                    <?= $advertForm->field($modelAdvert, 'title')->textInput([ 'placeholder' => 'Название заголовка' , 'id' => '' ])->label(false) ?>

                    <?= $advertForm->field($modelAdvert, 'text')->textarea(['placeholder' => 'Расскажите о ваших пожелениях....' , 'id' => ''])->label(false) ?>

                </div>

                <div class="col-12">

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'type-btn']) ?>
                    </div>

                </div>

                <?php ActiveForm::end() ?>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php endif; ?>

<div id="modal-feed-back" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Обратная связь</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-city-search">
                <?php  echo \frontend\widgets\FeedBackFormWidget::widget() ?>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-present" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="present-modal-content-wrap">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Выбрать подарок</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 15.75L15.75 2.25" stroke="black" stroke-width="2"/>
                                <path d="M2.25 2.25L15.75 15.75" stroke="black" stroke-width="2"/>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php  ?>

                </div>
            </div>
            <div class="present-form">

            </div>
        </div>
    </div>
</div>

<?php echo MetricaWidget::widget(); ?>

<script>
    function registerServiceWorker() {
        // регистрирует скрипт sw в поддерживаемых браузерах
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js', { scope: '/' }).then(() => {
                console.log('Service Worker registered successfully.');
            }).catch(error => {
                console.log('Service Worker registration failed:', error);
            });
        }
    }
    registerServiceWorker();
</script>

<?php $this->endBody() ?>
<link rel="preload" href="/files/slick/slick.css" as="style" />
<link rel="preload" href="/files/slick/slick-theme.css" as="style" />
<link rel="preload" href="/files/slick/fonts/slick.woff" as="font" />
<link rel="stylesheet" href="/files/slick/slick-theme.css">
<link rel="stylesheet" href="/files/slick/slick.css">

</body>
</html>
<?php $this->endPage() ?>
