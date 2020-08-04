<?php

/* @var $group array */
/* @var $this \yii\web\View */

foreach ($group as $groupItem) {

    echo $this->renderFile('@app/modules/group/views/group/group-item.php', [
        'groupItem' => $groupItem
    ]);

}
