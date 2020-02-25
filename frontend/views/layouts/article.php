<?php /* @var $post Profile */

    use frontend\modules\user\models\Profile;

?>

<?php $post->getAvatar() ?>

<div class="col-4">

    <div class="article-anket-wrap">

        <div class="img-wrap">

            <a href="/user/<?php echo $post->id ?>">

                <?php if ($post->avatar) : ?>

                    <?= Yii::$app->imageCache->thumb($post->avatar, 'listing', ['class'=>'img']) ?>

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