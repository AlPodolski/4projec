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
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
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
                                <a class="in-cabinet" data-toggle="modal" data-target="#modal-in" aria-hidden="true">
                                    <i class="fa fa-user"></i>
                                    Вход
                                </a>
                            </div>

                        <?php else : ?>

                                <div class="col-3 cabinet-btn" >

                                    <a href="/user" class="in-cabinet" >
                                        <i class="fa fa-user"></i>
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">

</footer>

<!-- Modal -->
<div class="modal fade" id="modal-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Войти</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php echo LoginWidget::widget(); ?>

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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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

                <div class="city-wrap"></div>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="messageModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Написать сообщение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-city-search">

            <?php echo \frontend\modules\chat\widgets\SendMessageFormWidget::widget(); ?>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
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
<?php echo MetricaWidget::widget(); ?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
