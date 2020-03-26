<?php /* @var $wallItems array */

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
            <div style="clear: both"></div>

            <div class="post-text">
                <?php echo $item['text'] ?>
            </div>

</div>

    <div style="clear: both"></div>

    <?php endforeach; ?>

<?php else : ?>

<?php endif;
