<?php

use common\models\City;
use frontend\modules\user\models\Photo;
use yii\widgets\ActiveForm;
use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\FriendsRequestHelper;

/* @var $model \frontend\modules\user\models\Profile */
/* @var $group array */
/* @var $userFriends array */
/* @var $userHeart array */

$addWallForm = new \frontend\modules\wall\models\forms\AddToWallForm();

?>

<div class="row anket-single-page" data-pol="<?php echo $model['polRelation']['pol_id'] ?>"
     data-id="<?php echo $model['id'] ?>" data-img="" data-adress="/user/<?php echo $model['id'] ?>">

    <div class="col-12">
        <div class="page-block main-info-anket">
            <div class="row">
                <div class="col-12 col-xl-4 col-lg-4 col-md-6 position-relative single-photo-block-<?php echo $model['id'] ?>">

                    <?php if ($model['vip_status_work'] > time()) : ?>

                        <div class="vip-icon-wrap single-vip">
                            <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
                        </div>

                    <?php endif; ?>

                    <?php if ($model->email == 'adminadultero@mail.com' or $model['last_visit_time'] > time() - 3600) : ?>

                        <div class="online-single">Онлайн</div>

                    <?php endif; ?>

                    <div class="post-photo">

                        <?php if (!empty($photo)) : ?>

                            <div id="carouselExampleControls-<?php echo $model->id ?>" class="carousel slide"
                                 data-ride="carousel">

                                <div class="carousel-inner">

                                    <?php foreach ($photo as $key => $item) : ?>

                                        <?php if ($key == 0) : ?>

                                            <?php $class = 'active carousel-item'; ?>

                                        <?php else: ?>

                                            <?php $class = 'carousel-item'; ?>

                                        <?php endif; ?>

                                        <?php if ($item['avatar'] == 1) $ava = $item['file'] ?>

                                        <?php if ($item['status'] != Photo::STATUS_HIDE) : ?>

                                            <?php if (file_exists(Yii::getAlias('@webroot') . $item['file']) and $item['file']) : ?>

                                                <picture class="<?php echo $class ?>"
                                                         href="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-510') ?>">

                                                    <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-510') ?>"
                                                            media="(max-width: 767px)">
                                                    <source srcset="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-main') ?>">
                                                    <img loading="lazy" class="img d-block w-100"
                                                         src="<?= Yii::$app->imageCache->thumbSrc($item['file'], 'single-main') ?>"
                                                         alt="">
                                                </picture>

                                            <?php else : ?>

                                                <div class="img-wrap d-flex no-photo <?php echo $class ?>" href="/files/img/nophoto.png">
                                                    <img srcset="/files/img/nophoto.png" alt="">
                                                </div>

                                            <?php endif; ?>

                                        <?php endif; ?>

                                    <?php endforeach; ?>

                                </div>

                                <a class="carousel-control-prev"
                                   href="#carouselExampleControls-<?php echo $model->id ?>" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next"
                                   href="#carouselExampleControls-<?php echo $model->id ?>" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <?php if (isset($ava) and $ava) : ?>

                                <img class="d-none post-image" srcset="<?php echo $ava ?>" alt="">

                            <?php endif; ?>

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
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path d="M15.9352 7.1875H10.375V1.88008C10.375 1.18691 9.76055 0.625 9 0.625C8.23945 0.625 7.625 1.18691 7.625 1.88008V7.1875H2.06484C1.33867 7.1875 0.75 7.77402 0.75 8.5C0.75 9.22598 1.33867 9.8125 2.06484 9.8125H7.625V15.1199C7.625 15.8131 8.23945 16.375 9 16.375C9.76055 16.375 10.375 15.8131 10.375 15.1199V9.8125H15.9352C16.6613 9.8125 17.25 9.22598 17.25 8.5C17.25 7.77402 16.6613 7.1875 15.9352 7.1875Z"
      fill="white"/>
</svg>

                                                    </span>
                                                <?php elseif (!Yii::$app->user->isGuest and isset($isFriendsRequestTo) and $isFriendsRequestTo) : ?>
                                                    <span class="show-message" data-message="Заявка отправлена">
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path d="M15.9352 7.1875H10.375V1.88008C10.375 1.18691 9.76055 0.625 9 0.625C8.23945 0.625 7.625 1.18691 7.625 1.88008V7.1875H2.06484C1.33867 7.1875 0.75 7.77402 0.75 8.5C0.75 9.22598 1.33867 9.8125 2.06484 9.8125H7.625V15.1199C7.625 15.8131 8.23945 16.375 9 16.375C9.76055 16.375 10.375 15.8131 10.375 15.1199V9.8125H15.9352C16.6613 9.8125 17.25 9.22598 17.25 8.5C17.25 7.77402 16.6613 7.1875 15.9352 7.1875Z"
      fill="white"/>
</svg>

                                                    </span>
                                                <?php elseif (!Yii::$app->user->isGuest and $isFriendsRequestFrom) : ?>
                                                    <span class="show-message" data-message="Принять заявку"
                                                          onclick="check_friend_request_listing(this)"
                                                          data-user-id="<?php echo $model->id ?>">
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path d="M15.9352 7.1875H10.375V1.88008C10.375 1.18691 9.76055 0.625 9 0.625C8.23945 0.625 7.625 1.18691 7.625 1.88008V7.1875H2.06484C1.33867 7.1875 0.75 7.77402 0.75 8.5C0.75 9.22598 1.33867 9.8125 2.06484 9.8125H7.625V15.1199C7.625 15.8131 8.23945 16.375 9 16.375C9.76055 16.375 10.375 15.8131 10.375 15.1199V9.8125H15.9352C16.6613 9.8125 17.25 9.22598 17.25 8.5C17.25 7.77402 16.6613 7.1875 15.9352 7.1875Z"
      fill="white"/>
</svg>

                                                    </span>
                                                <?php else : ?>
                                                    <span class="show-message" data-message="Добавить в друзья">
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
<path d="M15.9352 7.1875H10.375V1.88008C10.375 1.18691 9.76055 0.625 9 0.625C8.23945 0.625 7.625 1.18691 7.625 1.88008V7.1875H2.06484C1.33867 7.1875 0.75 7.77402 0.75 8.5C0.75 9.22598 1.33867 9.8125 2.06484 9.8125H7.625V15.1199C7.625 15.8131 8.23945 16.375 9 16.375C9.76055 16.375 10.375 15.8131 10.375 15.1199V9.8125H15.9352C16.6613 9.8125 17.25 9.22598 17.25 8.5C17.25 7.77402 16.6613 7.1875 15.9352 7.1875Z"
      fill="white"/>
</svg>

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
                                         data-id="<?php echo $model['id'] ?>" onclick="get_gift_vip_modal(this)">
                                        <img src="/files/img/vip_icon.png" alt="VIP">
                                        <div class="text vip-text">
                                            <a href="#"> Подарить VIP</a></div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($userHeart) : ?>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative get-heart margin-top-10">

                                            <a href="/user/<?php echo $userHeart['who'] ?>">

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

                                            <img class="synpathy-img"
                                                 src="/files/img/iconfinder_heart_216238_3.png">

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

                                    if (Yii::$app->user->id != $model['id']) {

                                        $attributes = 'data-buyer="' . Yii::$app->user->id . '" ';
                                        $attributes .= ' data-userWhoHeartIsBuy="' . $model['id'] . '" ';
                                        $onclick = 'onclick="get_take_heart_form(this)"';

                                    } else $onclick = '';

                                    ?>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-12">
                                        <?php if (!Yii::$app->user->isGuest) : ?>
                                            <div class="position-relative get-heart margin-top-10"

                                                <?php if ($ava and file_exists(Yii::getAlias('@webroot') . $ava) and $ava) : ?>
                                                    data-img="<?php echo Yii::$app->imageCache->thumbSrc($ava, 'popular'); ?>"
                                                <?php else : ?>
                                                    data-img="/files/img/nophoto.png"
                                                <?php endif; ?>
                                                <?php echo $onclick ?> <?php echo $attributes ?>>

                                                <?php if (!Yii::$app->user->isGuest) $buyerAvatar = Photo::getAvatar(Yii::$app->user->id);
                                                else $buyerAvatar = false
                                                ?>

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

                                                <img class="synpathy-img"
                                                     src="/files/img/iconfinder_heart_216238_3.png">

                                                <span class="get-heart-text"> Занять сердце </span>

                                            </div>

                                        <?php endif; ?>

                                    </div>
                                </div>

                            <?php endif; ?>

                            <div class="row my-data-row">

                                <?php if ($model['text']) : ?>

                                    <div class="col-12">
                                        <p class="about"><?php echo $model['text']; ?></p>
                                    </div>

                                <?php endif; ?>

                                <div class="col-12 col-lg-5">

                                    <?php if (!empty($model['rost']['value'])) : ?>

                                        <div class="clear_fix profile_info_row user-prop-wrap">

                                            <div class="user-prop fl_l">Рост:</div>

                                            <div class="user-prop-value">

                                                <?php echo $model['rost']['value'] ?> см

                                            </div>

                                        </div>

                                    <?php endif; ?>

                                    <?php if (!empty($model['ves']['value'])) : ?>

                                        <div class="clear_fix profile_info_row user-prop-wrap">

                                            <div class="user-prop fl_l">Вес:</div>

                                            <div class="user-prop-value">

                                                <?php echo $model['ves']['value'] ?> кг

                                            </div>

                                        </div>

                                    <?php endif; ?>


                                    <?php if (!empty($model['sexual'])) : ?>
                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Моя ориентация:</div>

                                            <div class="user-prop-value">

                                                <?php foreach ($model['sexual'] as $item) echo '<a href="/znakomstva/orientaciya-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                            </div>

                                        </div>

                                    <?php endif; ?>

                                </div>

                                <div class="col-12 col-lg-7">

                                    <?php if (!empty($model['wantFind'])) : ?>

                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Хочу найти:</div>

                                            <div class="user-prop-value">

                                                <?php foreach ($model['wantFind'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                            </div>

                                        </div>

                                    <?php endif; ?>

                                    <?php if (!empty($model['alcogol'])) : ?>

                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Отношение к алкоголю:</div>

                                            <div class="user-prop-value">


                                                <?php foreach ($model['alcogol'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>


                                            </div>

                                        </div>

                                    <?php endif; ?>

                                    <?php if (!empty($model['smoking'])) : ?>

                                        <div class="clear_fix profile_info_row user-prop-wrap ">

                                            <div class="user-prop fl_l">Отношение к курению:</div>

                                            <div class="user-prop-value">

                                                <?php foreach ($model['smoking'] as $item) echo '<a href="/znakomstva/kogo-ishchu-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                            </div>

                                        </div>

                                    <?php endif; ?>


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

                        <?php if (Yii::$app->user->isGuest) : ?>

                            <br>

                            <div class="alert alert-info">Полная информация доступна после авторизации</div>

                        <?php else : ?>

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

                                <?php if (!empty($model['place'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Место встречи:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['place'] as $item) echo '<a href="/znakomstva/mesto-vstreji-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['bodyType'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Телосложение:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['bodyType'] as $item) echo '<a href="/znakomstva/teloslozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['national'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop">Национальность:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['national'] as $item) echo '<a href="/znakomstva/nacionalnost-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['financialSituation'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Материальное положение:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['financialSituation'] as $item) echo '<a href="/znakomstva/materialnoe-polozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['interesting'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Интересы:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['interesting'] as $item) echo '<a href="/znakomstva/interesy-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['professionals'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Профессия:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['professionals'] as $item) echo '<a href="/znakomstva/profesiya-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['vajnoeVPartnere'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Важное в партнере:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['vajnoeVPartnere'] as $item) echo '<a href="/znakomstva/vazhno-v-partnere-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['children'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Дети:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['children'] as $item) echo '<a href="/znakomstva/deti-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['family'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Семья:</div>

                                        <div class="user-prop-value">


                                            <?php foreach ($model['family'] as $item) echo '<a href="/znakomstva/semejnoe-polozhenie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>


                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['education'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Образование:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['education'] as $item) echo '<a href="/znakomstva/obrazovanie-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['breast'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Размер груди:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['breast'] as $item) echo '<a href="/znakomstva/grud-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['intimHair'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Интимная стрижка:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['intimHair'] as $item) echo '<a href="/znakomstva/intimnaya-strizhka-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['hairColor'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Цвет волос:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['hairColor'] as $item) echo '<a href="/znakomstva/cvet-volos-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['sferaDeyatelnosti'])) : ?>

                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Сфера деятельности:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['sferaDeyatelnosti'] as $item) echo '<a href="/znakomstva/sfera-deyatelnosti-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>


                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['zhile'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Жилье:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['zhile'] as $item) echo '<a href="/znakomstva/zhile-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>

                                <?php if (!empty($model['transport'])) : ?>


                                    <div class="clear_fix profile_info_row user-prop-wrap">

                                        <div class="user-prop ">Транспорт:</div>

                                        <div class="user-prop-value">

                                            <?php foreach ($model['transport'] as $item) echo '<a href="/znakomstva/transport-' . $item['url'] . '">' . $item['value'] . ' </a> ' ?>

                                        </div>

                                    </div>

                                <?php endif; ?>


                            </div>

                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest) : ?>

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

            <?php if (!Yii::$app->user->isGuest and \frontend\modules\user\components\Friends::countFriends($model->id) > 0) : ?>

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

                <?php if (Yii::$app->user->isGuest) $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
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

    <?php endif; ?>

</div>