<?php

/* @var $advert array */
/* @var $this yii\web\View */

use frontend\widgets\SidebarWidget;

$this->registerMetaTag([
        'name' => 'description',
        'content' =>  mb_substr($advert['text'], 0, 255),

]);

?>
<div class="row">
    <div class="col-3">
        <?php

        echo SidebarWidget::Widget()

        ?>
    </div>


    <div class="col-12 col-xl-9">

        <div class="anket">

            <?php if (isset($advert['title']) and $advert['title']) : ?>

                <h1><?php echo $this->title = $advert['title'] ?></h1>

            <?php endif; ?>

            <?php if (isset($advert['text']) and $advert['text']) : ?>

                <p><?php echo $advert['text'] ?></p>

            <?php endif ; ?>

        </div>

    </div>

</div>