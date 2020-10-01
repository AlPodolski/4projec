<?php

/* @var $marks array */

?>
<div class="row">
    <div class="col-12">
        <div class="mark-wrap">
            <?php

            foreach ($marks as $mark){

                echo '<div class="popular-mark">';

                echo \yii\helpers\Html::a($mark['text'], $mark['url']);

                echo '</div>';

            }

            ?>
        </div>
    </div>
</div>
