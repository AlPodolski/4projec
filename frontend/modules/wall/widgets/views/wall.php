<?php /* @var $wallItems array */

use yii\widgets\ActiveForm;
use frontend\modules\wall\models\forms\AddCommentForm;
use frontend\modules\wall\components\LikeHelper;

$commentForm = new AddCommentForm();
?>



<?php

if (!empty($wallItems)) : ?>

    <?php foreach ($wallItems as $item) : ?>

        <div class="wall-tem page-block">

            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $item['author']['id'] or Yii::$app->user->id == $item['user_id'] ) : ?>

                <span onclick="deleteWallItem(this)" data-id="<?php echo $item['id']; ?>" class="wall-tem-menu"><i class="fas fa-times"></i></span>

            <?php endif; ?>

        <div class="post_header">

            <a class="post_image" href="/user/<?php echo $item['author']['id'] ?>">

                <?php if (isset($item['author']['avatarRelation']['file']) and file_exists(Yii::getAlias('@webroot').$item['author']['avatarRelation']['file']) and $item['author']['avatarRelation']['file']) : ?>

                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($item['author']['avatarRelation']['file'], 'dialog') ?>" alt="">

                <?php else : ?>

                    <img class="img" src="/files/img/nophoto.png" alt="">

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

            <div onclick="like(this)" class="like-btn <?php echo (Yii::$app->user->isGuest) ? 'guest' : '' ?> " data-id="<?php echo $item['id'] ?>">

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

            <div class="like-count">
                <?php echo LikeHelper::countLike($item['id'], Yii::$app->params['wall_item_redis_key'] ); ?>
            </div>

            </div>
            <div class="open-comment-btn" data-id="<?php echo $item['id'] ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.8906 2.20312H2.10938C0.946289 2.20312 0 3.14941 0 4.3125V15.5625C0 16.7256 0.946289 17.6719 2.10938 17.6719H4.26562V21.1875C4.26562 21.7689 4.93048 22.0952 5.39062 21.75L10.8281 17.6719H21.8906C23.0537 17.6719 24 16.7256 24 15.5625V4.3125C24 3.14941 23.0537 2.20312 21.8906 2.20312ZM22.5938 15.5625C22.5938 15.9501 22.2783 16.2656 21.8906 16.2656H10.5938C10.4416 16.2656 10.2936 16.3151 10.1719 16.4062L5.67188 19.7812V16.9688C5.67188 16.5804 5.35712 16.2656 4.96875 16.2656H2.10938C1.72174 16.2656 1.40625 15.9501 1.40625 15.5625V4.3125C1.40625 3.92487 1.72174 3.60938 2.10938 3.60938H21.8906C22.2783 3.60938 22.5938 3.92487 22.5938 4.3125V15.5625Z" fill="#486BEF"/>
                    <path d="M19.0312 6.42188H4.96875C4.58038 6.42188 4.26562 6.73663 4.26562 7.125C4.26562 7.51337 4.58038 7.82812 4.96875 7.82812H19.0312C19.4196 7.82812 19.7344 7.51337 19.7344 7.125C19.7344 6.73663 19.4196 6.42188 19.0312 6.42188Z" fill="#486BEF"/>
                    <path d="M14.1094 9.9375C14.1094 9.54913 13.7946 9.23438 13.4062 9.23438H4.96875C4.58038 9.23438 4.26562 9.54913 4.26562 9.9375C4.26562 10.3259 4.58038 10.6406 4.96875 10.6406H13.4062C13.7946 10.6406 14.1094 10.3259 14.1094 9.9375Z" fill="#486BEF"/>
                    <path d="M19.0312 9.23438H16.2188C15.8304 9.23438 15.5156 9.54913 15.5156 9.9375C15.5156 10.3259 15.8304 10.6406 16.2188 10.6406H19.0312C19.4196 10.6406 19.7344 10.3259 19.7344 9.9375C19.7344 9.54913 19.4196 9.23438 19.0312 9.23438Z" fill="#486BEF"/>
                    <path d="M9.1875 12.0469H4.96875C4.58038 12.0469 4.26562 12.3616 4.26562 12.75C4.26562 13.1384 4.58038 13.4531 4.96875 13.4531H9.1875C9.57587 13.4531 9.89062 13.1384 9.89062 12.75C9.89062 12.3616 9.57587 12.0469 9.1875 12.0469Z" fill="#486BEF"/>
                    <path d="M19.0312 12.0469H12C11.6116 12.0469 11.2969 12.3616 11.2969 12.75C11.2969 13.1384 11.6116 13.4531 12 13.4531H19.0312C19.4196 13.4531 19.7344 13.1384 19.7344 12.75C19.7344 12.3616 19.4196 12.0469 19.0312 12.0469Z" fill="#486BEF"/>
                </svg>
            </div>

            <div style="clear: both">
            </div>

            <span class="like-info d-none"></span>
            <div class="comments-list">

            <?php if (!empty($item['comments'])) : ?>
            <?php /*комментарии к записи*/ ?>

                <?php foreach ($item['comments'] as $comment) : ?>

                <?php echo $this->renderFile('@app/modules/wall/widgets/views/comment-item.php', [
                        'comment' => $comment
                    ]); ?>

                <?php endforeach; ?>

            <?php endif; ?>
            </div>


            <?php if (Yii::$app->user->isGuest) : ?>

            <p class="alert alert-info">Для того что бы комментировать стену требуется авторизация</p>

        <?php else : ?>

                <div class="comment-wall-form comment-wall-form-<?php echo $item['id'] ?> d-none">

                    <?php

                    $form = ActiveForm::begin([
                        'action' => '#',
                        'id' => 'wall-form',
                        'options' => ['class' => 'form-horizontal form-wall-comment-'.$item['id']],
                    ]) ?>
                    <?= $form->field($commentForm, 'related_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $item['id']])->label(false) ?>
                    <?= $form->field($commentForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>

                    <span class="send-comment-btn" onclick="send_comment(this)" data-id="<?php echo $item['id']; ?>">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF" fill-opacity="0.13"/>
                            </svg>
                    </span>

                    <?php ActiveForm::end() ?>

                </div>

        <?php endif; ?>



</div>

    <div style="clear: both"></div>

    <?php endforeach; ?>

<?php else : ?>

<?php endif;?>

