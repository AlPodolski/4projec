<?php /* @var $dialog array */ ?>
<?php /* @var $user array */ ?>
<?php /* @var $recepient integer */ ?>
<?php /* @var $userTo array */ ?>
<?php /* @var $dialog_id integer */ ?>
<?php /* @var $limitExist boolean */ ?>

<?php

use yii\widgets\ActiveForm;
use frontend\widgets\PhotoWidget;

$messageForm = new \frontend\modules\chat\models\forms\SendMessageForm();
$this->registerJsFile('/files/js/chat.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$photoModel = new \frontend\modules\chat\models\forms\SendPhotoForm();

?>

<div class="page-block chat-block " data-to="<?php echo $userTo['id']?>">

    <div class="chat-wrap-overlow overflow-hidden">
        <div class="chat-wrap" data-read="">
            <div class="chat ">

                <?php if (isset($userTo['polRelation']['pol_id']) and $userTo['polRelation']['pol_id'] == \common\models\Pol::POL_WOMEN) : ?>


                    <p class="cta-box__text w-100 text-center " style="margin-top:15px" data-user-id="<?php echo $userTo['id'] ?>" onclick="get_presents(this)">Подарить подарок на 8 марта!
                        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
                            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </p>

                <?php endif; ?>

                <?php if (isset($dialog['message'])) : foreach ($dialog['message'] as $item) : ?>

                        <div class="wall-tem <?php if (Yii::$app->user->id == $item['author']['id']) echo 'right-message' ?>">

                            <div class="post_header">

                                <a class="post_image" href="/user/<?php echo $item['author']['id'] ?>">

                                    <?php if (file_exists(Yii::getAlias('@webroot').$item['author']['avatarRelation']['file']) and $item['author']['avatarRelation']['file']) : ?>

                                        <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($item['author']['avatarRelation']['file'] , 'dialog') ?>" alt="">

                                    <?php else : ?>

                                        <img class="img" src="/files/img/nophoto.png" alt="">

                                    <?php endif; ?>

                                </a>

                                <div class="post_header_info">

                                    <a href="/user/<?php echo $item['author']['id'] ?>" class="author">
                                        <?php echo $item['author']['username'] ?>
                                    </a>
                                    <span class="post_date"><span class="post_link"><span class="rel_date"><?php echo Yii::$app->formatter->asDatetime($item['created_at']) ?></span></span></span>
                                    <div class="post-text">

                                        <?php

                                            if ($item['class']){

                                                if($item['class'] == \frontend\models\relation\UserPresents::class){

                                                    $userPresent = \frontend\models\relation\UserPresents::find()
                                                        ->where(['id' => $item['related_id']])->asArray()->with('present')->one();

                                                    echo '<p>'. $userPresent['message'].'</p>';

                                                    echo \yii\helpers\Html::img($userPresent['present']['img']);

                                                }

                                                if($item['class'] == \frontend\models\Files::class){

                                                    $messagePhoto = \frontend\models\Files::find()
                                                        ->where(['id' => $item['related_id']])->asArray()->one();

                                                    echo \yii\helpers\Html::img($messagePhoto['file']);

                                                }

                                            }

                                        ?>

                                        <?php echo $item['message'] ?>
                                    </div>
                                </div>


                            </div>
                            <div style="clear: both">
                            </div>


                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                <?php if (isset($userTo['polRelation']['pol_id']) and $userTo['polRelation']['pol_id'] == \common\models\Pol::POL_WOMEN) : ?>

                <p class="cta-box__text w-100 text-center" data-user-id="<?php echo $userTo['id'] ?>" onclick="get_presents(this)">Подарить подарок на 8 марта!
                    <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
                        <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>

                <?php else: ?>

                    <p class="cta-box__text w-100 text-center" data-user-id="<?php echo $userTo['id'] ?>" onclick="get_presents(this)">Не знаешь как начать разговор начни с подарка
                        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
                            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </p>

                <?php endif; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="user-write-answer user-write-<?php echo $userTo['id'] ?> " >
        <span class="user-write-message-text d-none">
            <?php echo $userTo['username'] ?> набирает сообщение <img src="/files/img/30.gif" alt="">
        </span>
    </div>

</div>

<div  class="comment-wall-form page-block comment-wall-form-<?php echo $item['id'] ?>">

    <?php if ($user['vip_status_work'] > time()) : ?>

        <?php $photoForm = ActiveForm::begin([
            'action' => '#',
            'id' => 'send-message-photo-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'options' => ['class' => 'form-horizontal' , 'onchange' => 'send_message_photo()'],
        ]) ?>
        <?= $photoForm->field($photoModel, 'user_id',['options' => ['class' => 'd-none']])
            ->hiddenInput(['value' => $user['id']])->label(false) ?>

        <?= $photoForm->field($photoModel, 'dialog_id',['options' => ['class' => 'd-none']])
            ->hiddenInput(['value' => $dialog_id])->label(false) ?>

        <div class="send-message-photo">
            <label for="send-message-photo-input" class="">

                <i class="fas fa-camera"></i>

                <?= $photoForm->field($photoModel, 'photo')
                    ->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'send-message-photo-input'])
                    ->label(false) ?>

            </label>
        </div>


        <?php ActiveForm::end() ?>

    <?php else : ?>

    <div class="send-message-photo" onclick="by_vip_for_photo()">
        <i class="fas fa-camera"></i>
    </div>

    <?php endif; ?>


    <?php

    $form = ActiveForm::begin([
        'action' => '#',
        'id' => 'message-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($messageForm, 'chat_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $dialog['dialog_id']])->label(false) ?>

    <?php if ($recepient) :?>

        <?= $form->field($messageForm, 'user_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $recepient])->label(false) ?>
        <?= $form->field($messageForm, 'from_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $user['id']])->label(false) ?>

    <?php endif; ?>

    <div class="show-message" data-user-id="<?php echo $userTo['id'] ?>" onclick="get_presents(this)" data-message="Отправить подарок">
        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <?= $form->field($messageForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

    <?php echo PhotoWidget::widget([
        'path' => $user['userAvatarRelations']['file'],
        'size' => 'dialog',
        'options' => [
            'class' => 'img d-none user-img',
            'loading' => 'lazy',
            'alt' => $user['username'],
        ],
    ]  ); ?>

    <?php echo PhotoWidget::widget([
        'path' => $userTo['userAvatarRelations']['file'],
        'size' => 'dialog',
        'options' => [
            'class' => 'img d-none user-img user-to',
            'loading' => 'lazy',
            'alt' => $userTo['username'],
        ],
    ]  ); ?>

    <span
            <?php if (!$limitExist or (in_array($user['id'], Yii::$app->params['admin_id']) or in_array($userTo['id'], Yii::$app->params['admin_id']))) : ?>
          data-name="<?php echo $user['username'];  ?>"
          data-user-id="<?php echo $user['id'];  ?>"
          data-user-id-to="<?php echo $userTo['id']; ?>"
          data-name-to="<?php echo $userTo['username']; ?>"
          data-dialog-id="<?php echo $dialog_id; ?>"
          onclick="send_message(this)"
          data-id="<?php echo $item['id']; ?>"

          class="message-send-btn"
          <?php else : ?>
                class="message-send-btn not-active"
          <?php endif; ?>
          >
       <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF"/>
        </svg>


</span>

    <?php ActiveForm::end() ?>

</div>

<?php if ($limitExist and !in_array($user['id'], Yii::$app->params['admin_id']) and !in_array($userTo['id'], Yii::$app->params['admin_id'])) : ?>
    <div class="limit-dialog-block no-content-wrap d-flex">
        <div class="row">
            <div class="col-12">
                <h1 class="h1 w-100">Достигнут лимит диалогов</h1>
                <p class="cta-box__text w-100">На сегодня лимит диалогов изчерпан<br>
                    <?php echo Yii::$app->params['dialog_day_limit']; ?> активных диалогов в день <br>
                    Вы можете подключить Досуг <img src="/files/img/vip_icon.png" alt="VIP"> <br>
                и общаться без ограничений</p>
                <span class="blue-btn " data-toggle="modal" data-target="#modal-buy-vip">Подключить</span>
            </div>

        </div>
    </div>
<?php endif; ?>


<?php if ($userTo['privacyParams'] and !in_array($user['id'], Yii::$app->params['admin_id']) and !in_array($userTo['id'], Yii::$app->params['admin_id'])) : ?>

<?php $privacyErrors = array() ?>

    <?php foreach ($userTo['privacyParams'] as $param) : ?>

        <?php

        if ($param['param'] == \frontend\modules\user\models\PrivacySettings::VIP_USER) {

            if ($user['vip_status_work'] < time()) $privacyErrors = true;

        }

        if ($param['param'] == \frontend\modules\user\models\PrivacySettings::FRIEND_USER) {

            if(!\frontend\modules\user\components\helpers\FriendsHelper::isFiends(Yii::$app->user->id, $userTo['id'])){

                $privacyErrors = true;

            }

        }

        ?>

    <?php endforeach; ?>

<?php if ($privacyErrors) : ?>

    <div class="limit-dialog-block no-content-wrap d-flex">
        <div class="row">
            <div class="col-12">

                <p class="cta-box__text w-100"><?php echo $userTo['username'] ?> Ограничел(а) список тех кто может писать ей/ему</p>

                <p class="cta-box__text w-100">
                    Вам нужно:
                </p>

                    <?php foreach ($userTo['privacyParams'] as $param) : ?>

                            <?php  if ($param['param'] == \frontend\modules\user\models\PrivacySettings::VIP_USER) { ?>

                                <?php if ($user['vip_status_work'] < time()) : ?>

                                    <p class="cta-box__text w-100">
                                        Подключить Досуг <img src="/files/img/vip_icon.png" alt="VIP"> <br>
                                    </p>


                                    <span class="blue-btn " data-toggle="modal" data-target="#modal-buy-vip">Подключить</span>

                                    <br>
                                    <br>

                            <?php endif; ?>

                            <? } ?>

                            <?php  if ($param['param'] == \frontend\modules\user\models\PrivacySettings::FRIEND_USER) { ?>

                            <p class="cta-box__text w-100">Отправить заявку в друзья</p>

                            <? } ?>

                    <?php endforeach; ?>

                    <br>


            </div>

        </div>
    </div>

    <?php endif; ?>

<?php endif; ?>