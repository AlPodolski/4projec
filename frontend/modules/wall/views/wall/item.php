<?php

/* @var $wallItem array*/
/* @var $this \yii\web\View*/

echo $this->renderFile('@app/modules/wall/widgets/views/wall.php', [
    'wallItems' => $wallItem
]);