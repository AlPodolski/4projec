<?php

/* @var  $model \frontend\modules\user\models\Profile */

echo $this->renderFile('@app/views/anket/item.php',
    [
        'model' => $model,
    ]
);