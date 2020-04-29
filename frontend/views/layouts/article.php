<?php /* @var $post Profile */

    use frontend\modules\user\models\Profile;

?>


<div class="col-12 col-sm-6 col-md-4 col-lg-4">

    <div class="article-anket-wrap">

        <div class="img-wrap">

            <a href="/user/<?php echo $post->id ?>">

                <?php if (isset($post->userAvatarRelations['file']) and file_exists(Yii::getAlias('@webroot').$post->userAvatarRelations['file']) and $post->userAvatarRelations['file']) : ?>

                    <?= Yii::$app->imageCache->thumb($post->userAvatarRelations['file'], 'listing', ['class'=>'img']) ?>

                <?php else : ?>

                    <img src="/files/img/nophoto.png" alt="">

                <?php endif; ?>
            </a>
        </div>
        <div class="razd">

        </div>
        <div class="name">
            <?php echo explode(' ', $post->username)[0]; ?>
        </div>

        <div class="like-wrap">
            <div class="message" onclick="get_message_form(this)" data-user-id="<?php echo $post->id ?>" ><i class="far fa-envelope"></i></div>
        </div>

        <?php if ($post->phone) : ?>

            <div class="phone" data-phone="<?php echo $post->phone ?>" onclick="showPhone(this)">
                посмотреть телефон
            </div>

        <?php endif; ?>

    </div>
</div>