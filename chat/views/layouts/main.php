<?php

/* @var $this \yii\web\View */
/* @var $content string */

use chat\assets\AppAsset;
use common\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AdminLteAsset;
use frontend\widgets\MetricaWidget;


AppAsset::register($this);
FontAwesomeAsset::register($this);
AdminLteAsset::register($this);
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
    <?php echo MetricaWidget::widget(); ?>
</head>

<body class="skin-blue sidebar-mini wrapper sidebar-collapse">
<?php $this->beginBody() ?>
<header>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
</header>
<div class="wrap">
    <div id="sock-addr" data-url="<?php echo Yii::$app->params['websoket_addr'] ?>"></div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i> <p>Страницы</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Главная</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/site/all" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Все диалоги</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/site/promo" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Диалоги из рекламы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/site/logout" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Выйти</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer navbar-fixed-bottom row-fluid">

</footer>


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

                </div>
            </div>
            <div class="present-form">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="present-modal-content-wrap">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Выбрать фото</h5>
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

                </div>
            </div>
        </div>
    </div>
</div>

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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
