<?php /* @var $post Profile */
      /* @var $cityInfo array */
      /* @var $cssClass string */

use frontend\modules\user\models\Profile;

?>

<?php

if (!isset($cssClass))  $cssClass = 'col-6 col-sm-6 col-md-4 col-lg-4';

?>

<div class="<?php echo $cssClass ?>">

    <div class="article-anket-wrap position-relative">

        <?php if ($post['vip_status_work'] > time()) : ?>

            <div class="vip-icon-wrap">
                <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
            </div>

        <?php endif; ?>

        <div class="img-wrap d-flex ">

            <a href="/user/<?php echo $post->id ?>">


                <?php if (isset($post->userAvatarRelations['file']) and file_exists(Yii::getAlias('@webroot') . $post->userAvatarRelations['file']) and $post->userAvatarRelations['file']) : ?>

                    <picture>
                        <source srcset="<?= Yii::$app->imageCache->thumbSrc($post->userAvatarRelations['file'], 'listing_500') ?>"
                                media="(max-width: 500px)">
                        <source srcset="<?= Yii::$app->imageCache->thumbSrc($post->userAvatarRelations['file'], 'listing') ?>">
                        <img loading="lazy" class="img"
                             srcset="<?= Yii::$app->imageCache->thumbSrc($post->userAvatarRelations['file'], 'listing') ?>">
                    </picture>

                <?php else : ?>

                    <img src="/files/img/nophoto.png" alt="">

                <?php endif; ?>
            </a>
        </div>
        <div class="name">
            <?php echo explode(' ', $post->username)[0]; ?>
            <?php if ($post->birthday) { ?>
                <span class="old">
                   <?php echo \frontend\components\YearHelper::Year((time() - $post->birthday) / 31556926); ?>
                </span>
            <?php } ?>
            <?php if ($post['last_visit_time'] > time() - 3600) : ?>

                <div class="online"></div>

            <?php endif; ?>
        </div>

        <div class="city-info">
            <?php echo $cityInfo['city']?>
        </div>

    </div>
</div>