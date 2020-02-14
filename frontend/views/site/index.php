<?php

/* @var $this yii\web\View */
/* @var $city string */
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;
$this->title = 'Знакомства';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php echo PopularWidget::widget(['city' => $city]); ?>

        </div>

        <div class="row">
            <?php

                echo SidebarWidget::Widget()

            ?>
        </div>

    </div>

</div>
