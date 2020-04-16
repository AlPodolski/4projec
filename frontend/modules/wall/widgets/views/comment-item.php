<?php /* @var $comment array */ ?>

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

