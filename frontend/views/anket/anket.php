<?php

use common\models\City;
use common\models\Params;
use common\models\Price;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\assets\SlickAsset;
use yii\widgets\ActiveForm;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\FriendsRequestHelper;

/* @var $model Profile */
/* @var $group array */
/* @var $userFriends array */
/* @var $userHeart array */

$this->registerJsFile('/files/js/lightgallery-all.min.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.carousel.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.navigation.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->registerCssFile('/css/lightgallery.min.css');
$this->registerCssFile('/css/owl.carousel.min.css');
$this->registerCssFile('/css/owl.theme.default.min.css');

SlickAsset::register($this);

$this->registerJsFile('/files/js/single.js?v=7', ['depends' => [SlickAsset::className()]]);

$photo = Photo::getUserphoto($model->id);
$params = Params::find()->asArray()->all();
$price = Price::find()->asArray()->all();

$metro = $model->getMetro();
$rayon = $model->getRayon();

$addWallForm = new \frontend\modules\wall\models\forms\AddToWallForm();

$userPresent = \frontend\models\relation\UserPresents::find()->where(['to' => $model->id])->with('present')->all();

if ($model) {
    $service = $model->getService();
    $postPrice = $model->getUserPrice();
}
//фото для формы отправки сообщения
if (!Yii::$app->user->isGuest) {

    $userPhoto = Photo::getAvatar(Yii::$app->user->id);

}

\frontend\assets\LightGalleryAsset::register($this);
?>

<div class="anket">

    <?php

    $cookies = Yii::$app->request->cookies;

    if ( Yii::$app->user->isGuest and ($cookie = $cookies->get('invitation-message') === null)) : ?>

    <div class="message-event d-none" >
        <div class="row">
            <div class="col-12 new-message-text" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                Новое сообщение
            </div>
            <div class="col-3" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                <a class="post_image">
                    <img loading="lazy" class="img" srcset="" alt="">
                </a>
            </div>
            <div class="col-9" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                <div class="row">
                    <div class="col-12 message-text">
                        Привет...
                    </div>
                </div>
            </div>
        </div>
        <div class="close-message" onclick="close_message_event(this)">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <?php endif; ?>

    <div class="row">

        <div class="col-12">
            <div class="page-block main-info-anket">
                <div class="row">
                    <div class="col-12 col-xl-4 col-lg-4 col-md-6 position-relative">

                        <?php if ($model['vip_status_work'] > time()) : ?>

                            <div class="vip-icon-wrap single-vip">
                                <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
                            </div>

                        <?php endif; ?>

                        <?php if ($model->email == 'adminadultero@mail.com') : ?>

                            <div class="online-single"></div>

                        <?php endif; ?>


                        <div class="post-photo">

                            <?php if (!empty($photo)) : ?>

                                <?php foreach ($photo as $item) : ?>

                                    <?php if ($item['avatar'] == 1) : ?>

                                    <?php $ava = $item['file']; ?>

                                        <?php if (file_exists(Yii::getAlias('@webroot') . $item['file']) and $item['file']) : ?>

                                            <picture>

                                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-510') ?>"
                                                        media="(max-width: 767px)">
                                                <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-main') ?>">
                                                <img loading="lazy" class="img "
                                                     srcset="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-main') ?>"
                                                     alt="">

                                            </picture>

                                        <?php else : ?>

                                            <div class="img-wrap d-flex no-photo">
                                                <img srcset="/files/img/nophoto.png" alt="">
                                            </div>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <div class="img-wrap d-flex no-photo">
                                    <img srcset="/files/img/nophoto.png" alt="">
                                </div>

                            <?php endif; ?>

                            <?php if (!Yii::$app->user->isGuest and $model->id == Yii::$app->user->id) : ?>

                                <?php

                                $photoModel = new Photo();

                                $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data', 'id' => 'under-avatar-form']]);

                                ?>

                                <div class="img-label-wrap">
                                    <label for="under-avatar-form-input" class="">

                                        <span> <i class="fas fa-upload"></i> Загрузить фото </span>

                                        <?= $form->field($photoModel, 'file')
                                            ->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'under-avatar-form-input'])
                                            ->label(false) ?>

                                    </label>
                                </div>

                                <?php ActiveForm::end();

                                ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-12 col-xl-8 col-lg-8 col-md-6">
                        <div class="anket-info">
                            <div class="anket-info-content">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row ">

                                            <div class="col-7">
                                                <div class="name">
                                                    <?php echo explode(' ', $model->username)[0]; ?>
                                                    <?php if ($model->birthday) { ?>
                                                        <span class="old">
                                                        <?php echo \frontend\components\YearHelper::Year((time() - $model->birthday) / 31556926); ?>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <?php

                                                $city = City::getCity($model->city);

                                                ?>
                                                <div class="city">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.0002 12.9065C12.7974 12.9065 15.0649 10.6389 15.0649 7.84173C15.0649 5.04455 12.7974 2.77699 10.0002 2.77699C7.20299 2.77699 4.93542 5.04455 4.93542 7.84173C4.93542 10.6389 7.20299 12.9065 10.0002 12.9065Z"
                                                              fill="#486BEF" stroke="#486BEF" stroke-miterlimit="10"/>
                                                        <path d="M9.99989 10.8345C11.6528 10.8345 12.9927 9.4946 12.9927 7.84172C12.9927 6.18884 11.6528 4.84892 9.99989 4.84892C8.347 4.84892 7.00708 6.18884 7.00708 7.84172C7.00708 9.4946 8.347 10.8345 9.99989 10.8345Z"
                                                              fill="white"/>
                                                        <path d="M10 17.4101C9.8705 17.4101 9.68345 17.223 9.68345 17.223C4.21582 10.9353 4.93525 7.84173 4.93525 7.84173C4.93525 7.84173 6.51798 12.8921 10 12.9065"
                                                              fill="#486BEF"/>
                                                        <path d="M10 17.4101C10.1295 17.4101 10.3165 17.223 10.3165 17.223C15.7842 10.9353 15.0647 7.84173 15.0647 7.84173C15.0647 7.84173 13.482 12.8921 10 12.9065"
                                                              fill="#486BEF"/>
                                                    </svg>
                                                    <?php echo $city['city'] ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php if (!empty($model['celiZnakomstvamstva'])) : ?>
                                    <div class="row info-block celi-znakomsva-block">

                                        <div class="col-12">

                                            <div class="label fl_l">Цели знакомства:</div>

                                            <div class="labeled"> <?php foreach ($model['celiZnakomstvamstva'] as $item) echo '<a href="/znakomstva/celi-znakomstva-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?> </div>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="like-wrap info-block">
                                    <div class="row">

                                        <div class=" col-6 col-md-6 col-lg-4 message-col">
                                            <div class="message-wrap">

                                                <div class="message write-message"
                                                    <?php if (!Yii::$app->user->isGuest and (Yii::$app->user->id != $model->id)) : ?>
                                                        onclick="get_message_form(this)"
                                                        data-user-id="<?php echo $model->id ?>"
                                                    <?php elseif (Yii::$app->user->isGuest) : ?>
                                                        data-toggle="modal" data-target="#modal-in" aria-hidden="true"
                                                    <?php endif; ?> >

                                                    Написать
                                                </div>

                                                <?php
                                                /*если пользователь не в друзьях и не отправлял заявку в друзья добавляем возможность добавление в друзья*/
                                                if (Yii::$app->user->isGuest or
                                                    (!FriendsHelper::isFiends(Yii::$app->user->id, $model->id)
                                                        and !$isFriendsRequestFrom = FriendsRequestHelper::isFiendsRequest($model->id, Yii::$app->user->id)
                                                        and !$isFriendsRequestTo = FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id, $model->id))) {
                                                    $onclick = 'onclick="addToFriendsListing(this)"';
                                                } else {
                                                    $onclick = '';
                                                }
                                                if (Yii::$app->user->isGuest) {
                                                    $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                                                }
                                                ?>

                                                <div data-id="<?php echo $model->id ?>"
                                                     class="add-to-friends-listing message"
                                                     data-message="<?php if (Yii::$app->user->isGuest) echo 'Требуется авторизация' ?>"
                                                    <?php echo $onclick ?>>
                                                    <?php if (!Yii::$app->user->isGuest and FriendsHelper::isFiends(Yii::$app->user->id, $model->id)) : ?>
                                                        <span class="show-message" data-message="Ваш друг">
                                                         <i class="fas fa-user-friends"></i>
                                                    </span>
                                                    <?php elseif (!Yii::$app->user->isGuest and isset($isFriendsRequestTo) and $isFriendsRequestTo) : ?>
                                                        <span class="show-message" data-message="Заявка отправлена">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <?php elseif (!Yii::$app->user->isGuest and $isFriendsRequestFrom) : ?>
                                                        <span class="show-message" data-message="Принять заявку"
                                                              onclick="check_friend_request_listing(this)"
                                                              data-user-id="<?php echo $model->id ?>">
                                                        <i class="fas fa-user-check"></i>
                                                    </span>
                                                    <?php else : ?>
                                                        <span class="show-message" data-message="Добавить в друзья">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (Yii::$app->user->isGuest) : ?>
                                            <?php
                                            $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                                            ?>
                                        <?php else : ?>
                                            <?php
                                            $onclick = 'onclick="get_presents(this)"';
                                            ?>
                                        <?php endif; ?>
                                        <div class="col-4 col-md-3 col-lg-3" <?php echo $onclick ?>
                                             data-user-id="<?php echo $model['id'] ?>">
                                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF"
                                                      stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                                <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF"
                                                      stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                                <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54"
                                                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10"
                                                      stroke-linecap="round"/>
                                                <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z"
                                                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z"
                                                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative margin-top-10 gift-vip"
                                        <?php if ($ava and file_exists(Yii::getAlias('@webroot') . $ava) and $ava) : ?>
                                             data-img="<?php echo Yii::$app->imageCache->thumbSrc($ava, 'popular'); ?>"
                                        <?php else : ?>
                                            data-img="/files/img/nophoto.png"
                                        <?php endif; ?>
                                             data-id="<?php echo $model['id']?>" onclick="get_gift_vip_modal(this)">
                                            <img src="/files/img/vip_icon.png" alt="VIP">
                                            <div class="text vip-text">
                                            <a href="#"> Подарить VIP</a> </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($userHeart) : ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative get-heart margin-top-10">

                                                <a href="/user/<?php echo $userHeart['who']?>">

                                                <div class="post_image">
                                                    <?php echo \frontend\widgets\PhotoWidget::widget([
                                                        'path' => $userHeart['buyer']['avatar']['file'],
                                                        'size' => 'dialog',
                                                        'options' => [
                                                            'class' => 'img',
                                                            'loading' => 'lazy',
                                                            'alt' => $userHeart['buyer']['username'],
                                                        ],
                                                    ]); ?>
                                                </div>

                                                </a>

                                                <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">

                                                <span class="get-heart-text"> Сердце занято </span>

                                            </div>
                                        </div>
                                    </div>

                                <?php else : ?>

                                <?php if (Yii::$app->user->isGuest) : ?>
                                    <?php
                                    $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                                    $attributes = '';
                                    ?>
                                <?php else : ?>

                                    <?php

                                    if(Yii::$app->user->id != $model['id']){

                                        $attributes = 'data-buyer="'.Yii::$app->user->id.'" ';
                                        $attributes .= ' data-userWhoHeartIsBuy="'.$model['id'].'" ';
                                        $onclick = 'onclick="get_take_heart_form(this)"';

                                    }else $onclick = '';

                                    ?>
                                <?php endif; ?>

                                <div class="row" >
                                    <div class="col-12">
                                        <div class="position-relative get-heart margin-top-10"
                                            <?php if ($ava and file_exists(Yii::getAlias('@webroot') . $ava) and $ava) : ?>
                                                data-img="<?php echo Yii::$app->imageCache->thumbSrc($ava, 'popular'); ?>"
                                            <?php else : ?>
                                                data-img="/files/img/nophoto.png"
                                            <?php endif; ?>
                                            <?php echo $onclick ?> <?php echo $attributes ?>>

                                            <?php $buyerAvatar = Photo::getAvatar(Yii::$app->user->id); ?>

                                            <div class="post_image">
                                                <?php echo \frontend\widgets\PhotoWidget::widget([
                                                    'path' => $buyerAvatar['file'],
                                                    'size' => 'dialog',
                                                    'options' => [
                                                        'class' => 'img',
                                                        'loading' => 'lazy',
                                                        'alt' => $model['username'],
                                                    ],
                                                ]); ?>
                                            </div>

                                            <img class="synpathy-img" src="/files/img/iconfinder_heart_216238_3.png">

                                            <span class="get-heart-text"> Занять сердце </span>

                                        </div>
                                    </div>
                                </div>

                                <?php endif; ?>

                                <div class="row my-data-row">

                                    <div class="col-12">
                                        <div class="label margin-top-10">Мои данные:</div>
                                    </div>

                                    <div class="col-12 col-lg-5">

                                        <div class="clear_fix profile_info_row user-prop-wrap">

                                            <div class="user-prop fl_l">Рост:</div>

                                            <div class="user-prop-value">

                                                <?php if (!empty($model['rost']['value'])) : ?>

                                                    <?php echo $model['rost']['value'] ?> см

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>


                                            </div>

                                        </div>


                                        <div class="clear_fix profile_info_row user-prop-wrap">

                                            <div class="user-prop fl_l">Вес:</div>

                                            <div class="user-prop-value">

                                                <?php if (!empty($model['ves']['value'])) : ?>

                                                    <?php echo $model['ves']['value'] ?> кг

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Моя ориентация:</div>

                                            <div class="user-prop-value">

                                                <?php if (!empty($model['sexual'])) : ?>

                                                    <?php foreach ($model['sexual'] as $item) echo '<a href="/znakomstva/orientaciya-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-7">


                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Хочу найти:</div>

                                            <div class="user-prop-value">
                                                <?php if (!empty($model['wantFind'])) : ?>

                                                    <?php foreach ($model['wantFind'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Отношение к алкоголю:</div>

                                            <div class="user-prop-value">
                                                <?php if (!empty($model['alcogol'])) : ?>

                                                    <?php foreach ($model['alcogol'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Отношение к курению:</div>

                                            <div class="user-prop-value">
                                                <?php if (!empty($model['smoking'])) : ?>

                                                    <?php foreach ($model['smoking'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                                <?php else : ?>

                                                    <?php echo Yii::$app->params['no_value_text'] ?>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="row more-info-row">
                                <div class="profile_more_info">
                                    <a class="profile_more_info_link">
                                        <span class="profile_label_more">Показать подробную информацию</span>
                                        <span class="profile_label_less">Скрыть подробную информацию</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="profile-full-wrap">
                            <div class="profile_full">

                                <?php if (!empty($metro)) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Метро:</div>

                                        <div class="user-prop-value">
                                            <?php foreach ($metro as $item) echo '<a href="/znakomstva/metro-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>
                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($rayon)) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop">Район:</div>

                                        <div class="user-prop-value">
                                            <?php foreach ($rayon as $item) echo '<a href="/znakomstva/rayon-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>
                                        </div>

                                    </div>

                                <?php endif; ?>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Место встречи:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['place'])) : ?>

                                            <?php foreach ($model['place'] as $item) echo '<a href="/znakomstva/mesto-vstreji-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>
                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Телосложение:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['bodyType'])) : ?>

                                            <?php foreach ($model['bodyType'] as $item) echo '<a href="/znakomstva/teloslozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop">Национальность:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['national'])) : ?>

                                            <?php foreach ($model['national'] as $item) echo '<a href="/znakomstva/nacionalnost-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Материальное положение:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['financialSituation'])) : ?>

                                            <?php foreach ($model['financialSituation'] as $item) echo '<a href="/znakomstva/materialnoe-polozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Интересы:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['interesting'])) : ?>

                                            <?php foreach ($model['interesting'] as $item) echo '<a href="/znakomstva/interesy-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Профессия:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['professionals'])) : ?>

                                            <?php foreach ($model['professionals'] as $item) echo '<a href="/znakomstva/profesiya-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Важное в партнере:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['vajnoeVPartnere'])) : ?>

                                            <?php foreach ($model['vajnoeVPartnere'] as $item) echo '<a href="/znakomstva/vazhno-v-partnere-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Дети:</div>

                                    <div class="user-prop-value">


                                        <?php if (!empty($model['children'])) : ?>

                                            <?php foreach ($model['children'] as $item) echo '<a href="/znakomstva/deti-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Семья:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['family'])) : ?>

                                            <?php foreach ($model['family'] as $item) echo '<a href="/znakomstva/semejnoe-polozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else: ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>


                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Образование:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['education'])) : ?>

                                            <?php foreach ($model['education'] as $item) echo '<a href="/znakomstva/obrazovanie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Размер груди:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['breast'])) : ?>

                                            <?php foreach ($model['breast'] as $item) echo '<a href="/znakomstva/grud-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Интимная стрижка:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['intimHair'])) : ?>

                                            <?php foreach ($model['intimHair'] as $item) echo '<a href="/znakomstva/intimnaya-strizhka-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Цвет волос:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['hairColor'])) : ?>

                                            <?php foreach ($model['hairColor'] as $item) echo '<a href="/znakomstva/cvet-volos-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Сфера деятельности:</div>

                                    <div class="user-prop-value">

                                        <?php if (!empty($model['sferaDeyatelnosti'])) : ?>

                                            <?php foreach ($model['sferaDeyatelnosti'] as $item) echo '<a href="/znakomstva/sfera-deyatelnosti-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Жилье:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['zhile'])) : ?>

                                            <?php foreach ($model['zhile'] as $item) echo '<a href="/znakomstva/zhile-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                                <div class="clear_fix profile_info_row user-prop-wrap">

                                    <div class="user-prop ">Транспорт:</div>

                                    <div class="user-prop-value">
                                        <?php if (!empty($model['transport'])) : ?>

                                            <?php foreach ($model['transport'] as $item) echo '<a href="/znakomstva/transport-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        <?php else : ?>

                                            <?php echo Yii::$app->params['no_value_text'] ?>

                                        <?php endif; ?>

                                    </div>

                                </div>


                            </div>
                            <?php if ($model['text']) : ?>

                                <div class="col-12">
                                    <p class="about"><?php echo $model['text']; ?></p>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-xl-4 left-column-anket">

            <?php if (!empty($userPresent)) : ?>

                <div class="page-block presents">
                     <span class="small-heading">
                         <?php if (Yii::$app->user->isGuest) : ?>
                             <a>Подарки </a>
                         <?php else: ?>
                             <a data-id="<?php echo Yii::$app->user->id ?>" onclick="get_all_user_presents(this)">Подарки </a>
                         <?php endif; ?>

                </span>
                    <div class="user-present">
                        <div class="user-presents-list">
                            <div class="row">
                                <?php foreach ($userPresent as $present) : ?>
                                    <div class="col-4 col-sm-6 col-md-4">
                                        <img src="<?php echo $present['present']['img'] ?>" alt="">
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>

            <?php if (\frontend\modules\user\components\Friends::countFriends($model->id) > 0) : ?>

                <div class="page-block friends">
                <span class="small-heading">
                    <a href="/user/friends/<?php echo $model->id ?>">Друзья <?php
                        echo \frontend\modules\user\components\Friends::countFriends($model->id) ?>
                    </a>
                </span>
                    <div class="user-friends">
                        <div class="user-friends-list">
                            <div class="row">

                                <?php if (isset($userFriends)) { ?>

                                    <?php foreach ($userFriends as $userFriend) { ?>

                                        <div class="col-4">
                                            <a class="post_image" href="/user/<?php echo $userFriend['id'] ?>">
                                                <?php if (file_exists(Yii::getAlias('@webroot') . $userFriend['userAvatarRelations']['file']) and $userFriend['userAvatarRelations']['file']) {

                                                    ?>
                                                    <img loading="lazy" class="img"
                                                         srcset="<?= Yii::$app->imageCache->thumbSrc($userFriend['userAvatarRelations']['file'], 'dialog') ?>"
                                                         alt="">
                                                    <?php
                                                } else {
                                                    echo '<img src="/files/img/nophoto.png" alt="">';
                                                } ?>
                                            </a>
                                            <span class="author"><?php echo strstr($userFriend['username'], ' ', true) ?: $userFriend['username']; ?></span>
                                        </div>

                                    <?php } ?>

                                <?php } else { ?>

                                    <div class="col-12">
                                        <p class="small-heading">Пока нет друзей</p>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <?php if ($group) : ?>

                <div class="page-block friends">
                <span class="small-heading">
                    <a href="/user/group/<?php echo $model->id ?>">Группы</a>
                </span>
                    <div class="user-friends">
                        <div class="user-friends-list">
                            <div class="row">

                                <?php if (isset($group)) { ?>

                                    <?php foreach ($group as $item) { ?>

                                        <div class="col-4">
                                            <a class="post_image" href="/group/<?php echo $item['id'] ?>">
                                                <?php if (file_exists(Yii::getAlias('@webroot') . $item['avatar']['file']) and $item['avatar']['file']) {

                                                    ?>
                                                    <img loading="lazy" class="img"
                                                         srcset="<?= Yii::$app->imageCache->thumbSrc($item['avatar']['file'], 'dialog') ?>"
                                                         alt="">
                                                    <?php
                                                } else {
                                                    echo '<img src="/files/img/nophoto.png" alt="">';
                                                } ?>
                                            </a>
                                            <span class="author"><?php echo strstr($item['name'], ' ', true) ?: $item['name']; ?></span>
                                        </div>

                                    <?php } ?>

                                <?php } else { ?>

                                    <div class="col-12">
                                        <p class="small-heading">Пока групп нет</p>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
        <div class="col-12 col-lg-8 col-xl-8 right-column-anket">

            <?php if (!empty($photo)) : ?>

                <div class="page-block page-photo">

                    <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $model->id) : ?>

                        <a href="/user/photo">Все фото</a>

                    <?php endif; ?>

                    <div class="slider">

                        <div class="">

                            <div class="slider-items-single">

                                <?php foreach ($photo as $item) : ?>

                                    <div class="item" href="<?php echo $item->file ?>">

                                        <?php if (isset($item->file) and file_exists(Yii::getAlias('@webroot') . $item->file) and $item->file) : ?>

                                            <img loading="lazy" class="img"
                                                 src="<?= Yii::$app->imageCache->thumbSrc($item->file, 'gallery-mini') ?>"
                                                 alt="">

                                        <?php else : ?>

                                            <img class="img" src="/files/img/nophoto.png" alt="">

                                        <?php endif; ?>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>


                    </div>
                </div>

            <?php endif; ?>


            <div class="page-block wall-form">

                    <?php

                    $form = ActiveForm::begin([
                        'action' => '#',
                        'id' => 'wall-form',
                        'options' => ['class' => 'form-horizontal'],
                    ]) ?>

                    <?= $form->field($addWallForm, 'user_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                    <?php if (!Yii::$app->user->isGuest) : ?>

                        <div class="row">
                            <div class="col-3 col-sm-2">
                                <?php if (isset($userPhoto['file']) and file_exists(Yii::getAlias('@webroot') . $userPhoto['file']) and $userPhoto['file']) : ?>

                                    <img loading="lazy" class="img"
                                         srcset="<?= Yii::$app->imageCache->thumbSrc($userPhoto['file'], 'dialog') ?>"
                                         alt="">

                                <?php else : ?>

                                    <img class="img" src="/files/img/nophoto.png" alt="">

                                <?php endif; ?>
                            </div>

                            <div class="col-9 col-sm-10">
                                <?= $form->field($addWallForm, 'text')->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>
                            </div>
                        </div>

                    <?php else : ?>

                        <?= $form->field($addWallForm, 'text')->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

                    <?php endif; ?>

                <?php if (Yii::$app->user->isGuest)  $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                else $onclick = 'onclick="send_wall_item(this)"'; ?>

                    <div class="form-group " <?php echo $onclick ?>>
                        <span class="btn wall-send-btn">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF" fill-opacity="0.13"/>
                            </svg>
                        </span>
                    </div>

                    <?php ActiveForm::end() ?>


            </div>

            <div class="wall-wrapper">
                <?php echo \frontend\modules\wall\widgets\WallWidget::widget(['user_id' => $model->id]) ?>
            </div>

            <br>
            <br>

        </div>
    </div>
</div>

<?php if (Yii::$app->user->isGuest) {

    echo \frontend\widgets\InvitationWidget::widget([
            'img'       => $ava,
            'name'      => $model['username'],
            'message'   => 'Привет'
    ]);

} ?>
