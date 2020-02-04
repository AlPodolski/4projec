<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\LoginForm;

use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;
use frontend\modules\user\widgets\RegisterWidget;
use frontend\modules\user\widgets\LoginWidget;
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
                        <div class="place">
                            <span>Местоположение : </span>
                            <span class="place-city">Москва</span>
                        </div>
                    </div>
                    <div class="col-7">
                        <ul class="top-nav">
                            <li>пользовательское соглашение</li>
                            <li>объявления</li>
                            <li>вопросы и ответы</li>
                            <li>новости сайта</li>
                        </ul>
                    </div>
                    <div class="col-3 cabinet-btn" data-toggle="modal" data-target="#modal-in" aria-hidden="true">

                        <?php if (Yii::$app->user->isGuest) : ?>

                            <a class="in-cabinet" >
                                <i class="fa fa-user" ></i>
                                Вход
                            </a>

                        <?php endif; ?>

                    </div>

                </div>
            </div>
            <div class="bottom-menu">
                <div class="row">
                    <div class="col-2">
                        <div class="logo">
                            <img src="files/img/DOSUG.png" alt="">
                        </div>
                    </div>
                    <div class="col-7">
                        <ul class="top-nav">
                            <li>ищу мужчину</li>
                            <li>ищу женщину </li>
                            <li>БДСМ</li>
                            <li>$ интим $</li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <div class="search-block">
                            <a ><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
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
