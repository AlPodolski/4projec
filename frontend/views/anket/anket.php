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
/* @var $userFriends array */

$this->registerJsFile('/files/js/lightgallery-all.min.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.carousel.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.navigation.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->registerCssFile('/css/lightgallery.min.css');
$this->registerCssFile('/css/owl.carousel.min.css');
$this->registerCssFile('/css/owl.theme.default.min.css');

SlickAsset::register($this);

$this->registerJsFile('/files/js/single.js', ['depends' => [SlickAsset::className()]]);

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

\frontend\assets\LightGalleryAsset::register($this);
?>

<div class="anket">
    <div class="row">
        <div class="col-12 col-sm-5 col-lg-4 col-xl-4 left-column-anket">
            <div class="single-photo">

                <div class="single-left-column page-block page_photo">

                    <div class="post-photo">

                        <?php if (!empty($photo)) : ?>

                            <?php foreach ($photo as $item) : ?>

                                <?php if ($item['avatar'] == 1) : ?>

                                    <?php if (file_exists(Yii::getAlias('@webroot') . $item['file']) and $item['file']) : ?>

                                        <?= Yii::$app->imageCache->thumb($item['file'], 'single-main', ['class' => 'img']) ?>

                                    <?php else : ?>

                                        <img src="/files/img/nophoto.png" alt="">

                                    <?php endif; ?>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <div class="img-wrap">
                                <img class="img" src="/files/img/nophoto.png" alt="">
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

                    <?php if ( isset(Yii::$app->user->id) and Yii::$app->user->id == $model->id)  : ?>

                    <?php else : ?>

                    <div class="profile_actions">

                        <div class="profile_action_btn profile_msg_split" id="profile_message_send">
                            <div class="clear_fix">
                                <a class="button_link cut_left">
                                    <button onclick="get_message_form(this)" data-user-id="<?php echo $model->id ?>"
                                            class="flat_button profile_btn_cut_left">Написать сообщение
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#modal-present" aria-hidden="true"
                                   class="button_link cut_right" id="profile_send_gift_btn">
                                    <button class="flat_button profile_btn_cut_right">
                                        <span class="profile_gift_icon"></span>
                                        <span class="profile_gift_text"><i class="fas fa-gift"></i></span>
                                    </button>
                                </a>
                                <a data-toggle="modal" data-target="#modal-present" aria-hidden="true"
                                   class="button_link mobile-present">
                                    <button class="flat_button">
                                        <span class="profile_gift_icon">

                                        </span>
                                        <span class="profile_gift_text">
                                            Подарить подарок
                                        </span>
                                    </button>
                                </a>

                                <?php if (Yii::$app->user->isGuest or (!Yii::$app->user->isGuest and Yii::$app->user->id != $model->id)  ) : ?>

                                    <?php
                                    /*если пользователь не в друзьях и не отправлял заявку в друзья добавляем возможность добавление в друзья*/
                                    if (Yii::$app->user->isGuest or
                                        (!FriendsHelper::isFiends(Yii::$app->user->id,$model->id )
                                            and !$isFriendsRequestFrom = FriendsRequestHelper::isFiendsRequest($model->id, Yii::$app->user->id )
                                            and !$isFriendsRequestTo = FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id,$model->id))) {
                                        $onclick = 'onclick="addToFriends(this)"';
                                    } else {
                                        $onclick = '';
                                    }?>

                                    <a data-id="<?php echo $model->id ?>" <?php echo $onclick ?> data-message="<?php if (Yii::$app->user->isGuest) echo 'Требуется авторизация' ?>">
                                        <button class="flat_button">
                                            <span class="profile_gift_text">
                                                <?php if ($isFriendsRequestTo) : ?>
                                                    Заявка отправлена
                                                <?php elseif (FriendsHelper::isFiends(Yii::$app->user->id,$model->id )) : ?>
                                                    У Вас в друзьях
                                                <?php elseif ($isFriendsRequestFrom) : ?>
                                                    <span onclick="check_friend_request(this)"
                                                       data-user-id="<?php echo $model->id ?>"
                                                       >Принять заявку</span>
                                                <?php else : ?>
                                                    Добавить в друзья
                                                <?php endif; ?>
                                            </span>
                                        </button>
                                    </a>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                    <?php endif; ?>


                </div>

            </div>

            <?php if (!empty($userPresent)) : ?>

                <div class="page-block presents">
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

            <div class="page-block friends">
                <span class="small-heading">
                    <a href="/user/friends/<?php echo $model->id ?>">Друзья</a>
                </span>
                <div class="user-friends">
                    <div class="user-friends-list">
                        <div class="row">

                            <?php if (isset($userFriends)) { ?>

                                <? foreach ($userFriends as $userFriend) : ?>

                                    <div class="col-4">
                                        <a class="post_image" href="/user/<?php echo $userFriend['id'] ?>">
                                        <?php if (file_exists(Yii::getAlias('@webroot') . $userFriend['userAvatarRelations']['file']) and $userFriend['userAvatarRelations']['file']) : ?>

                                            <?= Yii::$app->imageCache->thumb($userFriend['userAvatarRelations']['file'], 'dialog', ['class' => 'img']) ?>

                                        <?php else : ?>

                                            <img src="/files/img/nophoto.png" alt="">

                                        <?php endif; ?>
                                        </a>
                                        <span class="author"><?php echo strstr($userFriend['username'], ' ', true) ?: $userFriend['username']; ?></span>

                                    </div>

                                <?php endforeach; ?>

                            <?php }else { ?>

                                <div class="col-12">
                                    <p class="small-heading">Пока нет друзей</p>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-12 col-sm-7 col-lg-8 col-xl-8 right-column-anket">

            <div class="page-block profile_info">
                <div class="page_top">
                    <div class="user-name">
                        <h1 class="user-name">
                            <?php echo $model->username ?>
                        </h1>
                    </div>
                </div>
                <div class="">
                    <div class="clear_fix profile_info_row ">
                        <div class="label fl_l">Город:</div>
                        <?php

                        $city = City::getCity($model->city);

                        ?>
                        <div class="labeled"><?php echo $city['city'] ?></div>
                    </div>

                    <div class="clear_fix profile_info_row ">

                        <?php if ($postPrice) : ?>

                            <div class="label fl_l">Цена:</div>
                            <div class="labeled"> <?php echo $postPrice['value'] ?> рублей</div>

                        <?php endif; ?>

                    </div>

                    <div class="clear_fix profile_info_row ">

                        <?php if (!empty($model['sexual'])) : ?>

                            <div class="label fl_l">Моя ориентация:</div>

                            <div class="labeled">
                                <?php foreach ($model['sexual'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> ' ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="clear_fix profile_info_row ">

                        <?php if (!empty($model['wantFind'])) : ?>

                            <div class="label fl_l">Хочу найти:</div>

                            <div class="labeled"> <?php foreach ($model['wantFind'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?> </div>

                        <?php endif; ?>

                    </div>

                    <div class="clear_fix profile_info_row ">

                        <?php if (!empty($model['celiZnakomstvamstva'])) : ?>

                            <div class="label fl_l">Цели знакомства:</div>

                            <div class="labeled"> <?php foreach ($model['celiZnakomstvamstva'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?> </div>

                        <?php endif; ?>

                    </div>

                    <?php if (!empty($model['vneshnost'])) : ?>


                        <div class="clear_fix profile_info_row ">

                            <div class="label fl_l">Моя внешность:</div>

                            <div class="labeled"> <?php foreach ($model['vneshnost'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                        </div>

                    <?php endif; ?>

                    <?php if ($service) : ?>

                        <div class="clear_fix profile_info_row ">

                            <div class="label fl_l">Сексуальные предпочтения:</div>

                            <div class="labeled"> <?php foreach ($service as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> ' ?> </div>

                        </div>

                    <?php endif; ?>

                    <?php if ($model->text) : ?>

                        <div class="clear_fix profile_info_row ">

                            <div class="label fl_l">Обо мне:</div>

                            <div class="labeled black-text"> <?php echo $model->text ?> </div>

                        </div>

                    <?php endif; ?>

                    <div class="profile_more_info">
                        <a class="profile_more_info_link">
                            <span class="profile_label_more">Показать подробную информацию</span>
                            <span class="profile_label_less">Скрыть подробную информацию</span>
                        </a>
                    </div>

                    <div class="profile_full">

                        <?php if (!empty($metro)) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Метро:</div>

                                <div class="labeled"> <?php foreach ($metro as $item) echo '<a href="/znakomstva/metro-'.$item['url'].'">'. $item['value'] . ' </a> '  ?> </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($rayon)) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Район:</div>

                                <div class="labeled"> <?php foreach ($rayon as $item) echo '<a href="/znakomstva/rayon-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['place'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Место встречи:</div>

                                <div class="labeled"> <?php foreach ($model['place'] as $item) echo '<a href="/znakomstva/mesto-vstreji-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['bodyType'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Телосложение:</div>

                                <div class="labeled"> <?php foreach ($model['bodyType'] as $item) echo '<a href="/znakomstva/teloslozhenie-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['national'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Национальность:</div>

                                <div class="labeled"> <?php foreach ($model['national'] as $item) echo '<a href="/znakomstva/nacionalnost-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>   </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['financialSituation'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Материальное положение:</div>

                                <div class="labeled">  <?php foreach ($model['financialSituation'] as $item) echo '<a href="/znakomstva/materialnoe-polozhenie-'.$item['url'].'">'. $item['value'] . ' </a> ' ?>    </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['interesting'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Интересы:</div>

                                <div class="labeled">  <?php foreach ($model['interesting'] as $item) echo '<a href="/znakomstva/interesy-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['professionals'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Профессия:</div>

                                <div class="labeled">  <?php foreach ($model['professionals'] as $item) echo '<a href="/znakomstva/profesiya-'.$item['url'].'">'. $item['value'] . ' </a> '?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['vajnoeVPartnere'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Важное в партнере:</div>

                                <div class="labeled">  <?php foreach ($model['vajnoeVPartnere'] as $item) echo '<a href="/znakomstva/vazhno-v-partnere-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['children'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Дети:</div>

                                <div class="labeled">  <?php foreach ($model['children'] as $item) echo '<a href="/znakomstva/deti-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['family'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Семья:</div>

                                <div class="labeled">   <?php foreach ($model['family'] as $item)echo '<a href="/znakomstva/semejnoe-polozhenie-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['alcogol'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Отношение к алкоголю:</div>

                                <div class="labeled">   <?php foreach ($model['alcogol'] as $item)echo '<a href="/znakomstva/otnoshenie-k-akogolyu-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['education'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Образование:</div>

                                <div class="labeled">   <?php foreach ($model['education'] as $item) echo '<a href="/znakomstva/obrazovanie-'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['breast'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Размер груди:</div>

                                <div class="labeled">   <?php foreach ($model['breast'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> ' ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['intimHair'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Интимная стрижка:</div>

                                <div class="labeled">   <?php foreach ($model['intimHair'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['hairColor'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Цвет волос:</div>

                                <div class="labeled">   <?php foreach ($model['hairColor'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['sferaDeyatelnosti'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Сфера деятельности:</div>

                                <div class="labeled">   <?php foreach ($model['sferaDeyatelnosti'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['zhile'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Жилье:</div>

                                <div class="labeled">   <?php foreach ($model['zhile'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                        <?php if (!empty($model['transport'])) : ?>

                            <div class="clear_fix profile_info_row ">

                                <div class="label fl_l">Транспорт:</div>

                                <div class="labeled">   <?php foreach ($model['transport'] as $item) echo '<a href="/znakomstva/'.$item['url'].'">'. $item['value'] . ' </a> '  ?>  </div>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>
            </div>

            <?php if (!empty($photo)) : ?>

                <div class="page-block page-photo">

                    <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $model->id  ) : ?>

                        <a href="/user/photo">Все фото</a>

                    <?php endif; ?>

                    <div class="slider">

                        <div class="">

                            <div class="slider-items-single">

                                <?php foreach ($photo as $item) : ?>

                                    <div class="item" href="<?php echo $item->file ?>">

                                        <?php if (file_exists(Yii::getAlias('@webroot') . $item->file) and $item->file) : ?>

                                            <?= Yii::$app->imageCache->thumb($item->file, 'gallery-mini', ['class' => 'img']) ?>

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

                <?php if (Yii::$app->user->isGuest) : ?>

                    <p class="alert alert-info">Для того что бы оставлять записи на стене требуется авторизация</p>

                <?php else : ?>

                    <?php

                    $form = ActiveForm::begin([
                        'action' => '#',
                        'id' => 'wall-form',
                        'options' => ['class' => 'form-horizontal'],
                    ]) ?>
                    <?= $form->field($addWallForm, 'user_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                    <?= $form->field($addWallForm, 'text')->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

                    <div class="form-group ">
                        <span class="btn btn-primary wall-send-btn flat_button">Отправить</span>
                    </div>
                    <?php ActiveForm::end() ?>

                <?php endif; ?>



            </div>

            <div class="wall-wrapper">
                <?php echo \frontend\modules\wall\widgets\WallWidget::widget(['user_id' => $model->id]) ?>
            </div>

            <br>
            <br>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-present" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Выбрать подарок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php echo \frontend\widgets\PresentWidget::widget(['user_id' => $model['id']]); ?>

            </div>
        </div>
    </div>
</div>
<div id="checkPresentModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Подарить подарок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body modal-gift-present">


            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
