<?php /* @var $dialog array */ ?>
<?php /* @var $user array */ ?>
<?php /* @var $fakeUsers array */ ?>
<?php /* @var $recepient integer */ ?>

<?php
$photoModel = new \frontend\modules\chat\models\forms\SendPhotoForm();

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$messageForm = new \frontend\modules\chat\models\forms\SendMessageForm();
$this->registerJsFile('/files/js/chat.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="page-block chat-block">

    <?php if($user['privacyParams']) : ?>

    <span>Ограничения:</span>

    <?php foreach ($user['privacyParams'] as $param) : ?>

            <?php  if ($param['param'] == \frontend\modules\user\models\PrivacySettings::VIP_USER) { ?>

                <?php if ($user['vip_status_work'] < time()) : ?>

                    вип

                <?php endif; ?>

            <? } ?>

            <?php  if ($param['param'] == \frontend\modules\user\models\PrivacySettings::FRIEND_USER) { ?>

                <p class="cta-box__text w-100">Друзья</p>

            <? } ?>

    <?php endforeach; ?>

    <?php endif; ?>
    <div class="col-12" onclick="add_to_black(this)" data-user-id="<?php echo $recepient ?>">
        <div class="btn btn-danger black-list-btn">
            В черный список
        </div>
    </div>
    <div class="chat-wrap">

    <div class="chat">

        <?php if (isset($dialog['message'])) : ?>

        <?php foreach ($dialog['message'] as $item) : ?>

        <div class="wall-tem <?php if ($user['id'] == $item['author']['id']) echo 'right-message' ?>">

            <div class="post_header">

                <a class="post_image" target="_blank" href="<?php echo 'http://msk.'.Yii::$app->params['site_name'] ?>/user/<?php echo $item['author']['id'] ?>">

                    <?php

                        $src = 'http://msk.'.Yii::$app->params['site_name'] .$item['author']['avatarRelation']['file'];

                        echo Html::img($src, [ 'class' => 'img']);

                    ?>

                </a>

                <div class="post_header_info">

                    <a target="_blank" href="<?php echo 'http://msk.'.Yii::$app->params['site_name'] ?>/user/<?php echo $item['author']['id'] ?>" class="author">
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

                                echo \yii\helpers\Html::img('http://msk.'.Yii::$app->params['site_name'].$userPresent['present']['img']);

                            }

                            if($item['class'] == \frontend\models\Files::class){

                                $messagePhoto = \frontend\models\Files::find()
                                    ->where(['id' => $item['related_id']])->asArray()->one();

                                echo \yii\helpers\Html::img('http://msk.'.Yii::$app->params['site_name'].$messagePhoto['file'], ['class' => 'blur-10 remove-blur-hover']);

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

        <?php endif; ?>

    </div>

    </div>

</div>


<div onfocusout="" class="comment-wall-form page-block comment-wall-form-<?php echo $item['id'] ?>">

    <?php $photoForm = ActiveForm::begin([
        'action' => '#',
        'id' => 'send-message-photo-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'options' => ['class' => 'form-horizontal' , 'data-action' => 'http://msk.'.Yii::$app->params['site_name'].'/chat/send/send-photo'],
    ]) ?>
    <?= $photoForm->field($photoModel, 'user_id',['options' => ['class' => 'd-none']])
        ->hiddenInput(['value' => $user['id']])->label(false) ?>

    <?= $photoForm->field($photoModel, 'dialog_id',['options' => ['class' => 'd-none']])
        ->hiddenInput(['value' => $dialog['dialog_id']])->label(false) ?>

    <?= $photoForm->field($photoModel, 'to',['options' => ['class' => 'd-none']])
        ->hiddenInput(['value' => $recepient])->label(false) ?>

    <div class="img-label-wrap send-message-photo">
        <label for="send-message-photo-input" class="">

            <i class="fas fa-camera"></i>

            <?= $photoForm->field($photoModel, 'photo')
                ->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'send-message-photo-input', 'onchange' => 'send_photo_to_user()'])
                ->label(false) ?>

        </label>
    </div>


    <?php ActiveForm::end() ?>

    <?php

    $form = ActiveForm::begin([
        'action' => '#',
        'id' => 'message-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($messageForm, 'chat_id',['options' => ['class' => 'd-none']])
        ->hiddenInput(['value' => $dialog['dialog_id']])->label(false) ?>

    <?php if ($recepient) :?>

        <?= $form->field($messageForm, 'user_id',['options' => ['class' => 'd-none']])
            ->hiddenInput(['value' => $user['id']])->label(false) ?>

    <?php endif; ?>

    <?= $form->field($messageForm, 'from_id')->hiddenInput(['value' => $user['id']])->label(false) ?>

    <div class="show-message" data-from="<?php echo $user['id']; ?>" data-user-id="<?php echo $recepient ?>" onclick="get_presents(this)"data-message="Отправить подарок">
        <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <?= $form->field($messageForm, 'text' , ['options' => ['class' => 'form-otvet']])
        ->textarea(['placeholder' => 'Напишите что то',
            'onkeyup' => 'sendAnswerSignal(this)',
            'onfocusout' => 'sendStopAnswerSignal(this)',
            'data-is-answer-now' => '0',
            'data-id' => $user['id'],
            'data-user-id-to' => $recepient,
        ])->label(false) ?>

    <span data-name="<?php echo $user['username'];  ?>"
          data-dialog-id="<?php echo  $dialog['dialog_id'] ?>"
          data-user-id-to="<?php echo $recepient ?>"
          onclick="send_message(this);ym(57612607,'reachGoal','alina')"
          class="message-send-btn" data-id="<?php echo $user['id']; ?>">
         <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF"/>
        </svg>
    </span>

    <?php ActiveForm::end() ?>

</div>