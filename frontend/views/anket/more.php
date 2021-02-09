<?php

/* @var  $model \frontend\modules\user\models\Profile */
/* @var  $photo array */

echo $this->renderFile('@app/views/anket/item.php',
    [
        'model' => $model,
        'photo' => $photo,
    ]
);