<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\assets\AdminLteAsset;



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

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
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
                                <a href="/meta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Мета теги</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/page-mark" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Метки страниц</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/filter-params" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Параметры фильтров</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/feedback" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Обратная связь</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reting-message" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Рейтинг по сообщениям</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/black-list/index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Черный список</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/profile" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Пользователи</p>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
