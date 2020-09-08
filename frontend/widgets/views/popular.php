<?php /* @var $popularUsers Profile[] */

use frontend\assets\SlickAsset;
use frontend\modules\user\models\Profile;

if (Yii::$app->user->isGuest) $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
else $onclick = 'onclick="get_foto_ryad_form()"';

?>

    <div class="popular-wrap">

        <div class="container">
            <div class="row">
                <div class="col-2 popular-block-wrap" <?php echo $onclick ?>>
                    <div class="popular-block">
                        <div class="want-here">
                            <div class="want-btn">
                                <span>Хочу сюда</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10">
                    <div class="row">



                        <?php foreach ($popularUsers as $popularItem) : ?>

                            <div class="col-2">
                                <div class="popular-anket-wrap">

                                    <div class="img-wrap">

                                        <a href="/user/<?php echo $popularItem['profile']['id']?>">

                                            <?php if (isset($popularItem['profile']['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $popularItem['profile']['userAvatarRelations']['file']) and $popularItem['profile']['userAvatarRelations']['file']) : ?>

                                                <img loading="lazy" class="img" src="<?= Yii::$app->imageCache->thumbSrc($popularItem['profile']['userAvatarRelations']['file'], 'popular') ?>" >

                                            <?php else : ?>

                                                <img loading="lazy" class="img" src="<?= Yii::$app->imageCache->thumbSrc('/files/uploads/no-photo.jpg', 'popular') ?>" >

                                            <?php endif; ?>
                                        </a>
                                    </div>

                                    <div class="name text-blue">
                                        <?php echo explode(' ', $popularItem['profile']['username'])[0]; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
