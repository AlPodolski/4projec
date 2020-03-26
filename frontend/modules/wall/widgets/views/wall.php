<?php /* @var $wallItems array */

use yii\widgets\ActiveForm;
use frontend\modules\wall\models\forms\AddCommentForm;

$commentForm = new AddCommentForm();

if (!empty($wallItems)) : ?>

    <?php foreach ($wallItems as $item) : ?>

        <div class="wall-tem page-block">

        <div class="post_header">

        <a class="post_image" href="/user/<?php echo $item['author']['id'] ?>" >

            <?php if (file_exists(Yii::getAlias('@webroot').$item['author']['avatarRelation']['file']) and $item['author']['avatarRelation']['file']) : ?>

                <?= Yii::$app->imageCache->thumb($item['author']['avatarRelation']['file'], 'dialog', ['class'=>'img']) ?>

            <?php else : ?>

                <img src="/files/img/nophoto.png" alt="">

            <?php endif; ?>

        </a>

        <div class="post_header_info">

            <a href="/user/<?php echo $item['author']['id'] ?>" class="author">
                <?php echo $item['author']['username'] ?>
            </a>
            <div class="post_date"><span class="post_link"><span class="rel_date"><?php echo Yii::$app->formatter->asDatetime($item['created_at']) ?></span></span></div>
        </div>


    </div>
            <div style="clear: both">
            </div>

            <div class="post-text">
                <?php echo $item['text'] ?>
            </div>

            <div class="open-comment-btn" data-id="<?php echo $item['id'] ?>">
                <i class="far fa-comment"></i>
            </div>

                <div class="comment-wall-form d-none comment-wall-form-<?php echo $item['id'] ?>">

                    <?php

                    $form = ActiveForm::begin([
                        'action' => '#',
                        'id' => 'wall-form',
                        'options' => ['class' => 'form-horizontal form-wall-comment-'.$item['id']],
                    ]) ?>
                    <?= $form->field($commentForm, 'related_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $item['id']])->label(false) ?>
                    <?= $form->field($commentForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

                        <span class="send-comment-btn" data-id="<?php echo $item['id']; ?>"><i class="far fa-paper-plane"></i></span>

                    <?php ActiveForm::end() ?>

                </div>


</div>

    <div style="clear: both"></div>

    <?php endforeach; ?>

<?php else : ?>

<?php endif;
