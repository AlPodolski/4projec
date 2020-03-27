<?php /* @var $wallItems array */

use yii\widgets\ActiveForm;
use frontend\modules\wall\models\forms\AddCommentForm;
use frontend\modules\wall\components\LikeHelper;

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

            <div class="like-btn <?php echo (Yii::$app->user->isGuest) ? 'guest' : '' ?> " data-id="<?php echo $item['id'] ?>">

                <?php if (!Yii::$app->user->isGuest and !LikeHelper::isLiked(Yii::$app->user->id, $item['id'], Yii::$app->params['wall_item_redis_key'] )) : ?>

                    <span>
                        <i class="far fa-heart"></i>
                    </span>

                    <span class="d-none">
                        <i class="fas fa-heart"></i>
                    </span>

            <?php elseif(Yii::$app->user->isGuest) : ?>

                    <span>
                        <i class="far fa-heart"></i>
                    </span>

                    <span class="d-none">
                        <i class="fas fa-heart"></i>
                    </span>

                <?php else: ?>

                    <span class="d-none">
                        <i class="far fa-heart"></i>
                    </span>

                    <span >
                        <i class="fas fa-heart"></i>
                    </span>

            <?php endif; ?>

            </div>
            <div class="open-comment-btn" data-id="<?php echo $item['id'] ?>">
                <i class="far fa-comment"></i>
            </div>

            <div style="clear: both">
            </div>

            <span class="like-info d-none"></span>

            <?php if (!empty($item['comments'])) : ?>
            <?php /*комментарии к записи*/ ?>
            <div class="comments-list">

                <?php foreach ($item['comments'] as $comment) : ?>

                <div class="comment-item">

                <div class="post_header">

                <a class="post_image " href="/user/<?php echo $comment['author']['id'] ?>" >

                    <?php if (file_exists(Yii::getAlias('@webroot').$comment['author']['avatarRelation']['file']) and $comment['author']['avatarRelation']['file']) : ?>

                        <?= Yii::$app->imageCache->thumb($comment['author']['avatarRelation']['file'], 'dialog', ['class'=>'img']) ?>

                    <?php else : ?>

                        <img src="/files/img/nophoto.png" alt="">

                    <?php endif; ?>

                </a>

                <div class="post_header_info">

                    <a href="/user/<?php echo $comment['author']['id'] ?>" class="author">
                        <?php echo $comment['author']['username'] ?>
                    </a>

                    <div class="post-text post-text-related">
                        <?php echo $comment['text'] ?>
                    </div>
                    <div class="post_date"><span class="post_link"><span class="rel_date"><?php echo Yii::$app->formatter->asDatetime($comment['created_at']) ?></span></span></div>

                </div>
                </div>

                <div style="clear: both">
                </div>


                </div>
                <?php endforeach; ?>


            </div>

            <?php endif; ?>


                <div class="comment-wall-form comment-wall-form-<?php echo $item['id'] ?>">

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
