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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <header>
        <div class="container">
            <div class="top-menu">
                <div class="row">
                    <div class="col-2">
                        <?php echo CityWidget::widget() ?>
                    </div>
                    <div class="col-7">
                        <ul class="top-nav">
                            <li><a href="/polzovatelskoe-soglashenie">пользовательское соглашение</a></li>
                            <li><a href="/adverts">объявления</a></li>
                            <li><a href="/novosti">новости сайта</a></li>
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
                            <li><a href="/znakomstva/pol-muzhskoj">ищу мужчину</a></li>
                            <li><a href="/znakomstva/pol-zhenskij">ищу женщину</a></li>
                            <li>
                                <a href="#">БДСМ</a>
                                <ul class="secodn-menu">
                                    <li><a href="/znakomstva/usluga-bdsm">Ищу BDSM</a></li>
                                    <li><a href="/znakomstva/usluga-gospogha">Ищу госпажу</a></li>
                                    <li><a href="/znakomstva/usluga-rabynya">Ищу рабыню</a></li>
                                    <li><a href="/znakomstva/usluga-gospodin">Ищу господина</a></li>
                                    <li><a href="/znakomstva/usluga-rab">Ищу раба</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">$ интим $</a>
                                <ul class="secodn-menu">
                                    <li><a href="/prostitutki">Ищу проститутку</a></li>
                                    <li><a href="/prostitutki/usluga-eroticheskiy">Ищу массажистку</a></li>
                                    <li><a href="/prostitutki/usluga-striptiz">Ищу стриптизершу</a></li>
                                    <li><a href="/prostitutki/usluga-eskort">Ищу эскорт девушку</a></li>
                                    <li><a href="/zhigalo">Ищу жигало</a></li>
                                </ul>
                            </li>
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


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
