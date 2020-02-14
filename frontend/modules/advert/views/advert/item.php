<?php /* @var $advert Advert */

use frontend\modules\advert\models\Advert; ?>
<div class="row advert-item">
    <div class="col-1 advert-item-icon">
        <i class="fas fa-comment"></i>
    </div>
    <div class="col-11">
        <div class="name">
            <a class="name" href="/user/<?php echo $advert->user_id ?>">
                <?php echo $advert->getUserName() ?>
            </a>
        </div>
        <div class="text-ab">
            <?php echo $advert->text; ?>
        </div>
    </div>
</div>
