<?php /* @var $dialog array */ ?>
<?php /* @var $user array */ ?>

<?php

use yii\widgets\ActiveForm;

$messageForm = new \frontend\modules\chat\models\forms\SendMessageForm();
$this->registerJsFile('/files/js/chat.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>

<div class="page-block chat-block ">
    <div class="chat">

        <?php foreach ($dialog['message'] as $item) : ?>

        <div class="wall-tem">

            <div class="post_header">

                <a class="post_image" href="/user/<?php echo $item['author']['id'] ?>">

                    <?php if (file_exists(Yii::getAlias('@webroot').$item['author']['avatarRelation']['file']) and $item['author']['avatarRelation']['file']) : ?>

                        <?= Yii::$app->imageCache->thumb($item['author']['avatarRelation']['file'], 'dialog', ['class'=>'img']) ?>

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

    <?= $form->field($messageForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

    <?php if (file_exists(Yii::getAlias('@webroot').$user['userAvatarRelations']['file']) and $user['userAvatarRelations']['file']) : ?>

        <?= Yii::$app->imageCache->thumb($user['userAvatarRelations']['file'], 'dialog', ['class'=>'img d-none user-img']) ?>

    <?php else : ?>

        <img class="img d-none user-img" src="/files/img/nophoto.png" alt="">

    <?php endif; ?>

    <span data-name="<?php echo $user['username'];  ?>" class="message-send-btn" data-id="<?php echo $item['id']; ?>"><i class="far fa-paper-plane"></i></span>

    <?php ActiveForm::end() ?>

</div>