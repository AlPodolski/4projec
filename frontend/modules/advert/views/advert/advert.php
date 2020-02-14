<?php
/* @var $advertList Advert[] */

use frontend\modules\advert\models\Advert;
use frontend\widgets\SidebarWidget;

$this->title = 'интим объявления';

?>
<div class="row">
    <?php

    echo SidebarWidget::Widget()

    ?>

    <div class="col-9">

        <div class="anket">

            <h1>Интим объявления</h1>

            <?php foreach ($advertList as $advert) : ?>

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

            <?php endforeach; ?>

        </div>

    </div>

</div>


