<?php
/* @var $resultPhotoItems array */

if (!empty($resultPhotoItems)){

    foreach ($resultPhotoItems as $item){ ?>
        <div class="col-6 col-sm-3 col-lg-2">
            <div class="item">
                <span onclick="deletePhotoItem(this)" data-id="<?php echo $item['id'] ?>" class="wall-tem-menu"><i class="fas fa-times"></i></span>
                <?php if (file_exists(Yii::getAlias('@webroot') .  $item['file']) and  $item['file']) : ?>

                    <?= Yii::$app->imageCache->thumb( $item['file'], 'gallery-mini', ['class' => 'img']) ?>

                <?php endif; ?>
            </div>
        </div>
<?php

    }

}