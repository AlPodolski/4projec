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

    <div class="page-block chat-block " data-to="<?php echo $userTo['id'] ?>">

        <div class="chat-wrap-overlow overflow-hidden">
            <div class="chat-wrap" data-read="">
                <div class="chat ">

                    <?php if (isset($dialog['message'])) : foreach ($dialog['message'] as $item) : ?>

                        <div class="wall-tem <?php if (Yii::$app->user->id == $item['author']['id']) echo 'right-message' ?>">

                            <div class="post_header">

                                <a class="post_image" href="/user/<?php echo $item['author']['id'] ?>">

                                    <?php if (file_exists(Yii::getAlias('@webroot') . $item['author']['avatarRelation']['file']) and $item['author']['avatarRelation']['file']) : ?>

                                        <img loading="lazy" class="img"
                                             srcset="<?= Yii::$app->imageCache->thumbSrc($item['author']['avatarRelation']['file'], 'dialog') ?>"
                                             alt="">

                                    <?php else : ?>

                                        <img class="img" src="/files/img/nophoto.png" alt="">

                                    <?php endif; ?>

                                </a>

                                <div class="post_header_info">

                                    <a href="/user/<?php echo $item['author']['id'] ?>" class="author">
                                        <?php echo $item['author']['username'] ?>
                                    </a>
                                    <span class="post_date"><span class="post_link"><span
                                                    class="rel_date"><?php echo Yii::$app->formatter->asDatetime($item['created_at']) ?></span></span></span>
                                    <div class="post-text">

                                        <?php

                                        if ($item['class']) {

                                            if ($item['class'] == \frontend\models\relation\UserPresents::class) {

                                                $userPresent = \frontend\models\relation\UserPresents::find()
                                                    ->where(['id' => $item['related_id']])->asArray()->with('present')->one();

                                                echo '<p>' . $userPresent['message'] . '</p>';

                                                echo \yii\helpers\Html::img($userPresent['present']['img']);

                                            }

                                            if ($item['class'] == \frontend\models\Files::class) {

                                                $messagePhoto = \frontend\models\Files::find()
                                                    ->where(['id' => $item['related_id']])->asArray()->one();

                                                if (Yii::$app->user->identity['vip_status_work'] < time()) {

                                                    echo '<div class="no-vip-photo">';

                                                        echo '<div class="no-vip-photo-wrap">';

                                                            ?>

                                                    <span class="no-img-block" style="background-image: url('<?php echo $messagePhoto['file'] ?>');"></span>

                                                        <?php

                                                        echo '</div>';

                                                    echo '<div class="no-vip-photo-text">';

                                                    echo 'Для просмотра фото требуется Досуг <img src="/files/img/vip_icon.png" alt="VIP">';

                                                    echo '<br><br><br><span class="blue-btn " data-toggle="modal" data-target="#modal-buy-vip">Подключить</span>';

                                                    echo '</div>';

                                                    echo '</div>';

                                                } else {

                                                    echo \yii\helpers\Html::img($messagePhoto['file']);

                                                }


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

                        <p class="cta-box__text w-100 text-center" data-user-id="<?php echo $userTo['id'] ?>"
                           onclick="get_presents(this)">Не знаешь как начать разговор начни с подарка
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2"
                                      stroke-miterlimit="10" stroke-linecap="round"/>
                                <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2"
                                      stroke-miterlimit="10" stroke-linecap="round"/>
                                <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF"
                                      stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z"
                                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z"
                                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </p>

                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="user-write-answer user-write-<?php echo $userTo['id'] ?> ">
        <span class="user-write-message-text d-none">
            <?php echo $userTo['username'] ?> набирает сообщение <img src="/files/img/30.gif" alt="">
        </span>
        </div>

    </div>

    <div class="comment-wall-form page-block comment-wall-form-<?php echo $item['id'] ?>">

        <?php if ($user['vip_status_work'] > time()) : ?>

            <?php $photoForm = ActiveForm::begin([
                'action' => '#',
                'id' => 'send-message-photo-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => false,
                'options' => ['class' => 'form-horizontal', 'onchange' => 'send_message_photo()'],
            ]) ?>
            <?= $photoForm->field($photoModel, 'user_id', ['options' => ['class' => 'd-none']])
                ->hiddenInput(['value' => $user['id']])->label(false) ?>

            <?= $photoForm->field($photoModel, 'dialog_id', ['options' => ['class' => 'd-none']])
                ->hiddenInput(['value' => $dialog_id])->label(false) ?>

            <?= $photoForm->field($photoModel, 'to', ['options' => ['class' => 'd-none']])
                ->hiddenInput(['value' => $userTo['id']])->label(false) ?>

            <div class="send-message-photo">
                <label for="send-message-photo-input" class="">

                    <svg width="28" height="28" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M21.2681 5.04C20.8289 4.57993 20.2224 4.30806 19.5323 4.30806H16.0608V4.26624C16.0608 3.74343 15.8517 3.24152 15.4962 2.90692C15.1407 2.55141 14.6597 2.34229 14.1369 2.34229H7.86312C7.31939 2.34229 6.8384 2.55141 6.48289 2.90692C6.12738 3.26244 5.91825 3.74343 5.91825 4.26624V4.30806H2.46768C1.77757 4.30806 1.1711 4.57993 0.731939 5.04C0.292776 5.47917 0 6.10654 0 6.77575V17.1902C0 17.8803 0.271863 18.4868 0.731939 18.9259C1.1711 19.3651 1.79848 19.6579 2.46768 19.6579H19.5323C20.2224 19.6579 20.8289 19.386 21.2681 18.9259C21.7072 18.4868 22 17.8594 22 17.1902V6.77575C22 6.08563 21.7281 5.47917 21.2681 5.04ZM20.9125 17.1902H20.8916C20.8916 17.5666 20.7452 17.9012 20.4943 18.1522C20.2433 18.4031 19.9087 18.5495 19.5323 18.5495H2.46768C2.09125 18.5495 1.75665 18.4031 1.5057 18.1522C1.25475 17.9012 1.10837 17.5666 1.10837 17.1902V6.77575C1.10837 6.39932 1.25475 6.06472 1.5057 5.81377C1.75665 5.56282 2.09125 5.41643 2.46768 5.41643H6.5038C6.81749 5.41643 7.06844 5.16548 7.06844 4.85179V4.24533C7.06844 4.01529 7.15209 3.80616 7.29848 3.65978C7.44487 3.51339 7.65399 3.42974 7.88403 3.42974H14.1369C14.3669 3.42974 14.576 3.51339 14.7224 3.65978C14.8688 3.80616 14.9525 4.01529 14.9525 4.24533V4.85179C14.9525 5.16548 15.2034 5.41643 15.5171 5.41643H19.5532C19.9297 5.41643 20.2643 5.56282 20.5152 5.81377C20.7662 6.06472 20.9125 6.39932 20.9125 6.77575V17.1902Z"
                                  fill="#486BEF"/>
                            <path d="M11 6.83838C9.5779 6.83838 8.28133 7.42393 7.36117 8.34408C6.42011 9.28515 5.85547 10.5608 5.85547 11.9829C5.85547 13.4049 6.44102 14.7015 7.36117 15.6216C8.30224 16.5627 9.5779 17.1274 11 17.1274C12.422 17.1274 13.7186 16.5418 14.6387 15.6216C15.5798 14.6806 16.1444 13.4049 16.1444 11.9829C16.1444 10.5608 15.5589 9.26423 14.6387 8.34408C13.7186 7.42393 12.422 6.83838 11 6.83838ZM13.8441 14.8479C13.1121 15.5589 12.1083 16.019 11 16.019C9.89159 16.019 8.88779 15.5589 8.15585 14.8479C7.42391 14.1159 6.98475 13.1121 6.98475 12.0038C6.98475 10.8954 7.44482 9.89161 8.15585 9.15967C8.88779 8.42773 9.89159 7.98857 11 7.98857C12.1083 7.98857 13.1121 8.44864 13.8441 9.15967C14.576 9.89161 15.0152 10.8954 15.0152 12.0038C15.0361 13.1121 14.576 14.1159 13.8441 14.8479Z"
                                  fill="#486BEF"/>
                            <path d="M18.4446 8.86681C19.0106 8.86681 19.4694 8.40803 19.4694 7.8421C19.4694 7.27616 19.0106 6.81738 18.4446 6.81738C17.8787 6.81738 17.4199 7.27616 17.4199 7.8421C17.4199 8.40803 17.8787 8.86681 18.4446 8.86681Z"
                                  fill="#486BEF"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="22" height="22" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>

                    <?= $photoForm->field($photoModel, 'photo')
                        ->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => 'send-message-photo-input'])
                        ->label(false) ?>

                </label>
            </div>


            <?php ActiveForm::end() ?>

        <?php else : ?>

            <div class="send-message-photo" onclick="by_vip_for_photo()">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M21.2681 5.04C20.8289 4.57993 20.2224 4.30806 19.5323 4.30806H16.0608V4.26624C16.0608 3.74343 15.8517 3.24152 15.4962 2.90692C15.1407 2.55141 14.6597 2.34229 14.1369 2.34229H7.86312C7.31939 2.34229 6.8384 2.55141 6.48289 2.90692C6.12738 3.26244 5.91825 3.74343 5.91825 4.26624V4.30806H2.46768C1.77757 4.30806 1.1711 4.57993 0.731939 5.04C0.292776 5.47917 0 6.10654 0 6.77575V17.1902C0 17.8803 0.271863 18.4868 0.731939 18.9259C1.1711 19.3651 1.79848 19.6579 2.46768 19.6579H19.5323C20.2224 19.6579 20.8289 19.386 21.2681 18.9259C21.7072 18.4868 22 17.8594 22 17.1902V6.77575C22 6.08563 21.7281 5.47917 21.2681 5.04ZM20.9125 17.1902H20.8916C20.8916 17.5666 20.7452 17.9012 20.4943 18.1522C20.2433 18.4031 19.9087 18.5495 19.5323 18.5495H2.46768C2.09125 18.5495 1.75665 18.4031 1.5057 18.1522C1.25475 17.9012 1.10837 17.5666 1.10837 17.1902V6.77575C1.10837 6.39932 1.25475 6.06472 1.5057 5.81377C1.75665 5.56282 2.09125 5.41643 2.46768 5.41643H6.5038C6.81749 5.41643 7.06844 5.16548 7.06844 4.85179V4.24533C7.06844 4.01529 7.15209 3.80616 7.29848 3.65978C7.44487 3.51339 7.65399 3.42974 7.88403 3.42974H14.1369C14.3669 3.42974 14.576 3.51339 14.7224 3.65978C14.8688 3.80616 14.9525 4.01529 14.9525 4.24533V4.85179C14.9525 5.16548 15.2034 5.41643 15.5171 5.41643H19.5532C19.9297 5.41643 20.2643 5.56282 20.5152 5.81377C20.7662 6.06472 20.9125 6.39932 20.9125 6.77575V17.1902Z"
                              fill="#486BEF"/>
                        <path d="M11 6.83838C9.5779 6.83838 8.28133 7.42393 7.36117 8.34408C6.42011 9.28515 5.85547 10.5608 5.85547 11.9829C5.85547 13.4049 6.44102 14.7015 7.36117 15.6216C8.30224 16.5627 9.5779 17.1274 11 17.1274C12.422 17.1274 13.7186 16.5418 14.6387 15.6216C15.5798 14.6806 16.1444 13.4049 16.1444 11.9829C16.1444 10.5608 15.5589 9.26423 14.6387 8.34408C13.7186 7.42393 12.422 6.83838 11 6.83838ZM13.8441 14.8479C13.1121 15.5589 12.1083 16.019 11 16.019C9.89159 16.019 8.88779 15.5589 8.15585 14.8479C7.42391 14.1159 6.98475 13.1121 6.98475 12.0038C6.98475 10.8954 7.44482 9.89161 8.15585 9.15967C8.88779 8.42773 9.89159 7.98857 11 7.98857C12.1083 7.98857 13.1121 8.44864 13.8441 9.15967C14.576 9.89161 15.0152 10.8954 15.0152 12.0038C15.0361 13.1121 14.576 14.1159 13.8441 14.8479Z"
                              fill="#486BEF"/>
                        <path d="M18.4446 8.86681C19.0106 8.86681 19.4694 8.40803 19.4694 7.8421C19.4694 7.27616 19.0106 6.81738 18.4446 6.81738C17.8787 6.81738 17.4199 7.27616 17.4199 7.8421C17.4199 8.40803 17.8787 8.86681 18.4446 8.86681Z"
                              fill="#486BEF"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="22" height="22" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

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
        <?= $form->field($messageForm, 'chat_id', ['options' => ['class' => 'd-none']])->hiddenInput(['value' => $dialog['dialog_id']])->label(false) ?>

        <?php if ($recepient) : ?>

            <?= $form->field($messageForm, 'user_id', ['options' => ['class' => 'd-none']])->hiddenInput(['value' => $recepient])->label(false) ?>
            <?= $form->field($messageForm, 'from_id', ['options' => ['class' => 'd-none']])->hiddenInput(['value' => $user['id']])->label(false) ?>

        <?php endif; ?>

        <div class="show-message" data-user-id="<?php echo $userTo['id'] ?>" onclick="get_presents(this)"
             data-message="Отправить подарок">
            <svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2"
                      stroke-miterlimit="10" stroke-linecap="round"/>
                <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2"
                      stroke-miterlimit="10" stroke-linecap="round"/>
                <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2"
                      stroke-miterlimit="10" stroke-linecap="round"/>
                <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z"
                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z"
                      stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </div>

        <?= $form->field($messageForm, 'text', ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

        <?php echo PhotoWidget::widget([
            'path' => $user['userAvatarRelations']['file'],
            'size' => 'dialog',
            'options' => [
                'class' => 'img d-none user-img',
                'loading' => 'lazy',
                'alt' => $user['username'],
            ],
        ]); ?>

        <?php echo PhotoWidget::widget([
            'path' => $userTo['userAvatarRelations']['file'],
            'size' => 'dialog',
            'options' => [
                'class' => 'img d-none user-img user-to',
                'loading' => 'lazy',
                'alt' => $userTo['username'],
            ],
        ]); ?>

        <span
            <?php if (!$limitExist or (in_array($user['id'], Yii::$app->params['admin_id']) or in_array($userTo['id'], Yii::$app->params['admin_id']))) : ?>
                data-name="<?php echo $user['username']; ?>"
                data-user-id="<?php echo $user['id']; ?>"
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

            if (!\frontend\modules\user\components\helpers\FriendsHelper::isFiends(Yii::$app->user->id, $userTo['id'])) {

                $privacyErrors = true;

            }

        }

        ?>

    <?php endforeach; ?>

    <?php if ($privacyErrors) : ?>

        <div class="limit-dialog-block no-content-wrap d-flex">
            <div class="row">
                <div class="col-12">

                    <p class="cta-box__text w-100"><?php echo $userTo['username'] ?> Ограничел(а) список тех кто может
                        писать ей/ему</p>

                    <p class="cta-box__text w-100">
                        Вам нужно:
                    </p>

                    <?php foreach ($userTo['privacyParams'] as $param) : ?>

                        <?php if ($param['param'] == \frontend\modules\user\models\PrivacySettings::VIP_USER) { ?>

                            <?php if ($user['vip_status_work'] < time()) : ?>

                                <p class="cta-box__text w-100">
                                    Подключить Досуг <img src="/files/img/vip_icon.png" alt="VIP"> <br>
                                </p>


                                <span class="blue-btn " data-toggle="modal"
                                      data-target="#modal-buy-vip">Подключить</span>

                                <br>
                                <br>

                            <?php endif; ?>

                        <? } ?>

                        <?php if ($param['param'] == \frontend\modules\user\models\PrivacySettings::FRIEND_USER) { ?>

                            <p class="cta-box__text w-100">Отправить заявку в друзья</p>

                        <? } ?>

                    <?php endforeach; ?>

                    <br>


                </div>

            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>