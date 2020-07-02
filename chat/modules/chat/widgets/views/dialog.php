<?php /* @var $dialog array */ ?>
<?php /* @var $user array */ ?>
<?php /* @var $fakeUsers array */ ?>
<?php /* @var $recepient integer */ ?>

<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$messageForm = new \frontend\modules\chat\models\forms\SendMessageForm();
$this->registerJsFile('/files/js/chat.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="page-block chat-block">
    <a href="/"><i class="fas fa-arrow-left"></i>Назад</a>
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

    <?= $form->field($messageForm, 'text' , ['options' => ['class' => 'form-otvet']])
        ->textarea(['placeholder' => 'Напишите что то',
            'onkeyup' => 'sendAnswerSignal(this)',
            'onfocusout' => 'sendStopAnswerSignal(this)',
            'data-is-answer-now' => '0',
            'data-id' => $user['id'],
            'data-user-id-to' => $recepient,
        ])->label(false) ?>

    <span data-name="<?php echo $user['username'];  ?>" data-dialog-id="<?php echo  $dialog['dialog_id'] ?>" data-user-id-to="<?php echo $recepient ?>" onclick="send_message(this)" class="message-send-btn" data-id="<?php echo $user['id']; ?>">Отправить</span>

    <?php ActiveForm::end() ?>

</div>