<?php /* @var $popularUsers Profile[] */

use frontend\assets\SlickAsset;
use frontend\modules\user\models\Profile;

SlickAsset::register($this);
?>
    <div class="popular-block-mobile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-block-wrap-mobile">
                        <div class="col-12">
                            <span class="popular-anket" onclick="get_foto_ryad_form()">Хочу сюда </span>
                        </div>
                        <div class="col-12 slider-popular">
                            <?php foreach ($popularUsers as $popularItem) : ?>

                                <div class="popular-anket-wrap">

                                    <div class="img-wrap">

                                        <a href="/user/<?php echo $popularItem['profile']['id']?>">

                                            <?php if (isset($popularItem['profile']['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $popularItem['profile']['userAvatarRelations']['file']) and $popularItem['profile']['userAvatarRelations']['file']) : ?>

                                                <?= Yii::$app->imageCache->thumb($popularItem['profile']['userAvatarRelations']['file'], 'popular', ['class' => 'img']) ?>

                                            <?php else : ?>

                                                <?= Yii::$app->imageCache->thumb('/files/uploads/no-photo.jpg', 'popular_big', ['class' => 'img']) ?>

                                            <?php endif; ?>
                                        </a>
                                    </div>

                                    <div class="name text-blue">
                                        <?php echo explode(' ', $popularItem['profile']['username'])[0]; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="popular-wrap">

        <div class="container">
            <div class="row">
                <div class="col-2 popular-block-wrap" onclick="get_foto_ryad_form()">
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
                        <?php foreach ($popularUsers as $popularUsers) : ?>

                            <div class="col-2">
                                <div class="popular-anket-wrap">

                                    <div class="img-wrap">

                                        <a href="/user/<?php echo $popularItem['profile']['id']?>">

                                            <?php if (isset($popularItem['profile']['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $popularItem['profile']['userAvatarRelations']['file']) and $popularItem['profile']['userAvatarRelations']['file']) : ?>

                                                <?= Yii::$app->imageCache->thumb($popularItem['profile']['userAvatarRelations']['file'], 'popular', ['class' => 'img']) ?>

                                            <?php else : ?>

                                                <?= Yii::$app->imageCache->thumb('/files/uploads/no-photo.jpg', 'popular_big', ['class' => 'img']) ?>

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
