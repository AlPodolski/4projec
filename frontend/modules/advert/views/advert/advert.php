<?php
/* @var $advertList Advert[] */
/* @var $this View */

use frontend\modules\advert\models\Advert;
use frontend\widgets\SidebarWidget;
use yii\web\View;

$this->title = 'Интим объявления';

$this->registerJsFile('/files/js/page_a.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">
    <div class="col-3">
        <?php

        echo SidebarWidget::Widget()

        ?>
    </div>


    <div class="col-12 col-xl-9">

        <div class="anket content">

            <h1>Интим объявления</h1>

            <?php foreach ($advertList as $advert) : ?>

                <?php echo  $this->renderFile('@app/modules/advert/views/advert/item.php' , [
                        'advert' => $advert
                ]) ?>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="col-12 pager" data-url="/more-adverds" data-page="1"></div>

</div>


