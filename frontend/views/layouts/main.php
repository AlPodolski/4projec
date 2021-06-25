<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\LoginForm;

use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\modules\user\widgets\RegisterWidget;
use frontend\modules\user\widgets\LoginWidget;
use frontend\widgets\CityWidget;
use frontend\widgets\MetricaWidget;
use frontend\widgets\PopularWidget;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;
use frontend\modules\user\models\Photo;
use frontend\widgets\PhotoWidget;
AppAsset::register($this);


$login = new LoginForm();

if (!Yii::$app->user->isGuest) $this->registerJsFile('/files/js/cabinet.js?v=1', ['depends' => [\frontend\assets\AppAsset::className()]]);

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
    <link rel="preload" href="/files/fonts/HelveticaNeueCyr-Roman.woff" as="font">
    <link rel="preload" href="/files/fonts/HelveticaNeueCyr-Medium.ttf" as="font">
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
    <?php if (strpos(Yii::$app->request->url, 'page')) : ?>

        <link rel="canonical" href="/<?php echo strstr(Yii::$app->request->url, '/page' , true)?>"/>

    <?php endif; ?>
    <?php echo MetricaWidget::widget(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170464939-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-170464939-1');
    </script>-->
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <div id="sock-addr" data-url="<?php echo Yii::$app->params['websoket_addr'] ?>"></div>
    <audio src="/files/audio/alarm-clock-button-click_z17d0vno.mp3"></audio>
    <header>
        <div class="container">

            <div class="mobile-header">
                <div class="row">
                    <div class="col-5 col-sm-4 col-md-4">
                        <div class="logo">
                            <a href="/">
                                <img class="listing-img" width="160px" height="79px" src="/files/img/DOSUG.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-5 col-sm-6 col-md-6">
                        <?php echo CityWidget::widget() ?>
                    </div>
                    <div class="col-2">
                        <div class="mobile-icon">
                            <svg width="35" height="19" viewBox="0 0 35 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="35" height="3" rx="1.5" fill="#486BEF"/>
                                <rect y="16" width="35" height="3" rx="1.5" fill="#486BEF"/>
                                <rect x="15" y="8" width="20" height="3" rx="1.5" fill="#486BEF"/>
                            </svg>

                        </div>

                        <div class="mobile-menu">

                            <div class="mobile-icon mobile-icon-close">
                                <img src="/files/img/close-black.png" alt="" width="14px" height="14px">
                            </div>

                            <ul class="mobile-nav">

                                <?php if (!Yii::$app->user->isGuest) : ?>

                                    <?php echo UserSideBarWidget::Widget(['form_id' => 'header_form'])?>

                                <?php else : ?>

                                <li><a href="/znakomstva/pol-muzhskoj">Ищу мужчину</a></li>
                                <li><a href="/znakomstva/pol-zhenskij">Ищу женщину</a></li>
                                <li><a href="/polzovatelskoe-soglashenie">Пользовательское соглашение</a></li>
                                <li><a href="/adverts">Объявления</a></li>
                                <li onclick="getFeedBackForm()"><a href="#">Обратная связь</a></li>
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
                            <li onclick="getFeedBackForm()"><a href="#">Обратная связь</a></li>
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
        <div id="toTop">
            <svg width="39" height="40" viewBox="0 0 39 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.4286 39.2186C15.7202 39.2048 12.0993 38.0642 9.02376 35.941C5.94821 33.8177 3.55614 30.8073 2.15006 27.2903C0.74398 23.7732 0.387032 19.9076 1.12436 16.1823C1.86168 12.4569 3.66016 9.03913 6.29236 6.3611C8.92457 3.68308 12.2723 1.8651 15.9122 1.13706C19.552 0.409026 23.3206 0.803631 26.7413 2.27097C30.162 3.73832 33.0811 6.2125 35.1297 9.38064C37.1782 12.5488 38.264 16.2686 38.2499 20.0697C38.2309 25.1668 36.2374 30.0478 32.7077 33.6389C29.178 37.23 24.4014 39.2371 19.4286 39.2186ZM19.5619 3.34386C16.348 3.33191 13.2026 4.2971 10.5235 6.11737C7.84445 7.93764 5.752 10.5312 4.51077 13.5702C3.26954 16.6091 2.93529 19.9569 3.55029 23.1902C4.16529 26.4235 5.70191 29.3971 7.96584 31.735C10.2298 34.0728 13.1193 35.6699 16.2691 36.3243C19.4189 36.9787 22.6874 36.661 25.6614 35.4114C28.6354 34.1617 31.1812 32.0363 32.9769 29.3039C34.7727 26.5714 35.7377 23.3547 35.7499 20.0604C35.7663 15.6429 34.07 11.4 31.0342 8.26503C27.9984 5.13007 23.8717 3.35988 19.5619 3.34386Z" fill="#486BEF"/>
                <path d="M26.469 24.9844L19.5081 17.8091L12.4941 24.9324C12.259 25.1702 11.9417 25.3029 11.6115 25.3017C11.2813 25.3005 10.9649 25.1654 10.7316 24.9259C10.4997 24.6849 10.3702 24.3597 10.3715 24.0212C10.3728 23.6828 10.5046 23.3585 10.7383 23.1193L18.7186 15.0002C18.9323 14.785 19.2203 14.665 19.5198 14.6661C19.8194 14.6672 20.1064 14.7894 20.3186 15.0061L28.2382 23.1844C28.4701 23.4253 28.5996 23.7505 28.5984 24.089C28.5971 24.4275 28.4652 24.7517 28.2315 24.9909C27.9964 25.2287 27.6791 25.3614 27.3489 25.3602C27.0187 25.359 26.7023 25.2239 26.469 24.9844Z" fill="#486BEF"/>
            </svg>
        </div>
    </div>
</div>

<footer class="footer">
    <img width="88px" height="31px" src="//www.free-kassa.ru/img/fk_btn/18.png">
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

<div class="modal fade" id="modal-user-present" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="present-modal-content-wrap">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Подарки</h5>
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

<div class="modal fade" id="modal-buy-vip-for-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="present-modal-content-wrap">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 15.75L15.75 2.25" stroke="black" stroke-width="2"/>
                                <path d="M2.25 2.25L15.75 15.75" stroke="black" stroke-width="2"/>
                            </svg>
                        </span>
                </button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="no-content-wrap d-flex">
                                <div class="row">
                                    <h1 class="h1 w-100">Для отправки фото требуется Досуг <img src="/files/img/vip_icon.png" alt="VIP"></h1>
                                    <span class="blue-btn " data-toggle="modal" data-target="#modal-buy-vip">
                                         Подключить</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="present-form">

            </div>
        </div>
    </div>
</div>

<?php if (!Yii::$app->user->isGuest) : ?>

<?php

    $buyVipForm = new \frontend\models\forms\BuyVipStatusForm();
    $giftVipStatusForm = new \frontend\models\forms\GiftVipStatusForm();

?>

<div class="modal fade" id="modal-buy-vip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Приемущества Досуг <img src="/files/img/vip_icon.png" alt="VIP"></h5>
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

                    <?php $avatar = Photo::getAvatar(Yii::$app->user->id); ?>

                    <div class="anket-info">

                        <p class="text-center"> Люди с Досуг <img src="/files/img/vip_icon.png" alt="VIP"> получают вдвое больше сообщений!</p>

                        <ul>
                            <li>Не ограничено количество диалогов</li>
                            <li>Диалог с Вами всегда вверху и выделен ВИП иконкой</li>
                            <li>Отправка фото личным сообщением</li>
                            <li>Смотрите гостей на своей странице</li>
                            <li>Смотрите кому Вы понравились</li>
                        </ul>

                        <?php

                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'action' => '/vip/buy'
                        ])

                        ?>

                        <div class="user-image position-relative">

                            <?php echo PhotoWidget::widget([
                                'path' => $avatar['file'],
                                'size' => 'popular',
                                'options' => [
                                    'class' => 'img user-img user-to',
                                    'loading' => 'lazy',
                                    'alt' => Yii::$app->user->identity['username'],
                                ],
                            ]  ); ?>

                            <div class="vip-icon-wrap">
                                <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
                            </div>

                        </div>

                        <?php

                            $tarifParams = [
                                Yii::$app->params['vip_status_week_price'] => '7 дней '. Yii::$app->params['vip_status_week_price'].' рублей ',
                                Yii::$app->params['vip_status_three_month_price'] => '90 дней '. Yii::$app->params['vip_status_three_month_price'].' рублей',
                                Yii::$app->params['vip_status_month_price'] => '30 дней '. Yii::$app->params['vip_status_month_price'].' рублей',
                                Yii::$app->params['vip_status_day_price'] => '1 день '. Yii::$app->params['vip_status_day_price'] .' рублей',
                            ]

                        ?>

                        <?= $form->field($buyVipForm, 'sum')->dropDownList($tarifParams)->label(false); ?>

                        <?= Html::submitButton('Подключить', ['class' => 'blue-btn']) ?>

                        <?php ActiveForm::end() ?>

                        <div class="bottom">

                            <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1787 18.872C18.3337 18.872 18.4564 18.9954 18.4564 19.1497V19.2925C18.8374 19.3377 19.1603 19.4604 19.4568 19.647C19.5601 19.7052 19.6512 19.802 19.6512 19.957C19.6512 20.1579 19.4897 20.3116 19.2889 20.3116C19.2243 20.3116 19.1603 20.2929 19.0958 20.2535C18.8697 20.1185 18.6508 20.0216 18.4312 19.97V21.21C19.4129 21.4547 19.8314 21.848 19.8314 22.5397C19.8314 23.2501 19.2766 23.7203 18.4564 23.7985V24.186C18.4564 24.341 18.3343 24.4637 18.1787 24.4637C18.023 24.4637 17.8952 24.3416 17.8952 24.186V23.7862C17.4108 23.7345 16.9658 23.5589 16.5718 23.2818C16.462 23.2114 16.3975 23.1074 16.3975 22.9724C16.3975 22.7716 16.5525 22.6166 16.752 22.6166C16.8302 22.6166 16.907 22.6431 16.9651 22.6883C17.2693 22.9078 17.5658 23.0551 17.921 23.1197V21.848C16.9774 21.6033 16.5383 21.2474 16.5383 20.5183C16.5383 19.8285 17.0872 19.35 17.8945 19.286V19.1497C17.8951 18.996 18.0237 18.872 18.1787 18.872ZM17.9216 21.073V19.9312C17.5076 19.9693 17.301 20.1882 17.301 20.4724C17.301 20.7443 17.4243 20.9116 17.9216 21.073ZM18.4312 21.9714V23.1455C18.8439 23.1003 19.0693 22.893 19.0693 22.5843C19.0693 22.3008 18.9278 22.1251 18.4312 21.9714Z" fill="white"/>
                                <path d="M30.1546 30.0572H32.8994C33.6124 30.0572 34.1911 29.4786 34.1911 28.7656V14.5546C34.1911 13.8416 33.6124 13.263 32.8994 13.263H3.19108C2.47808 13.263 1.89941 13.8416 1.89941 14.5546V28.7656C1.89941 29.4786 2.47808 30.0572 3.19108 30.0572H26.3604" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.0451 26.6046C20.7759 26.6046 22.9896 24.3909 22.9896 21.6601C22.9896 18.9293 20.7759 16.7156 18.0451 16.7156C15.3143 16.7156 13.1006 18.9293 13.1006 21.6601C13.1006 24.3909 15.3143 26.6046 18.0451 26.6046Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M32.4019 13.2655L29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473L1.89922 13.8345" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M27.6573 10.6138L17.7715 13.263" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.04 8.12794L30.222 5.13192L31.422 9.60561L29.5387 10.11" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.66016 12.7844L15.4287 9.09605" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="">Ваш баланс : <?php echo Yii::$app->user->identity['cash'] ?> руб <a href="/user/balance">Пополнить</a></span>

                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-gift-vip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Подарить Досуг <img src="/files/img/vip_icon.png" alt="VIP"></h5>
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

                    <?php $avatar = Photo::getAvatar(Yii::$app->user->id); ?>

                    <div class="anket-info">

                        <?php

                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'action' => '/vip/gift'
                        ])

                        ?>

                        <div class="user-image position-relative">

                            <div class="gift-user-img">
                                <img src="" alt="">
                            </div>

                            <div class="vip-icon-wrap">
                                <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
                            </div>

                        </div>

                        <?php

                        $tarifParams = [
                            Yii::$app->params['vip_status_week_price'] => '7 дней '. Yii::$app->params['vip_status_week_price'].' рублей ',
                            Yii::$app->params['vip_status_three_month_price'] => '90 дней '. Yii::$app->params['vip_status_three_month_price'].' рублей',
                            Yii::$app->params['vip_status_month_price'] => '30 дней '. Yii::$app->params['vip_status_month_price'].' рублей',
                            Yii::$app->params['vip_status_day_price'] => '1 день '. Yii::$app->params['vip_status_day_price'] .' рублей',
                        ]

                        ?>

                        <?= $form->field($giftVipStatusForm, 'sum')->dropDownList($tarifParams)->label(false); ?>

                        <?= $form->field($giftVipStatusForm, 'toUser')
                            ->hiddenInput()->label(false) ?>



                        <?= Html::submitButton('Подарить', ['class' => 'blue-btn']) ?>

                        <?php ActiveForm::end() ?>

                        <div class="bottom">

                            <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1787 18.872C18.3337 18.872 18.4564 18.9954 18.4564 19.1497V19.2925C18.8374 19.3377 19.1603 19.4604 19.4568 19.647C19.5601 19.7052 19.6512 19.802 19.6512 19.957C19.6512 20.1579 19.4897 20.3116 19.2889 20.3116C19.2243 20.3116 19.1603 20.2929 19.0958 20.2535C18.8697 20.1185 18.6508 20.0216 18.4312 19.97V21.21C19.4129 21.4547 19.8314 21.848 19.8314 22.5397C19.8314 23.2501 19.2766 23.7203 18.4564 23.7985V24.186C18.4564 24.341 18.3343 24.4637 18.1787 24.4637C18.023 24.4637 17.8952 24.3416 17.8952 24.186V23.7862C17.4108 23.7345 16.9658 23.5589 16.5718 23.2818C16.462 23.2114 16.3975 23.1074 16.3975 22.9724C16.3975 22.7716 16.5525 22.6166 16.752 22.6166C16.8302 22.6166 16.907 22.6431 16.9651 22.6883C17.2693 22.9078 17.5658 23.0551 17.921 23.1197V21.848C16.9774 21.6033 16.5383 21.2474 16.5383 20.5183C16.5383 19.8285 17.0872 19.35 17.8945 19.286V19.1497C17.8951 18.996 18.0237 18.872 18.1787 18.872ZM17.9216 21.073V19.9312C17.5076 19.9693 17.301 20.1882 17.301 20.4724C17.301 20.7443 17.4243 20.9116 17.9216 21.073ZM18.4312 21.9714V23.1455C18.8439 23.1003 19.0693 22.893 19.0693 22.5843C19.0693 22.3008 18.9278 22.1251 18.4312 21.9714Z" fill="white"/>
                                <path d="M30.1546 30.0572H32.8994C33.6124 30.0572 34.1911 29.4786 34.1911 28.7656V14.5546C34.1911 13.8416 33.6124 13.263 32.8994 13.263H3.19108C2.47808 13.263 1.89941 13.8416 1.89941 14.5546V28.7656C1.89941 29.4786 2.47808 30.0572 3.19108 30.0572H26.3604" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.0451 26.6046C20.7759 26.6046 22.9896 24.3909 22.9896 21.6601C22.9896 18.9293 20.7759 16.7156 18.0451 16.7156C15.3143 16.7156 13.1006 18.9293 13.1006 21.6601C13.1006 24.3909 15.3143 26.6046 18.0451 26.6046Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M32.4019 13.2655L29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473L1.89922 13.8345" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M27.6573 10.6138L17.7715 13.263" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.04 8.12794L30.222 5.13192L31.422 9.60561L29.5387 10.11" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.66016 12.7844L15.4287 9.09605" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="">Ваш баланс : <?php echo Yii::$app->user->identity['cash'] ?> руб <a href="/user/balance">Пополнить</a></span>

                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-take-heart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Занять сердце</h5>
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

                    <?php $avatar = Photo::getAvatar(Yii::$app->user->id); ?>

                    <div class="">

                        <div class="get-heart-form-content">

                        </div>

                        <div class="bottom">

                            <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1787 18.872C18.3337 18.872 18.4564 18.9954 18.4564 19.1497V19.2925C18.8374 19.3377 19.1603 19.4604 19.4568 19.647C19.5601 19.7052 19.6512 19.802 19.6512 19.957C19.6512 20.1579 19.4897 20.3116 19.2889 20.3116C19.2243 20.3116 19.1603 20.2929 19.0958 20.2535C18.8697 20.1185 18.6508 20.0216 18.4312 19.97V21.21C19.4129 21.4547 19.8314 21.848 19.8314 22.5397C19.8314 23.2501 19.2766 23.7203 18.4564 23.7985V24.186C18.4564 24.341 18.3343 24.4637 18.1787 24.4637C18.023 24.4637 17.8952 24.3416 17.8952 24.186V23.7862C17.4108 23.7345 16.9658 23.5589 16.5718 23.2818C16.462 23.2114 16.3975 23.1074 16.3975 22.9724C16.3975 22.7716 16.5525 22.6166 16.752 22.6166C16.8302 22.6166 16.907 22.6431 16.9651 22.6883C17.2693 22.9078 17.5658 23.0551 17.921 23.1197V21.848C16.9774 21.6033 16.5383 21.2474 16.5383 20.5183C16.5383 19.8285 17.0872 19.35 17.8945 19.286V19.1497C17.8951 18.996 18.0237 18.872 18.1787 18.872ZM17.9216 21.073V19.9312C17.5076 19.9693 17.301 20.1882 17.301 20.4724C17.301 20.7443 17.4243 20.9116 17.9216 21.073ZM18.4312 21.9714V23.1455C18.8439 23.1003 19.0693 22.893 19.0693 22.5843C19.0693 22.3008 18.9278 22.1251 18.4312 21.9714Z" fill="white"/>
                                <path d="M30.1546 30.0572H32.8994C33.6124 30.0572 34.1911 29.4786 34.1911 28.7656V14.5546C34.1911 13.8416 33.6124 13.263 32.8994 13.263H3.19108C2.47808 13.263 1.89941 13.8416 1.89941 14.5546V28.7656C1.89941 29.4786 2.47808 30.0572 3.19108 30.0572H26.3604" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.0451 26.6046C20.7759 26.6046 22.9896 24.3909 22.9896 21.6601C22.9896 18.9293 20.7759 16.7156 18.0451 16.7156C15.3143 16.7156 13.1006 18.9293 13.1006 21.6601C13.1006 24.3909 15.3143 26.6046 18.0451 26.6046Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M32.4019 13.2655L29.6029 2.82048C29.4343 2.18821 28.7853 1.81427 28.1549 1.98413L1.8779 9.02436C1.24563 9.19421 0.871051 9.84198 1.04091 10.473L1.89922 13.8345" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M27.6573 10.6138L17.7715 13.263" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19.04 8.12794L30.222 5.13192L31.422 9.60561L29.5387 10.11" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.66016 12.7844L15.4287 9.09605" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <span class="">Ваш баланс : <?php echo Yii::$app->user->identity['cash'] ?> руб <a href="/user/balance">Пополнить</a></span>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

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

</body>
</html>
<?php $this->endPage() ?>
