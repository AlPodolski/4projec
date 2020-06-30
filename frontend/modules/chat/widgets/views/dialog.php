<?php /* @var $dialog array */ ?>
<?php /* @var $user array */ ?>
<?php /* @var $recepient integer */ ?>
<?php /* @var $userTo array */ ?>
<?php /* @var $dialog_id integer */ ?>

<?php

use yii\widgets\ActiveForm;
use frontend\widgets\PhotoWidget;

$messageForm = new \frontend\modules\chat\models\forms\SendMessageForm();
$this->registerJsFile('/files/js/chat.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="page-block chat-block " data-to="<?php echo $userTo['id']?>">

    <div class="chat-wrap-overlow overflow-hidden">
        <div class="chat-wrap">
            <div class="chat">

                <?php if (isset($dialog['message'])) : ?>

                    <?php foreach ($dialog['message'] as $item) : ?>

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
</div>

<div  class="comment-wall-form page-block comment-wall-form-<?php echo $item['id'] ?>">

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

    <span data-name="<?php echo $user['username'];  ?>" data-name-to="<?php echo $userTo['username']; ?>" data-dialog-id="<?php echo $dialog_id; ?>" onclick="send_message(this)" class="message-send-btn" data-id="<?php echo $item['id']; ?>">Отправить</span>

    <?php ActiveForm::end() ?>

</div>