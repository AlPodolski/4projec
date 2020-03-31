<?php /* @var $dialog array */ ?>

<?php

use yii\widgets\ActiveForm;

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

        <div class="comment-wall-form comment-wall-form-<?php echo $item['id'] ?>">

            <?php

            $form = ActiveForm::begin([
                'action' => '#',
                'id' => 'wall-form',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($commentForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

            <span class="send-comment-btn" data-id="<?php echo $item['id']; ?>"><i class="far fa-paper-plane"></i></span>

            <?php ActiveForm::end() ?>

        </div>

    </div>
</div>