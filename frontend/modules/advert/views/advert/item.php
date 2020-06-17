<?php /* @var $advert Advert */

use frontend\modules\advert\models\Advert;
use frontend\widgets\PhotoWidget;
?>
<div class="row advert-item">

    <?php if ($advert['userRelations']) : ?>

    <div class="col-12">
        <div class="row user-info">
            <div class="col-3 col-sm-2 col-md-1 ">
                <div class="dialog-photo">
                    <a class="name" href="/user/<?php echo $advert['userRelations']['id'] ?>">
                        <?php echo PhotoWidget::widget([
                            'path' => $advert['userRelations']['userAvatarRelations']['file'],
                            'size' => 'dialog',
                            'options' => [
                                'class' => 'img',
                                'loading' => 'lazy',
                                'alt' => $advert['userRelations']['username'],
                            ],
                        ]); ?>
                    </a>
                </div>
            </div>
            <div class="col-9 col-sm-10 col-md-11">
                <div class="name">
                    <a class="name" href="/user/<?php echo $advert['userRelations']['id'] ?>">
                        <?php echo  $advert['userRelations']['username'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <div class="col-12 advert-item-text">
        <div >
            <a class="name" href="/adverts/<?php echo $advert->id ?>">
                <?php echo $advert->title; ?>
            </a>
        </div>
        <div class="text-ab">
            <a href="/adverts/<?php echo $advert->id ?>">
                <?php echo $advert->text; ?>
            </a>
        </div>
    </div>
</div>
