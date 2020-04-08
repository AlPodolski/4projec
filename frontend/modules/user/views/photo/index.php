<?php

/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <div class="col-3">
        <?php echo UserSideBarWidget::Widget()?>
    </div>

    <div class="col-12 col-xl-9">

        <div class="page-block anket all-photo">

        <?php if (!empty($photo)) :  ?>

            <div class="row">
                <?php foreach ($photo as $item) :  ?>

                    <div class="col-6 col-sm-3 col-lg-2">
                        <div class="item">
                            <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $item['user_id'] ) : ?>

                                <span onclick="deletePhotoItem(this)" data-id="<?php echo $item['id']; ?>" class="wall-tem-menu"><i class="fas fa-times"></i></span>

                            <?php endif; ?>
                            <?php if (file_exists(Yii::getAlias('@webroot') . $item->file) and $item->file) : ?>

                                <?= Yii::$app->imageCache->thumb($item->file, 'gallery-mini', ['class' => 'img']) ?>

                            <?php endif; ?>
                        </div>

                    </div>

                <?php endforeach; ?>
            </div>

        <?php else : ?>

        <p class="alert alert-info">Пока нет фото</p>

        <?php endif;  ?>

    </div>

    </div>


</div>