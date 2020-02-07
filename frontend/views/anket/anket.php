<?php

use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\assets\SlickAsset;
/* @var $model Profile */

$this->registerJsFile('/files/js/lightgallery-all.min.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.carousel.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.navigation.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->registerCssFile('/css/lightgallery.min.css');
$this->registerCssFile('/css/owl.carousel.min.css');
$this->registerCssFile('/css/owl.theme.default.min.css');

SlickAsset::register($this);

$this->registerJsFile('/files/js/single.js', ['depends' => [SlickAsset::className()]]);

$photo = Photo::getUserphoto($model->id);

?>

<div class="anket">
    <div class="row">
        <div class="col-6">
            <div class="single-photo">

                <div class="slider slider-for">

                    <?php if (!empty($photo)) : ?>

                        <?php foreach ($photo as $item) : ?>

                            <div class="item">
                                <img src="<?php echo $item->file?>" alt="<?php echo $model['username']  ?>">
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

                <div class="slider slider-nav">

                    <?php if (!empty($photo)) : ?>

                        <?php foreach ($photo as $item) : ?>

                        <div class="item">
                            <img src="<?php echo $item->file?>" alt="<?php echo $model['username']  ?>">
                        </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>



            </div>
        </div>
        <div class="col-6">

        </div>
    </div>
</div>
