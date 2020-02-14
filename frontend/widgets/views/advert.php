<?php /* @var $lastAdvert Advert[] */

use frontend\modules\advert\models\Advert;

$this->registerJsFile('/files/js/obuavi.js', ['depends' => [\frontend\assets\AppAsset::class]]);

?>
<div class="user-menu">

    <div class="row">
        <div class="col-9">
            <p class="user-name">
                интим объявления
            </p>
        </div>
        <div class="col-3">
                    <span class="user-ab ">
                        <i class="fas fa-bars"></i>
                    </span>
        </div>
    </div>

</div>

<div class="user-ab-wrap">

    <div class="user-ab-wrapper">

        <?php foreach ($lastAdvert as $advert) : ?>

            <div class="user-ab-item">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="col-10">
                        <div class="name">
                            <a class="name" href="/user/<?php echo $advert->user_id ?>">
                                <?php echo $advert->getUserName() ?>
                            </a>
                        </div>
                        <div class="text-ab">
                            <?= $advert->text ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <div class="user-ab-item">
        <div class="row">
            <div class="col-12">
                <a class="all-advert" href="/adverts">Все объявления</a>
            </div>
        </div>
    </div>

</div>