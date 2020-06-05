<?php

use chat\modules\chat\widgets\MessageListWidget;

/* @var $this yii\web\View */
/* @var $fakeUsers array */

$this->title = 'Чат';

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-12 col-xl-12">

                <?php
                    echo MessageListWidget::widget(['user_id' => $fakeUsers]);
                ?>

            </div>
        </div>

    </div>
</div>
