<?php /* @var $popularUsers Profile[] */

use frontend\assets\SlickAsset;
use frontend\modules\user\models\Profile;


?>
    <div class="popular-block-mobile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-block-wrap-mobile">
                        <div class="row">
                            <div class="col-12">
                                <span class="popular-anket" onclick="get_foto_ryad_form()">Хочу сюда </span>
                            </div>
                            <div class="col-2 want-here" onclick="get_foto_ryad_form()">
                                <div class="want-here" style="align-items: center;justify-content: center;display: flex;">
                                    <div class="want-btn">
                                        <svg width="42" height="41" viewBox="0 0 42 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M34.2398 17.9375H23.625V7.57539C23.625 6.22207 22.452 5.125 21 5.125C19.548 5.125 18.375 6.22207 18.375 7.57539V17.9375H7.76016C6.37383 17.9375 5.25 19.0826 5.25 20.5C5.25 21.9174 6.37383 23.0625 7.76016 23.0625H18.375V33.4246C18.375 34.7779 19.548 35.875 21 35.875C22.452 35.875 23.625 34.7779 23.625 33.4246V23.0625H34.2398C35.6262 23.0625 36.75 21.9174 36.75 20.5C36.75 19.0826 35.6262 17.9375 34.2398 17.9375Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 slider-popular">

                                <?php foreach ($popularUsers as $popularItem) : ?>

                                    <div class="popular-anket-wrap">

                                        <div class="img-wrap">

                                            <a href="/user/<?php echo $popularItem['profile']['id']?>">

                                                <?php if (isset($popularItem['profile']['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $popularItem['profile']['userAvatarRelations']['file']) and $popularItem['profile']['userAvatarRelations']['file']) : ?>

                                                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($popularItem['profile']['userAvatarRelations']['file'], 'popular') ?>" alt="">

                                                <?php else : ?>

                                                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc('/files/uploads/no-photo.jpg', 'popular_big') ?>" alt="">

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
