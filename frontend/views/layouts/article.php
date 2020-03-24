<?php /* @var $post Profile */

    use frontend\modules\user\models\Profile;

?>


<div class="col-12">

    <div class="article-anket-wrap">

        <div class="img-wrap">

            <a href="/user/<?php echo $post->id ?>">

                <?php if (file_exists(Yii::getAlias('@webroot').$post->userAvatarRelations['file']) and $post->userAvatarRelations['file']) : ?>

                    <?= Yii::$app->imageCache->thumb($post->userAvatarRelations['file'], 'listing', ['class'=>'img']) ?>

                <?php else : ?>

                    <img src="/files/img/nophoto.png" alt="">

                <?php endif; ?>
            </a>
        </div>
        <div class="razd">

        </div>
        <div class="name">
            <?php echo $post->username; ?>
        </div>

        <div class="like-wrap">
            <div class="message"><i class="far fa-envelope"></i></div><div class="favorite"><i class="far fa-heart"></i></div><div class="like"><i class="far fa-thumbs-up"></i></div>
        </div>

        <?php if ($post->phone) : ?>

            <div class="phone" data-phone="<?php echo $post->phone ?>" onclick="showPhone(this)">
                посмотреть телефон
            </div>

        <?php endif; ?>

    </div>
</div>